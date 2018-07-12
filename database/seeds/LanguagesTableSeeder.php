<?php

use Illuminate\Database\Seeder;
use App\Language;

class LanguagesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Language::firstOrNew(['key' => 'en', 'name' => "English", 'status' => 'ACTIVE', 'default' => true])->save();

        Language::firstOrNew(['key' => 'ru', 'name' => "Russian"])->save();

    }
}
