<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ArticlesTableSeeder extends Seeder
{

    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('oxarticles')->insert(
            [
                'OXID'      => 'sGM9m7VDcasdsd00Bod3X2WnxZNn',
                'OXARTNUM'	=> 'test123',
                'OXTITLE'	=> 'Testarticle'
            ]
        );
    }
}
