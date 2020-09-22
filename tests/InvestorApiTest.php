<?php

use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseTransactions;

class InvestorApiTest extends TestCase
{
    use MakeInvestorTrait, ApiTestTrait, WithoutMiddleware, DatabaseTransactions;

    /**
     * @test
     */
    public function testCreateInvestor()
    {
        $investor = $this->fakeInvestorData();
        $this->json('POST', '/api/v1/investors', $investor);

        $this->assertApiResponse($investor);
    }

    /**
     * @test
     */
    public function testReadInvestor()
    {
        $investor = $this->makeInvestor();
        $this->json('GET', '/api/v1/investors/'.$investor->id);

        $this->assertApiResponse($investor->toArray());
    }

    /**
     * @test
     */
    public function testUpdateInvestor()
    {
        $investor = $this->makeInvestor();
        $editedInvestor = $this->fakeInvestorData();

        $this->json('PUT', '/api/v1/investors/'.$investor->id, $editedInvestor);

        $this->assertApiResponse($editedInvestor);
    }

    /**
     * @test
     */
    public function testDeleteInvestor()
    {
        $investor = $this->makeInvestor();
        $this->json('DELETE', '/api/v1/investors/'.$investor->id);

        $this->assertApiSuccess();
        $this->json('GET', '/api/v1/investors/'.$investor->id);

        $this->assertResponseStatus(404);
    }
}
