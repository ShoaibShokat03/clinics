<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\URL;

class UrlServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        // Replace the default URL generator with our project-aware version
        $this->app->singleton('url', function ($app) {
            $routes = $app['router']->getRoutes();
            $request = $app->make('request');
            $assetRoot = $app['config']['app.asset_url'];
            
            return new \App\Routing\ProjectAwareUrlGenerator(
                $routes,
                $request,
                $assetRoot
            );
        });
    }

    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {
        // Create a macro for redirect()->route() that ensures project is included
        \Illuminate\Support\Facades\Redirect::macro('toRoute', function ($route, $parameters = [], $status = 302, $headers = []) {
            $project = getCurrentProject();
            if ($project && is_array($parameters) && !isset($parameters['project'])) {
                $parameters['project'] = $project;
            } elseif ($project && !is_array($parameters)) {
                $parameters = ['project' => $project];
            }
            return redirect()->route($route, $parameters, $status, $headers);
        });
    }
}
