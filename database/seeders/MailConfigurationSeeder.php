<?php

namespace Database\Seeders;

use App\Models\Configuration;
use Illuminate\Database\Seeder;

class MailConfigurationSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Configuration::insert([
            ['name' => 'mail_transport', 'content' => 'smtp'],
            ['name' => 'mail_host', 'content' => 'smtp.sendgrid.net'],
            ['name' => 'mail_port', 'content' => 587],
            ['name' => 'mail_encryption', 'content' => 'tls'],
            ['name' => 'mail_username', 'content' => 'apikey'],
            ['name' => 'mail_password', 'content' => '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'],
            ['name' => 'mail_from_name', 'content' => '${APP_NAME}'],
            ['name' => 'mail_from_address', 'content' => 'duongwings@gmail.com'],
        ]);
    }
}
