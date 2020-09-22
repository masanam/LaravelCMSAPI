<?php

use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseTransactions;

class HeaderApiTest extends TestCase
{
    use MakeHeaderTrait, ApiTestTrait, WithoutMiddleware, DatabaseTransactions;

    /**
     * @test
     */
    public function testCreateHeader()
    {
        $header = $this->fakeHeaderData();
        $this->json('POST', '/api/v1/headers', $header);

        $this->assertApiResponse($header);
    }

    /**
     * @test
     */
    public function testReadHeader()
    {
        $header = $this->makeHeader();
        $this->json('GET', '/api/v1/headers/'.$header->id);

        $this->assertApiResponse($header->toArray());
    }

    /**
     * @test
     */
    public function testUpdateHeader()
    {
        $header = $this->makeHeader();
        $editedHeader = $this->fakeHeaderData();

        $this->json('PUT', '/api/v1/headers/'.$header->id, $editedHeader);

        $this->assertApiResponse($editedHeader);
    }

    /**
     * @test
     */
    public function testDeleteHeader()
    {
        $header = $this->makeHeader();
        $this->json('DELETE', '/api/v1/headers/'.$header->id);

        $this->assertApiSuccess();
        $this->json('GET', '/api/v1/headers/'.$header->id);

        $this->assertResponseStatus(404);
    }
}
