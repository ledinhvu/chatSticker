<?php

use App\Models\Images;
use App\Repositories\ImagesRepository;
use Illuminate\Foundation\Testing\DatabaseTransactions;

class ImagesRepositoryTest extends TestCase
{
    use MakeImagesTrait, ApiTestTrait, DatabaseTransactions;

    /**
     * @var ImagesRepository
     */
    protected $imagesRepo;

    public function setUp()
    {
        parent::setUp();
        $this->imagesRepo = App::make(ImagesRepository::class);
    }

    /**
     * @test create
     */
    public function testCreateImages()
    {
        $images = $this->fakeImagesData();
        $createdImages = $this->imagesRepo->create($images);
        $createdImages = $createdImages->toArray();
        $this->assertArrayHasKey('id', $createdImages);
        $this->assertNotNull($createdImages['id'], 'Created Images must have id specified');
        $this->assertNotNull(Images::find($createdImages['id']), 'Images with given id must be in DB');
        $this->assertModelData($images, $createdImages);
    }

    /**
     * @test read
     */
    public function testReadImages()
    {
        $images = $this->makeImages();
        $dbImages = $this->imagesRepo->find($images->id);
        $dbImages = $dbImages->toArray();
        $this->assertModelData($images->toArray(), $dbImages);
    }

    /**
     * @test update
     */
    public function testUpdateImages()
    {
        $images = $this->makeImages();
        $fakeImages = $this->fakeImagesData();
        $updatedImages = $this->imagesRepo->update($fakeImages, $images->id);
        $this->assertModelData($fakeImages, $updatedImages->toArray());
        $dbImages = $this->imagesRepo->find($images->id);
        $this->assertModelData($fakeImages, $dbImages->toArray());
    }

    /**
     * @test delete
     */
    public function testDeleteImages()
    {
        $images = $this->makeImages();
        $resp = $this->imagesRepo->delete($images->id);
        $this->assertTrue($resp);
        $this->assertNull(Images::find($images->id), 'Images should not exist in DB');
    }
}
