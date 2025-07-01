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
            'name' => 'Mateo Rodriguez',
            'email' => 'mdavidmontero6@gmail.com',
            'password' => bcrypt('password'),
        ]);
        $this->call([
            FamilySeeder::class,
        ]);

        Product::factory(150)->create();
    }
}
