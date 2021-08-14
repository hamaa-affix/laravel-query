<?php

use Illuminate\Database\Seeder;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        factory(App\User::class, 3)->create();

        // $user = factory(App\User::class, 3)->make();
        // $user->each( function($model) {
        //     $model->save();
        // });
    }
}
