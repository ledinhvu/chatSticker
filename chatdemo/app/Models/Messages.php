<?php

namespace App\Models;

use Eloquent as Model;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * Class Messages
 * @package App\Models
 * @version July 12, 2017, 3:48 am UTC
 */
class Messages extends Model
{
    use SoftDeletes;

    public $table = 'messages';
    

    protected $dates = ['deleted_at'];


    public $fillable = [
        'content',
        'id_user',
        'id_room'
    ];

    /**
     * The attributes that should be casted to native types.
     *
     * @var array
     */
    protected $casts = [
        'content' => 'longtext',
        'id_user' => 'integer',
        'id_room' => 'integer'
    ];

    /**
     * Validation rules
     *
     * @var array
     */
    public static $rules = [
        'content' => 'required',
        'id_user' => 'required',
        'id_room' => 'required'
    ];

    /**
     * Undocumented function
     *
     * @return void
     */
    public function rooms()
    {
        return $this->belongsTo(\App\Models\Rooms::class, 'id_room');
    }

    /**
     * Undocumented function
     *
     * @return void
     */
    public function user()
    {
        return $this->belongsTo(\App\Models\User::class, 'id_user');
    }
}
