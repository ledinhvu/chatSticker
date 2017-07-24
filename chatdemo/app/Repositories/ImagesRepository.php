<?php

namespace App\Repositories;

use App\Models\Images;
use InfyOm\Generator\Common\BaseRepository;

class ImagesRepository extends BaseRepository
{
    /**
     * @var array
     */
    protected $fieldSearchable = [
        'key',
        'name',
        'url'
    ];

    /**
     * Configure the Model
     **/
    public function model()
    {
        return Images::class;
    }
}
