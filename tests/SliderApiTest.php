<?php

use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseTransactions;

class SliderApiTest extends TestCase
{
    use MakeSliderTrait, ApiTestTrait, WithoutMiddleware, DatabaseTransactions;

    /**
     * @test
     */
    public function testCreateSlider()
    {
        $slider = $this->fakeSliderData();
        $this->json('POST', '/api/v1/sliders', $slider);

        $this->assertApiResponse($slider);
    }

    /**
     * @test
     */
    public function testReadSlider()
    {
        $slider = $this->makeSlider();
        $this->json('GET', '/api/v1/sliders/'.$slider->id);

        $this->assertApiResponse($slider->toArray());
    }

    /**
     * @test
     */
    public function testUpdateSlider()
    {
        $slider = $this->makeSlider();
        $editedSlider = $this->fakeSliderData();

        $this->json('PUT', '/api/v1/sliders/'.$slider->id, $editedSlider);

        $this->assertApiResponse($editedSlider);
    }

    /**
     * @test
     */
    public function testDeleteSlider()
    {
        $slider = $this->makeSlider();
        $this->json('DELETE', '/api/v1/sliders/'.$slider->id);

        $this->assertApiSuccess();
        $this->json('GET', '/api/v1/sliders/'.$slider->id);

        $this->assertResponseStatus(404);
    }
}
