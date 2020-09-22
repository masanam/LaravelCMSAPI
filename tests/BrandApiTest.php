<?php

use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseTransactions;

class BrandApiTest extends TestCase
{
    use MakeBrandTrait, ApiTestTrait, WithoutMiddleware, DatabaseTransactions;

    /**
     * @test
     */
    public function testCreateBrand()
    {
        $brand = $this->fakeBrandData();
        $this->json('POST', '/api/v1/brands', $brand);

        $this->assertApiResponse($brand);
    }

    /**
     * @test
     */
    public function testReadBrand()
    {
        $brand = $this->makeBrand();
        $this->json('GET', '/api/v1/brands/'.$brand->id);

        $this->assertApiResponse($brand->toArray());
    }

    /**
     * @test
     */
    public function testUpdateBrand()
    {
        $brand = $this->makeBrand();
        $editedBrand = $this->fakeBrandData();

        $this->json('PUT', '/api/v1/brands/'.$brand->id, $editedBrand);

        $this->assertApiResponse($editedBrand);
    }

    /**
     * @test
     */
    public function testDeleteBrand()
    {
        $brand = $this->makeBrand();
        $this->json('DELETE', '/api/v1/brands/'.$brand->id);

        $this->assertApiSuccess();
        $this->json('GET', '/api/v1/brands/'.$brand->id);

        $this->assertResponseStatus(404);
    }
}
