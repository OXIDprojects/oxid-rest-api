<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class UsersTableSeeder extends Seeder
{

    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('rest_users')->insert(
            [
                'name'      => 'Test User',
                'api-token' => 't6PEqwkBpbdsf93osDSF913Bmcsd78pYWLtEgvs'
            ]
        );
    }
}
