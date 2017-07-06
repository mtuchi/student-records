<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use App\Models\Permission;
use Gate;
use Blade;
use Auth;

class PermissionsServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap the application services.
     *
     * @return void
     */
    public function boot()
    {
				if (Auth::check()) {
						Permission::get()->map(function($permission) {
							Gate::define($permission->name, function($user) use($permission){
								return $user->hasPermissionTo($permission);
							});
						});
				}

				Blade::directive('role', function($role) {
					return "<?php if (Auth::check() && Auth::user()->hasRole({$role})): ?>";
				});

				Blade::directive('endrole', function($role) {
					return '<?php endif; ?>';
				});
    }

    /**
     * Register the application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }
}
