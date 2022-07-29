<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
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
        // \App\Models\User::factory(10)->create();

        \App\Models\User::factory()->create([
            'name' => 'Angelo Maria Esposito',
            'email' => 'am.esposito@ceastack.com',
            'password' => '$2a$12$oNMedAgfVgYmJrrsuRtd/eaZYeaM.e/Mb9xmwWb0F1bqP4c5cq.n2' //Lasafalah@17
        ]);
    }
}
