<?php

use App\Models\Family;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        // $this->call(UserSeeder::class);
        // $this->call(CommentSeeder::class);
        // $this->call(RoomSeeder::class);
        // $this->call(CitySeeder::class);
        // $this->call(ResevationSeeder::class);
        $this->call(FamilySeeder::class);
        $this->call(UserSeeder::class);
    }
}
