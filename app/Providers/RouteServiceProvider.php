<?php

namespace App\Providers;

use Illuminate\Cache\RateLimiting\Limit;
use Illuminate\Foundation\Support\Providers\RouteServiceProvider as ServiceProvider;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\RateLimiter;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\URL;

class RouteServiceProvider extends ServiceProvider
{
    /**
     * The path to the "home" route for your application.
     *
     * This is used by Laravel authentication to redirect users after login.
     *
     * @var string
     */
    public const HOME = '/dashboard';

    /**
     * The controller namespace for the application.
     *
     * When present, controller route declarations will automatically be prefixed with this namespace.
     *
     * @var string|null
     */
    // protected $namespace = 'App\\Http\\Controllers';

    /**
     * Define your route model bindings, pattern filters, etc.
     *
     * @return void
     */
    public function boot()
    {
        $this->configureRateLimiting();

        $this->routes(function () {
            Route::middleware('api')
                ->namespace($this->namespace)
                ->group(base_path('routes/api.php'));

            Route::middleware('web')
                ->namespace($this->namespace)
                ->group(base_path('routes/web.php'));
        });
        
        // Global fix: Override route() helper to automatically include project parameter
        // This ensures ALL route() calls throughout the application include the project segment
        $this->app->extend('url', function ($url, $app) {
            // Create a wrapper that intercepts route() calls
            $originalUrl = $url;
            
            // Use macro to extend URL generator
            URL::macro('routeWithProject', function ($name, $parameters = [], $absolute = true) use ($originalUrl) {
                // Get project from URL defaults (set by TenantDatabase middleware)
                $project = null;
                try {
                    $defaults = URL::getDefaultParameters();
                    if (isset($defaults['project']) && !empty($defaults['project'])) {
                        $project = $defaults['project'];
                    }
                } catch (\Exception $e) {
                    // Continue to fallback
                }
                
                // Fallback: get from request segment
                if (!$project && request()) {
                    $segment = getenv('URL_SEGMENT');
                    if ($segment) {
                        $project = request()->segment($segment);
                    }
                }
                
                // Add project to parameters if not present
                if ($project) {
                    if (is_array($parameters)) {
                        if (!isset($parameters['project'])) {
                            $parameters['project'] = $project;
                        }
                    } elseif ($parameters !== null && $parameters !== []) {
                        // Single parameter (like ID) - convert to array
                        if (is_numeric($parameters) || is_string($parameters)) {
                            $parameters = ['project' => $project, $parameters];
                        } else {
                            $parameters = ['project' => $project] + (is_array($parameters) ? $parameters : []);
                        }
                    } else {
                        $parameters = ['project' => $project];
                    }
                }
                
                return $originalUrl->route($name, $parameters, $absolute);
            });
            
            return $url;
        });
    }

    /**
     * Configure the rate limiters for the application.
     *
     * @return void
     */
    protected function configureRateLimiting()
    {
        RateLimiter::for('api', function (Request $request) {
            return Limit::perMinute(60)->by(optional($request->user())->id ?: $request->ip());
        });
    }
}
