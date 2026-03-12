<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Contact;

class DatabaseSeeder extends Seeder
{
    public function run()
    {
         $this->call(CategorySeeder::class);

         Contact::factory(20)->create();
    }
}