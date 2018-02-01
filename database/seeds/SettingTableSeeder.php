<?php

use Illuminate\Database\Seeder;

class SettingTableSeeder extends Seeder {

    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run() {
        DB::table('settings')->insert([
            ['name' => 'site_url', 'value' => 'http://lav.loc'],
            ['name' => 'cachetime', 'value' => '120'],
            ['name' => 'public_pagination','value' => '4'],
            ['name' => 'admin_pagination','value' => '16'],
            ['name' => 'disqus_site_url','value' => 'https://lavapp.disqus.com'],
            ['name' => 'admin_title_trim','value' => '120'],
            ['name' => 'admin_desc_trim','value' => '200'],
            ['name' => 'frontend_title_trim','value' => '250'],
            ['name' => 'frontend_desc_trim','value' => '120'],
            ['name' => 'frontend_next_prev_trim','value' => '120'],
            ['name' => 'post_main_img_width','value' => '1024'],
            ['name' => 'post_main_img_height','value' => '576'],
            ['name' => 'post_medium_img_width','value' => '800'],
            ['name' => 'post_medium_img_height','value' => '300'],
            ['name' => 'post_thumb_img_width','value' => '150'],
            ['name' => 'post_thumb_img_height','value' => '150'],
            ['name' => 'media_full_img_width','value' => '1024'],
            ['name' => 'media_medium_img_width','value' => '800'],
            ['name' => 'media_thumb_img_width','value' => '150'],
            ['name' => 'media_thumb_img_height','value' => '150']
        ]);
    }

}
