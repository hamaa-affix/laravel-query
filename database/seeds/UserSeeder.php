<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

        // $user = factory(App\User::class, 3)->make();
        // $user->each( function($model) {
        //     $model->save();
        // });

        DB::table('users')->insert([
            'first_name' => 'mami',
            'last_name'  => 'hamada',
            'age'        => 32,
            'attribute'  => 1,
            'tel'        => '00011114444',
            'email'      => 'example@example.com',
            'password'   => 'testtest'
        ]);

        factory(App\Models\User::class, 5)->create();
    }
}
