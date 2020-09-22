<?php

use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseTransactions;

class ShareApiTest extends TestCase
{
    use MakeShareTrait, ApiTestTrait, WithoutMiddleware, DatabaseTransactions;

    /**
     * @test
     */
    public function testCreateShare()
    {
        $share = $this->fakeShareData();
        $this->json('POST', '/api/v1/shares', $share);

        $this->assertApiResponse($share);
    }

    /**
     * @test
     */
    public function testReadShare()
    {
        $share = $this->makeShare();
        $this->json('GET', '/api/v1/shares/'.$share->id);

        $this->assertApiResponse($share->toArray());
    }

    /**
     * @test
     */
    public function testUpdateShare()
    {
        $share = $this->makeShare();
        $editedShare = $this->fakeShareData();

        $this->json('PUT', '/api/v1/shares/'.$share->id, $editedShare);

        $this->assertApiResponse($editedShare);
    }

    /**
     * @test
     */
    public function testDeleteShare()
    {
        $share = $this->makeShare();
        $this->json('DELETE', '/api/v1/shares/'.$share->id);

        $this->assertApiSuccess();
        $this->json('GET', '/api/v1/shares/'.$share->id);

        $this->assertResponseStatus(404);
    }
}
