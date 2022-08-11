<?php

namespace App\Providers;

use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;
use Illuminate\Support\Facades\Gate;
use Auth;
use Illuminate\Auth\Access\Response;

class AuthServiceProvider extends ServiceProvider
{
    /**
     * The policy mappings for the application.
     *
     * @var array<class-string, class-string>
     */
    protected $policies = [
       //'App\Models\Model' => 'App\Policies\ModelPolicy',
       
    ];

    /**
     * Register any authentication / authorization services.
     *
     * @return void
     */
    public function boot()
    {
        $this->registerPolicies();
        
        /* define a admin user role */
        Gate::define('isAdmin', function($user) {
            return $user->role == 'admin';
         });
        
         /* define a manager user role */
         Gate::define('isDesigner', function($user) {
             return ($user->role == 'senior designer' or $user->role == 'project manager'
              or $user->role == 'junior designer' or $user->role == 'department manager');
         });
       
         /* define a user role */
         Gate::define('isClient', function($user) {
             return Auth::guard('clientweb')->check();
         });

          /* define a customer service role */
          Gate::define('isCustomerService', function($user) {
            return $user->role == 'customer service';
        });
        //

         /* define a edit tasks rule */
      


        Gate::define('edit-task', function ($user, $task) {
            if($user->role == 'admin'){
                return true;
            } else{
            return $user->role === $task->responsible  
                                    ?  Response::allow()
                                    : Response::deny('not allowed');}
        });


    }
}
