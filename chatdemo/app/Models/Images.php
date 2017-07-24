<?php

namespace App\Models;

use Eloquent as Model;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * Class Images
 * @package App\Models
 * @version July 14, 2017, 1:36 am UTC
 */
class Images extends Model
{
    use SoftDeletes;

    public $table = 'images';
    

    protected $dates = ['deleted_at'];


    public $fillable = [
        'key',
        'name',
        'url'
    ];

    /**
     * The attributes that should be casted to native types.
     *
     * @var array
     */
    protected $casts = [
        'key' => 'string',
        'name' => 'string',
        'url' => 'string'
    ];

    /**
     * Validation rules
     *
     * @var array
     */
    public static $rules = [
        'key' => 'required|min:3|max:50|unique:images',
        // 'image.*' => 'image|mimes:jpeg,jpg,png|max:8192',
        'image' => 'required|image|mimes:jpeg,jpg,png|max:8192'
    ];

    /**
     * Validation rules
     *
     * @var array
     */
    public static $rules_update = [
        'image.*' => 'mimes:jpeg,jpg,png|max:8192'
    ];
}
