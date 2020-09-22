<?php

use App\Models\Slider;
use App\Repositories\SliderRepository;
use Illuminate\Foundation\Testing\DatabaseTransactions;

class SliderRepositoryTest extends TestCase
{
    use MakeSliderTrait, ApiTestTrait, DatabaseTransactions;

    /**
     * @var SliderRepository
     */
    protected $sliderRepo;

    public function setUp()
    {
        parent::setUp();
        $this->sliderRepo = App::make(SliderRepository::class);
    }

    /**
     * @test create
     */
    public function testCreateSlider()
    {
        $slider = $this->fakeSliderData();
        $createdSlider = $this->sliderRepo->create($slider);
        $createdSlider = $createdSlider->toArray();
        $this->assertArrayHasKey('id', $createdSlider);
        $this->assertNotNull($createdSlider['id'], 'Created Slider must have id specified');
        $this->assertNotNull(Slider::find($createdSlider['id']), 'Slider with given id must be in DB');
        $this->assertModelData($slider, $createdSlider);
    }

    /**
     * @test read
     */
    public function testReadSlider()
    {
        $slider = $this->makeSlider();
        $dbSlider = $this->sliderRepo->find($slider->id);
        $dbSlider = $dbSlider->toArray();
        $this->assertModelData($slider->toArray(), $dbSlider);
    }

    /**
     * @test update
     */
    public function testUpdateSlider()
    {
        $slider = $this->makeSlider();
        $fakeSlider = $this->fakeSliderData();
        $updatedSlider = $this->sliderRepo->update($fakeSlider, $slider->id);
        $this->assertModelData($fakeSlider, $updatedSlider->toArray());
        $dbSlider = $this->sliderRepo->find($slider->id);
        $this->assertModelData($fakeSlider, $dbSlider->toArray());
    }

    /**
     * @test delete
     */
    public function testDeleteSlider()
    {
        $slider = $this->makeSlider();
        $resp = $this->sliderRepo->delete($slider->id);
        $this->assertTrue($resp);
        $this->assertNull(Slider::find($slider->id), 'Slider should not exist in DB');
    }
}
