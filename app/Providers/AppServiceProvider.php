<?php
namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Storage;
use League\Flysystem\Filesystem;
use Masbug\Flysystem\GoogleDriveAdapter;
use Google_Client;
use Google_Service_Drive;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        Storage::extend('google', function ($app, $config) {
            $client = new Google_Client();
            $client->setScopes([Google_Service_Drive::DRIVE]);
            $client->setAuthConfig([
                'type' => 'service_account',
                'client_id' => $config['clientId'],
                'client_email' => $config['clientEmail'],
                'private_key' => str_replace("\\n", "\n", $config['privateKey']),
            ]);

            $service = new Google_Service_Drive($client);
            $adapter = new GoogleDriveAdapter($service, $config['folderId']);
            return new Filesystem($adapter);
        });

        // Make cartCount available in all website views
        \View::composer('website.*', function ($view) {
            $cartCount = 0;
            if (auth()->check()) {
                $cart = \App\Models\Cart::where('user_id', auth()->id())->with('items')->first();
                $cartCount = $cart ? $cart->items->sum('quantity') : 0;
            }
            $view->with('cartCount', $cartCount);
        });
    }
}