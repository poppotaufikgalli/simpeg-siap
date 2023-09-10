<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Pagination\Paginator;
use View;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\URL;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        if (!app()->isLocal()) {
            URL::forceScheme('https');
        }
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        Paginator::useBootstrap();
 
        /*View::composer('*', function($view)
        {
            $ctl = new Controller;
            $navbars = $ctl->GetMenu();
            $tipedokhukums = $ctl->GetTipeDokHukum();
            $links = $ctl->GetLink();
            $jnshukums = $ctl->GetJnsDokHukum();
            $kontens = $ctl->getHal();
            $visit = $ctl->GetVisits();
            $view->with('navbars', $navbars);
            $view->with('tipedokhukums', $tipedokhukums);
            $view->with('jnshukums', $jnshukums);
            $view->with('links', $links);
            $view->with('kontens', $kontens);
            $view->with('avisit', $visit);
        });*/
    }
}
