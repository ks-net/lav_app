<?php

namespace App\Providers;

//use App\Post;
//use App\Policies\PostPolicy;
use Illuminate\Support\Facades\Gate;
use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;

class AuthServiceProvider extends ServiceProvider {

    /**
     * The policy mappings for the application.
     *
     * @var array
     */
    protected $policies = [
        //Post::class => PostPolicy::class,
        'App\Post' => 'App\Policies\PostPolicy',
    ];

    /**
     * Register any authentication / authorization services.
     *
     * @return void
     */
    public function boot() {
        $this->registerPolicies();

        /*
          Gate::define('create', 'PostPolicy@create');
          Gate::define('edit', 'PostPolicy@edit');
          Gate::define('update', 'PostPolicy@update');
          Gate::define('delete', 'PostPolicy@delete');
          Gate::define('deleteMany', 'PostPolicy@deleteMany');
         */
    }

}
