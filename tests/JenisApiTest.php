<?php

use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseTransactions;

class JenisApiTest extends TestCase
{
    use MakeJenisTrait, ApiTestTrait, WithoutMiddleware, DatabaseTransactions;

    /**
     * @test
     */
    public function testCreateJenis()
    {
        $jenis = $this->fakeJenisData();
        $this->json('POST', '/api/v1/jenis', $jenis);

        $this->assertApiResponse($jenis);
    }

    /**
     * @test
     */
    public function testReadJenis()
    {
        $jenis = $this->makeJenis();
        $this->json('GET', '/api/v1/jenis/'.$jenis->id);

        $this->assertApiResponse($jenis->toArray());
    }

    /**
     * @test
     */
    public function testUpdateJenis()
    {
        $jenis = $this->makeJenis();
        $editedJenis = $this->fakeJenisData();

        $this->json('PUT', '/api/v1/jenis/'.$jenis->id, $editedJenis);

        $this->assertApiResponse($editedJenis);
    }

    /**
     * @test
     */
    public function testDeleteJenis()
    {
        $jenis = $this->makeJenis();
        $this->json('DELETE', '/api/v1/jenis/'.$jenis->id);

        $this->assertApiSuccess();
        $this->json('GET', '/api/v1/jenis/'.$jenis->id);

        $this->assertResponseStatus(404);
    }
}
