<?php

use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseTransactions;

class RegistrantApiTest extends TestCase
{
    use MakeRegistrantTrait, ApiTestTrait, WithoutMiddleware, DatabaseTransactions;

    /**
     * @test
     */
    public function testCreateRegistrant()
    {
        $registrant = $this->fakeRegistrantData();
        $this->json('POST', '/api/v1/registrants', $registrant);

        $this->assertApiResponse($registrant);
    }

    /**
     * @test
     */
    public function testReadRegistrant()
    {
        $registrant = $this->makeRegistrant();
        $this->json('GET', '/api/v1/registrants/'.$registrant->id);

        $this->assertApiResponse($registrant->toArray());
    }

    /**
     * @test
     */
    public function testUpdateRegistrant()
    {
        $registrant = $this->makeRegistrant();
        $editedRegistrant = $this->fakeRegistrantData();

        $this->json('PUT', '/api/v1/registrants/'.$registrant->id, $editedRegistrant);

        $this->assertApiResponse($editedRegistrant);
    }

    /**
     * @test
     */
    public function testDeleteRegistrant()
    {
        $registrant = $this->makeRegistrant();
        $this->json('DELETE', '/api/v1/registrants/'.$registrant->id);

        $this->assertApiSuccess();
        $this->json('GET', '/api/v1/registrants/'.$registrant->id);

        $this->assertResponseStatus(404);
    }
}
