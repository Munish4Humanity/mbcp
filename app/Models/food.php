<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model as Model;

/**
 * Class food
 * @package App\Models
 * @version July 6, 2019, 12:23 pm UTC
 *
 * @property string name
 * @property textarea desc
 */
class food extends Model
{

    public $table = 'foods';
    


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
        'name' => 'required'
    ];

    
}
