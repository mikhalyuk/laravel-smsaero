## Installation

This package is very easy to set up. There are only couple of steps.

### Composer

```
composer require vasya-mikhalyuk/laravel-smsaero
```

### Service Provider

Add the package to your application service providers in `config/app.php` file.

```php
'providers' => [
    
    /*
     * Laravel Framework Service Providers...
     */
    Illuminate\Foundation\Providers\ArtisanServiceProvider::class,
    Illuminate\Auth\AuthServiceProvider::class,
    ...
    
    /**
     * Third Party Service Providers...
     */
    Mikhalyuk\SmsAero\SmsAeroServiceProvider::class,

],
```

### Config File

Publish the package config file to your application. Run this command inside your terminal.

    php artisan vendor:publish --provider="Mikhalyuk\SmsAero\SmsAeroServiceProvider" --tag=config

And that's it!