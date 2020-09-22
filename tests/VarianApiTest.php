<?php

use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseTransactions;

class VarianApiTest extends TestCase
{
    use MakeVarianTrait, ApiTestTrait, WithoutMiddleware, DatabaseTransactions;

    /**
     * @test
     */
    public function testCreateVarian()
    {
        $varian = $this->fakeVarianData();
        $this->json('POST', '/api/v1/varians', $varian);

        $this->assertApiResponse($varian);
    }

    /**
     * @test
     */
    public function testReadVarian()
    {
        $varian = $this->makeVarian();
        $this->json('GET', '/api/v1/varians/'.$varian->id);

        $this->assertApiResponse($varian->toArray());
    }

    /**
     * @test
     */
    public function testUpdateVarian()
    {
        $varian = $this->makeVarian();
        $editedVarian = $this->fakeVarianData();

        $this->json('PUT', '/api/v1/varians/'.$varian->id, $editedVarian);

        $this->assertApiResponse($editedVarian);
    }

    /**
     * @test
     */
    public function testDeleteVarian()
    {
        $varian = $this->makeVarian();
        $this->json('DELETE', '/api/v1/varians/'.$varian->id);

        $this->assertApiSuccess();
        $this->json('GET', '/api/v1/varians/'.$varian->id);

        $this->assertResponseStatus(404);
    }
}
