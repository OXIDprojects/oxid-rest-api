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
                'oxid'      => 'sGM9m7VDcasdsd00Bod3X2WnxZNn',
                'oxartnum'	=> 'test123';
                'oxtitle'	=> 'Testarticle'
            ]
        );
    }
}
