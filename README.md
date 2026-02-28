# Laravel Role & Permission Manager

A premium, production-ready Laravel package for managing roles and permissions with a beautiful Tailwind CSS & Alpine.js powered UI. Built on top of the industry-standard `spatie/laravel-permission` package.

![Package UI](https://raw.githubusercontent.com/mohammadatif786/rolemanager/main/screenshot.png) *(Optional: Add your screenshot here)*

## Features

- **Professional UI**: Built with advanced Tailwind CSS (glassmorphism, transitions) and Alpine.js.
- **Modal-Based Workflow**: Create and edit roles/permissions without page reloads.
- **Real-time Feedback**: Global toast notifications for CRUD operations.
- **Service Layer Architecture**: Clean, maintainable code following Laravel best practices.
- **Advanced Role Assignment**: Easily assign multiple permissions to roles directly from the UI.
- **Form Request Validation**: Robust backend validation for all inputs.

## Prerequisites

- PHP ^8.2
- Laravel ^10.0 or ^11.0 or ^12.0
- Tailwind CSS (for the UI to render correctly)
- Alpine.js (for modals and toasts)

## Installation

### 1. Install the Package
Install the package via composer:

```bash
composer require atif/laravel-role-manager
```

### 2. Publish Assets
Publish the configuration, migrations, and views:

```bash
php artisan vendor:publish --provider="Atif\RoleManager\RoleManagerServiceProvider"
```

### 3. Run Migrations
Run the migrations to create the necessary tables:

```bash
php artisan migrate
```

## Setup

### 1. Add the Trait to your User Model
Include the `HasRoles` trait in your `App\Models\User` model:

```php
use Spatie\Permission\Traits\HasRoles;

class User extends Authenticatable
{
    use HasRoles;
    // ...
}
```

### 2. Configure Tailwind CSS
Ensure your `tailwind.config.js` includes the package views so the styles are generated:

```javascript
/** @type {import('tailwindcss').Config} */
export default {
  content: [
    "./resources/**/*.blade.php",
    "./resources/**/*.js",
    "./resources/**/*.vue",
    "./vendor/atif/laravel-role-manager/resources/views/**/*.blade.php", // Add this line
  ],
  theme: {
    extend: {},
  },
  plugins: [],
}
```

## Usage

### Accessing the Dashboard
Once installed, you can access the management interface at:

- **Roles**: `/roles`
- **Permissions**: `/permissions`

### Middleware Protection
By default, the routes are open. You should protect them in your `App\Providers\RouteServiceProvider` or by wrapping them in your own route group with middleware:

```php
Route::middleware(['auth', 'role:admin'])->group(function () {
    // Your role/permission routes are already registered, 
    // but you can control access via Spatie's middleware.
});
```

## Configuration
You can customize the package behavior in `config/RoleManager.php`:

- `layout`: The base layout your views should extend (default: `layouts.app`).
- `middleware`: Global middleware for the package routes.
- `prefix`: URL prefix for the routes.

## Credits

- **Author**: [Mohammad Atif](mailto:mohammadatif24680@gmail.com)
- **Built with**: [Spatie Laravel Permission](https://github.com/spatie/laravel-permission)

## License
The MIT License (MIT). Please see [License File](LICENSE.md) for more information.
