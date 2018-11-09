<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Article extends Model
{

    protected $table = 'oxarticles';
    public $incrementing = false;
    protected $primaryKey = 'OXID';
    protected $fillable = ['OXTITLE', 'OXARTNUM', 'OXACTIVE'];

    /**
     * The attributes excluded from the model's JSON form.
     *
     * @var array
     */
    protected $hidden = [];
}
