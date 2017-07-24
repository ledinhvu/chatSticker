<?php

use Faker\Factory as Faker;
use App\Models\Images;
use App\Repositories\ImagesRepository;

trait MakeImagesTrait
{
    /**
     * Create fake instance of Images and save it in database
     *
     * @param array $imagesFields
     * @return Images
     */
    public function makeImages($imagesFields = [])
    {
        /** @var ImagesRepository $imagesRepo */
        $imagesRepo = App::make(ImagesRepository::class);
        $theme = $this->fakeImagesData($imagesFields);
        return $imagesRepo->create($theme);
    }

    /**
     * Get fake instance of Images
     *
     * @param array $imagesFields
     * @return Images
     */
    public function fakeImages($imagesFields = [])
    {
        return new Images($this->fakeImagesData($imagesFields));
    }

    /**
     * Get fake data of Images
     *
     * @param array $postFields
     * @return array
     */
    public function fakeImagesData($imagesFields = [])
    {
        $fake = Faker::create();

        return array_merge([
            'key' => $fake->word,
            'url' => $fake->word,
            'created_at' => $fake->word,
            'updated_at' => $fake->word
        ], $imagesFields);
    }
}
