<?php

use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseTransactions;

class ImagesApiTest extends TestCase
{
    use MakeImagesTrait, ApiTestTrait, WithoutMiddleware, DatabaseTransactions;

    /**
     * @test
     */
    public function testCreateImages()
    {
        $images = $this->fakeImagesData();
        $this->json('POST', '/api/v1/images', $images);

        $this->assertApiResponse($images);
    }

    /**
     * @test
     */
    public function testReadImages()
    {
        $images = $this->makeImages();
        $this->json('GET', '/api/v1/images/'.$images->id);

        $this->assertApiResponse($images->toArray());
    }

    /**
     * @test
     */
    public function testUpdateImages()
    {
        $images = $this->makeImages();
        $editedImages = $this->fakeImagesData();

        $this->json('PUT', '/api/v1/images/'.$images->id, $editedImages);

        $this->assertApiResponse($editedImages);
    }

    /**
     * @test
     */
    public function testDeleteImages()
    {
        $images = $this->makeImages();
        $this->json('DELETE', '/api/v1/images/'.$images->id);

        $this->assertApiSuccess();
        $this->json('GET', '/api/v1/images/'.$images->id);

        $this->assertResponseStatus(404);
    }
}
