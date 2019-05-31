<?php

namespace App\Providers;

use App\Libs\Configs\StatusConfig;
use View;
use Illuminate\Support\ServiceProvider;
use App\Models\Setting;


class AppProvider extends ServiceProvider
{
    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {

        View::composer('Frontend.Layouts._meta', function ($view) {
            $data = Setting::where('type', StatusConfig::CONST_SETTING_SEO_DEFAULT)->first();
            if (!empty($data->data)) {
                $data->data = json_decode($data->data);
            }
            $view->with('metaDefault', $data);
        });

        View::composer('Frontend.Layouts._footer', function ($view) {
            $data = Setting::where('type', StatusConfig::CONST_SETTING_CONTACT)->first();
            if (!empty($data->data)) {
                $data->data = json_decode($data->data);
            }
            $view->with('contact', $data);
        });

        $this->app->singleton('Language', function ($app) {
            return new \App\Libs\Providers\Language();
        });

        $this->app->singleton('Category', function ($app) {
            return new \App\Libs\Providers\Category();
        });
    }

    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        return ['Category'];
    }
}
