<?php

use Illuminate\Database\Seeder;
use App\models\Page;

class PagesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Page::insert([
            ['ka_name' => 'მთავარი', 'en_name' => 'Home', 'path' => '/', 'priority' => 0],
            ['ka_name' => 'ივენთები', 'en_name' => 'Events', 'path' => '/events', 'priority' => 5],
            ['ka_name' => 'სიახლეები', 'en_name' => 'News', 'path' => '/news', 'priority' => 10],
            ['ka_name' => 'ფასები', 'en_name' => 'Prices', 'path' => '/prices', 'priority' => 15],
            ['ka_name' => 'კონტაქტი', 'en_name' => 'Contact', 'path' => '/contact', 'priority' => 20]
        ]);
    }
}
