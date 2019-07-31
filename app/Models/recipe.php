<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model as Model;

/**
 * Class recipe
 * @package App\Models
 * @version July 6, 2019, 12:21 pm UTC
 *
 * @property string name
 * @property textarea desc
 */
class recipe extends Model
{

    public $table = 'recipes';
    


    public $fillable = [
        'name',
        'desc'
    ];

    /**
     * The attributes that should be casted to native types.
     *
     * @var array
     */
    protected $casts = [
        'id' => 'integer',
        'name' => 'string'
    ];

    /**
     * Validation rules
     *
     * @var array
     */
    public static $rules = [
        'name' => 'requried'
    ];

    
}
