<?php

namespace App\Models;

use Eloquent as Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use App\Models\User;

/**
 * Class Rooms
 * @package App\Models
 * @version June 23, 2017, 3:13 am UTC
 */
class Rooms extends Model
{
    use SoftDeletes;

    public $table = 'rooms';
    

    protected $dates = ['deleted_at'];


    public $fillable = [
        'name',
        'description',
        'role'
    ];

    /**
     * The attributes that should be casted to native types.
     *
     * @var array
     */
    protected $casts = [
        'name' => 'string',
        'description' => 'string',
        'role'
    ];

    /**
     * Validation rules
     *
     * @var array
     */
    public static $rules = [
        'name' => 'required',
        'description' => 'required',
        'role'
    ];

    /**
     * Undocumented function
     *
     * @return void
     */
    public function users()
    {
        return $this->belongsToMany(\App\Models\User::class,'user_room','id_room','id_user');
    }

}
