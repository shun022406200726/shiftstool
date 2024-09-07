public function boot()
{
    $this->registerPolicies();

    Gate::define('admin', function ($user) {
        return $user->role === 'admin';
    });

    Gate::define('employee', function ($user) {
        return $user->role === 'employee';
    });
}
