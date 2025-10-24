Laravel 10 | TailwindCSS | Breeze Starter Kit

spatie | laravel permission

Roles and Permissions: (Tailwindcss)
1. Install Laravel
>composer create-project laravel/laravel=10 osb_blog
2. Configure Database
   1. .env file DB_DATABASE
   2. >php artisan migrate
3. Install Breeze
   1. >composer require laravel/breeze --dev
   2. >php artisan breeze:install
	>blade
	>no
	>0
   3. >npm i
   4. >npm run dev

4. Create Permissions Step:
   1. LARAVEL-PERMISSION | SPATIE | https://spatie.be/docs/laravel-permission/v6/introduction
   2. >composer require spatie/laravel-permission
   3. >php artisan vendor:publish --provider="Spatie\Permission\PermissionServiceProvider"
   4. >php artisan optimize:clear
   5. >php artisan config:clear
   6. >php artisan make:controller PermissionController
   7. >php artisan migrate

5. Create Roles Step:
   1. >php artisan make:controller RoleController

6. Create & List Articles
   1. >php artisan make:model Article -m
   2. >php artisan make:controller ArticleController -r

7. Users - Assign Roles
   1. >php artisan make:controller UserController -r

8. app\Http\Kernel.php
    protected $middlewareAliases = [
       ...,
       'role' => \Spatie\Permission\Middleware\RoleMiddleware::class,
        'permission' => \Spatie\Permission\Middleware\PermissionMiddleware::class,
        'role_or_permission' => \Spatie\Permission\Middleware\RoleOrPermissionMiddleware::class,
    ];

9. app\Providers\AppServiceProvider.php
    public function boot(): void
    {
        Gate::before(function ($user, $ability) {
            return $user->hasRole('superadmin') ? true : null;
        });
    }

10. app\Models\User.php
    class User extends Authenticatable
    {
        use HasApiTokens, HasFactory, Notifiable, HasRoles;
        ...
    }

11. app\Models\Article.php
