<?php

namespace wsbrendonballantyne\Earmark;

use Illuminate\Database\Eloquent\Factories\Factory as EloquentFactory;
use Illuminate\Foundation\AliasLoader;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\ServiceProvider;
use wsbrendonballantyne\Earmark\console\Commands\EarMarkInstall;
use wsbrendonballantyne\Earmark\Http\Controllers\Sequential;
use wsbrendonballantyne\Earmark\Http\Controllers\Serial;
use wsbrendonballantyne\Earmark\Providers\EventServiceProvider;

//use Illuminate\Foundation\AliasLoader;

class EarmarkServiceProvider extends ServiceProvider
{
    /**
     * Indicates if loading of the provider is deferred.
     *
     * @var bool
     */
    protected $defer = false;

    /**
     * Bootstrap the application events.
     *
     * @return void
     */
    public function boot()
    {

        // defaultStringLength from Apifrontend
        Schema::defaultStringLength(191);

        // Load Migrations
        $this->loadMigrationsFrom(__DIR__ . '/database/migrations');

        // Publish Configuration Files
        $this->publishes([
            __DIR__ . '/config/earmark.php' => config_path('earmark.php'),
        ], 'earmark-config');

        // Load Commands
        if ($this->app->runningInConsole()) {
            $this->commands([
                EarMarkInstall::class,
            ]);
        }

        $loader = AliasLoader::getInstance();
        $loader->alias('Earmarked', Facades\EarMarkFacade::class);
        $loader->alias('Earmark', Serial::class);
    }

    /**
     * Register the service provider.
     *
     * @return void
     */
    public function register()
    {

        // Register Factories
        $this->registerEloquentFactoriesFrom(__DIR__ . '/database/factories');

        // Default Package Configuration
        $this->mergeConfigFrom(__DIR__ . '/config/earmark.php', 'earmark');
        $this->mergeConfigFrom(__DIR__ . '/config/default.php', 'earmark');

        $this->app->register(EventServiceProvider::class);

        // @codeCoverageIgnoreStart
        //wsbrendonballantyne\Earmark\Http\Controllers
        $this->app->singleton('earmark', function () {
            return new Serial;
        });

        //wsbrendonballantyne\Earmark\Http\Controllers
        $this->app->singleton('sequence', function () {
            return new Sequential;
        });
        // @codeCoverageIgnoreEnd
    }

    /**
     * Register factories.
     *
     * @param  string  $path
     * @return void
     */
    protected function registerEloquentFactoriesFrom($path)
    {
        $this->app->make(EloquentFactory::class)->load($path);
    }
}
