<?php

namespace App\Repositories;

use App\Models\Messages;
use InfyOm\Generator\Common\BaseRepository;

class MessagesRepository extends BaseRepository
{
    /**
     * @var array
     */
    protected $fieldSearchable = [
        'content'
    ];

    /**
     * Configure the Model
     **/
    public function model()
    {
        return Messages::class;
    }
}
