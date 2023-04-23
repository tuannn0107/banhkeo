<?php

namespace Database\Seeders;

use App\Enums\SystemType;
use App\Models\Configuration;
use Illuminate\Database\Seeder;

class ConfigurationSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Configuration::insert([
            ['name' => 'logo', 'content' => '/images/home/logo.png'],
            ['name' => 'favicon', 'content' => '/images/home/favicon.png'],
            ['name' => 'locale', 'content' => 'vi'],
        ]);

        $systemTypeList = collect();
        foreach (SystemType::cases() as $systemType) {
            $systemTypeList->push(['name' => $systemType->value, 'content' => 0]);
        }

        Configuration::insert($systemTypeList->toArray());

        if (app()->isLocal()) {
            Configuration::insert([
                ['name' => 'title', 'content' => 'CMS'],
                ['name' => 'description', 'content' => 'If you dont get a miracle... become one'],
                ['name' => 'phone', 'content' => '038.480.1238'],
                ['name' => 'phone_2', 'content' => '0989.15.97.91'],
                ['name' => 'email', 'content' => 'duong.dn92@gmail.com'],
                ['name' => 'email_2', 'content' => 'duongwings@gmail.com'],
                ['name' => 'address', 'content' => '128 Phan Khôi, Cẩm Lệ, Đà Nẵng'],
                ['name' => 'whatsapp', 'content' => 'https://wa.me/0384801238'],
                ['name' => 'zalo', 'content' => 'https://zalo.me/0384801238'],
                ['name' => 'messenger', 'content' => 'https://www.messenger.com/t/duongvalo'],
                ['name' => 'map', 'content' => 'https://goo.gl/maps/8Ng6jCnS6vYjCher9'],
                ['name' => 'facebook', 'content' => 'https://www.facebook.com/duongvalo'],
                ['name' => 'instagram', 'content' => 'https://www.instagram.com/duongvalo'],
                ['name' => 'twitter', 'content' => 'https://twitter.com/duongvalo'],
                ['name' => 'tumblr', 'content' => 'https://www.tumblr.com/blog/duongvalo-blog'],
                ['name' => 'pinterest', 'content' => 'https://www.pinterest.com/duongvalo'],
                ['name' => 'linkedin', 'content' => 'https://www.linkedin.com/in/duong-dang-cong-72925258'],
                ['name' => 'flickr', 'content' => 'https://www.flickr.com/photos/194693430@N04'],
                ['name' => 'youtube', 'content' => 'https://www.youtube.com/channel/UC_po2pD3vbMH4oHs0psdJ7A'],
                ['name' => 'css', 'content' => '<style>.test {color: red}</style>'],
                ['name' => 'js', 'content' => '<script>let test = 1</script>'],
            ]);
        } else {
            Configuration::insert([
                ['name' => 'title', 'content' => ''],
                ['name' => 'description', 'content' => ''],
                ['name' => 'phone', 'content' => ''],
                ['name' => 'phone_2', 'content' => ''],
                ['name' => 'email', 'content' => ''],
                ['name' => 'email_2', 'content' => ''],
                ['name' => 'address', 'content' => ''],
                ['name' => 'whatsapp', 'content' => ''],
                ['name' => 'zalo', 'content' => ''],
                ['name' => 'messenger', 'content' => ''],
                ['name' => 'map', 'content' => ''],
                ['name' => 'facebook', 'content' => ''],
                ['name' => 'instagram', 'content' => ''],
                ['name' => 'twitter', 'content' => ''],
                ['name' => 'tumblr', 'content' => ''],
                ['name' => 'pinterest', 'content' => ''],
                ['name' => 'linkedin', 'content' => ''],
                ['name' => 'flickr', 'content' => ''],
                ['name' => 'youtube', 'content' => ''],
                ['name' => 'css', 'content' => ''],
                ['name' => 'js', 'content' => ''],
            ]);
        }

        Configuration::insert([
            ['name' => 'short_company', 'type' => 'cms', 'content' => 'Măng khô Bà Lan'],
            ['name' => 'long_company', 'type' => 'cms', 'content' => 'Măng khô Bà Lan'],
            ['name' => 'home_company', 'type' => 'cms', 'content' => 'Giới thiệu măng khô Bà Lan'],
        ]);
    }
}
