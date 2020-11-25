<?php

namespace App\Providers;

use App\BussinessLogic\PluginBL\MenuPlugin;
use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\DB;
use stdClass;

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
            /**
             *-------------------------------------------------------------------------
             * Sesssion('locale')
             * ------------------------------------------------------------------------
             * Session => locale adalah session untuk mengetahui bahasa apa yang dipakai
             * bahasa yang digunakan pada website akan disimpan di session ini
             */
            if(!session()->has('locale')) 
            {
                app()->setLocale(session('locale'));
            } else {
                app()->setLocale('en');
            }

        view()->composer('partial.plugin.index', function ($view) {

            $menuPlugin = new MenuPlugin(auth()->user()->id);

            $dataPlugin = $menuPlugin->Get();

            $dataPluginGrouped = $dataPlugin->groupBy('plugin_id');
            // dd($dataPluginGrouped);
            $view->with([
                'dataPlugins' => $dataPluginGrouped    
            ]);
        });
    }
}
