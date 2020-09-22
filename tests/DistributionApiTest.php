<?php

use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseTransactions;

class DistributionApiTest extends TestCase
{
    use MakeDistributionTrait, ApiTestTrait, WithoutMiddleware, DatabaseTransactions;

    /**
     * @test
     */
    public function testCreateDistribution()
    {
        $distribution = $this->fakeDistributionData();
        $this->json('POST', '/api/v1/distributions', $distribution);

        $this->assertApiResponse($distribution);
    }

    /**
     * @test
     */
    public function testReadDistribution()
    {
        $distribution = $this->makeDistribution();
        $this->json('GET', '/api/v1/distributions/'.$distribution->id);

        $this->assertApiResponse($distribution->toArray());
    }

    /**
     * @test
     */
    public function testUpdateDistribution()
    {
        $distribution = $this->makeDistribution();
        $editedDistribution = $this->fakeDistributionData();

        $this->json('PUT', '/api/v1/distributions/'.$distribution->id, $editedDistribution);

        $this->assertApiResponse($editedDistribution);
    }

    /**
     * @test
     */
    public function testDeleteDistribution()
    {
        $distribution = $this->makeDistribution();
        $this->json('DELETE', '/api/v1/distributions/'.$distribution->id);

        $this->assertApiSuccess();
        $this->json('GET', '/api/v1/distributions/'.$distribution->id);

        $this->assertResponseStatus(404);
    }
}
