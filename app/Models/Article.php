<?php

namespace App\Models;

/**
 * Class Article
 * @OA\Schema()
 * @package App\Models
 */
class Article extends Base {

    /**
     * Database table
     *
     * @var string
     */
    protected $table = 'oxarticles';
}
