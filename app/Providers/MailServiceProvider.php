<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;

class MailServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {
        $config = cache()->get('config');
        if ($config) {
            $mailTransport = $config->mail_transport ?? env('MAIL_MAILER');
            config(['mail.mailers.' . $mailTransport => [
                'transport' => $mailTransport,
                'host' => $config->mail_host ?? env('MAIL_HOST'),
                'port' => $config->mail_port ?? env('MAIL_PORT'),
                'encryption' => $config->mail_encryption ?? env('MAIL_ENCRYPTION'),
                'username' => $config->mail_username ?? env('MAIL_USERNAME'),
                'password' => $config->mail_password ?? env('MAIL_PASSWORD'),
                'timeout' => null,
            ]]);

            config(['mail.mailers.from' => [
                'address' => $config->mail_from_address ?? env('MAIL_FROM_ADDRESS'),
                'name' => $config->mail_from_name ?? env('MAIL_FROM_NAME'),
            ]]);
        }
    }
}
