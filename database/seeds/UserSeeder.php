<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use App\Models\Family;
use Illuminate\Support\Str;
use App\Models\User;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $family = Family::first();
        $familyId = Family::all()->pluck('id');

        DB::table('users')->insert([
            'id'         => Str::orderedUuid(),
            'first_name' => 'mami',
            'last_name'  => 'hamada',
            'age'        => 32,
            'attribute'  => 1,
            'tel'        => '00011114444',
            'email'      => 'example@example.com',
            'password'   => 'testtest',
            'family_id'   => $family['id']
        ]);

        foreach($familyId as $id) {
            User::factory(1)->create([
                'family_id' => $id
            ]);
        }
    }
}
