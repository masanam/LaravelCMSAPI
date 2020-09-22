<?php

use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseTransactions;

class CompositionApiTest extends TestCase
{
    use MakeCompositionTrait, ApiTestTrait, WithoutMiddleware, DatabaseTransactions;

    /**
     * @test
     */
    public function testCreateComposition()
    {
        $composition = $this->fakeCompositionData();
        $this->json('POST', '/api/v1/compositions', $composition);

        $this->assertApiResponse($composition);
    }

    /**
     * @test
     */
    public function testReadComposition()
    {
        $composition = $this->makeComposition();
        $this->json('GET', '/api/v1/compositions/'.$composition->id);

        $this->assertApiResponse($composition->toArray());
    }

    /**
     * @test
     */
    public function testUpdateComposition()
    {
        $composition = $this->makeComposition();
        $editedComposition = $this->fakeCompositionData();

        $this->json('PUT', '/api/v1/compositions/'.$composition->id, $editedComposition);

        $this->assertApiResponse($editedComposition);
    }

    /**
     * @test
     */
    public function testDeleteComposition()
    {
        $composition = $this->makeComposition();
        $this->json('DELETE', '/api/v1/compositions/'.$composition->id);

        $this->assertApiSuccess();
        $this->json('GET', '/api/v1/compositions/'.$composition->id);

        $this->assertResponseStatus(404);
    }
}
