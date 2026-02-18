<?php

namespace App\Providers;

use App\Models\ApplicationSetting;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Schema;
use Illuminate\Pagination\Paginator;
use App\Models\Notification;
use App\Models\TaskNotification;
use Illuminate\Support\Facades\URL;
use Illuminate\Support\Facades\Redirect;


class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        try {
            //code...

            if (request()->is('install'))
                return;

            // Compatibility for case-sensitive filesystems (Linux):
            // Ensure the class is loaded so that case-insensitive class lookups work.
            // We do not need class_alias; loading the class is sufficient.
            if (class_exists(\App\Services\UserLogServices::class)) {
                // Class loaded.
            }

            Paginator::useBootstrap();

            // Global fix: Macro to ensure redirect()->route() automatically includes project
            Redirect::macro('toRoute', function ($route, $parameters = [], $status = 302, $headers = []) {
                $project = getCurrentProject();
                if ($project && is_array($parameters) && !isset($parameters['project'])) {
                    $parameters['project'] = $project;
                } elseif ($project && !is_array($parameters)) {
                    $parameters = ['project' => $project];
                }
                return redirect()->route($route, $parameters, $status, $headers);
            });

            view()->composer('*', function ($view) {
                try {
                    if (Schema::hasTable('application_settings')) {
                        $application = ApplicationSetting::first();
                    } else {
                        $application = NULL;
                    }

                    $getLang = array(
                        'en' => 'English',
                        'bn' => 'বাংলা',
                        'el' => 'Ελληνικά',
                        'pt' => 'Português',
                        'es' => 'Español',
                        'de' => 'Deutch',
                        'fr' => 'Français',
                        'nl' => 'Nederlands',
                        'it' => 'Italiano',
                        'vi' => 'Tiếng Việt',
                        'ru' => 'русский',
                        'tr' => 'Türkçe',
                        'ar' => 'عربي'
                    );

                    $flag = array(
                        "en" => "flag-icon-us",
                        "bn" => "flag-icon-bd",
                        "el" => "flag-icon-gr",
                        "pt" => "flag-icon-pt",
                        "es" => "flag-icon-es",
                        "de" => "flag-icon-de",
                        "fr" => "flag-icon-fr",
                        "nl" => "flag-icon-nl",
                        "it" => "flag-icon-it",
                        "vi" => "flag-icon-vn",
                        "ru" => "flag-icon-ru",
                        "tr" => "flag-icon-tr",
                        'ar' => "flag-icon-sa"
                    );

                    $company_full_name = "No Company Imported";
                    $activeCompany = [];
                    $companySwitchingInfo = [];
                    $tasknotifications = collect(); // Initialize as empty collection

                    if (Auth::check()) {
                        $companies = auth()->user()->companies()->with(['settings'])->get();
                        $firstCompanies = $companies->first();

                        if (!empty(auth()->user()->company_id))
                            session(['company_id' => auth()->user()->company_id]);
                        elseif (!empty($firstCompanies))
                            session(['company_id' => $firstCompanies->id]);

                        foreach ($companies as $company) {
                            $company->setSettings();
                            if ($company->id == session('company_id')) {
                                $activeCompany = $company;
                                $company_full_name = $activeCompany->company_name;
                            }
                            $companySwitchingInfo[$company->id] = $company->company_name;
                        }

                        $tasknotifications = TaskNotification::limit(20)->get();
                    }

                    if (empty($companySwitchingInfo)) {
                        $companySwitchingInfo["0"] = "No Company Imported";
                    }
                    $view->with('ApplicationSetting', $application)
                        ->with('companySwitchingInfo', $companySwitchingInfo)
                        ->with('getLang', $getLang)
                        ->with('company_full_name', $company_full_name)
                        ->with('flag', $flag)
                        ->with('tasknotifications', $tasknotifications)
                        ->with('companySettings', $activeCompany);
                } catch (\Throwable $th) {
                    $view->with('ApplicationSetting', null)
                        ->with('companySwitchingInfo', ["0" => "Dev Mode"])
                        ->with('getLang', [])
                        ->with('company_full_name', 'Dev Mode')
                        ->with('flag', [])
                        ->with('tasknotifications', collect())
                        ->with('companySettings', null);
                }
            });
        } catch (\Throwable $th) {
            //
        }
    }
}
