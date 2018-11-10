<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * Class Base
 *
 * The common OXID base model to set primary key,
 * timestamp fields, guarded field etc.
 *
 * @package App\Models
 */
class Base extends Model
{

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
     * Eloquent timestamp fields, can be disabled or changed
     * see https://laravel.com/docs/5.6/eloquent#defining-models
     */
    const CREATED_AT = 'OXINSERT';
    const UPDATED_AT = 'OXTIMESTAMP';

    /**
     * For "mass updates", using the model->update()
     * method, we need to define the $fillable array (whitelist)
     * OR the $guarded array (blacklist)
     *
     * @var array
     */
    protected $fillable = [
    ];
    protected $guarded = [
        'OXID'
    ];
}
