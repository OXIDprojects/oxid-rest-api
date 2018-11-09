<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Collection;

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


    /**
     * Get value by column
     *
     * @param string $oxColumn
     * @param string $oxValue
     *
     * @return Collection
     */
    public static function findByColumn(string $oxColumn = 'oxartnum', string $oxValue): Collection
    {
        return Article::where($oxColumn, $oxValue)->get();
    }

}
