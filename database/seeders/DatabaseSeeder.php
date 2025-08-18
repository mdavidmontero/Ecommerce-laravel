<?php

namespace Database\Seeders;

use App\Models\Product;
use App\Models\User;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Storage;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        Storage::deleteDirectory('products');
        Storage::makeDirectory('products');
        // User::factory(10)->create();

        User::factory()->create([
            'name' => 'Mateo David',
            'last_name' => 'Rodriguez Montero',
            'document_type' => 1,
            'document_number' => '123456789',
            'email' => 'mdavidmontero6@gmail.com',
            'phone' => '3104956725',
            'password' => bcrypt('password'),
        ]);
        $this->call([
            FamilySeeder::class,
            OptionSeeder::class,
        ]);

        Product::factory(20)->create();
    }
}
