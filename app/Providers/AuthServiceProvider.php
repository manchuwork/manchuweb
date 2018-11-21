<?php

namespace App\Providers;

use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;

class AuthServiceProvider extends ServiceProvider
{
    /**
     * The policy mappings for the application.
     *
     * @var array
     */
    protected $policies = [
       // 'App\Model' => 'App\Policies\ModelPolicy',
        'App\Post' => 'App\Policies\PostPolicy',
        'App\Dict' => 'App\Policies\DictPolicy',
        'App\Book' => 'App\Policies\BookPolicy',
        'App\Lyric' => 'App\Policies\LyricPolicy',
        'App\OlBook' => 'App\Policies\OlBookPolicy',
        'App\OlCatalog' => 'App\Policies\OlCatalogPolicy',
        'App\OlContent' => 'App\Policies\OlContentPolicy',






    ];

    /**
     * Register any authentication / authorization services.
     *
     * @return void
     */
    public function boot()
    {
        $this->registerPolicies();

        //
    }
}
