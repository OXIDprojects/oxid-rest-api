<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * Class Article
 *
 * @package App\Models
 */
class Article extends Model
{

    /**
     * Database table
     *
     * @var string
     */
    protected $table = 'oxarticles';

    /**
     * Table primary key
     *
     * @var string
     */
    protected $primaryKey = 'OXID';

    /**
     * Primary key type
     *
     * @var string
     */
    protected $keyType = 'string';

}
