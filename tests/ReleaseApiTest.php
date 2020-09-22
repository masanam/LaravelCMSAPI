<?php

use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseTransactions;

class ReleaseApiTest extends TestCase
{
    use MakeReleaseTrait, ApiTestTrait, WithoutMiddleware, DatabaseTransactions;

    /**
     * @test
     */
    public function testCreateRelease()
    {
        $release = $this->fakeReleaseData();
        $this->json('POST', '/api/v1/releases', $release);

        $this->assertApiResponse($release);
    }

    /**
     * @test
     */
    public function testReadRelease()
    {
        $release = $this->makeRelease();
        $this->json('GET', '/api/v1/releases/'.$release->id);

        $this->assertApiResponse($release->toArray());
    }

    /**
     * @test
     */
    public function testUpdateRelease()
    {
        $release = $this->makeRelease();
        $editedRelease = $this->fakeReleaseData();

        $this->json('PUT', '/api/v1/releases/'.$release->id, $editedRelease);

        $this->assertApiResponse($editedRelease);
    }

    /**
     * @test
     */
    public function testDeleteRelease()
    {
        $release = $this->makeRelease();
        $this->json('DELETE', '/api/v1/releases/'.$release->id);

        $this->assertApiSuccess();
        $this->json('GET', '/api/v1/releases/'.$release->id);

        $this->assertResponseStatus(404);
    }
}
