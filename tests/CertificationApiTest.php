<?php

use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseTransactions;

class CertificationApiTest extends TestCase
{
    use MakeCertificationTrait, ApiTestTrait, WithoutMiddleware, DatabaseTransactions;

    /**
     * @test
     */
    public function testCreateCertification()
    {
        $certification = $this->fakeCertificationData();
        $this->json('POST', '/api/v1/certifications', $certification);

        $this->assertApiResponse($certification);
    }

    /**
     * @test
     */
    public function testReadCertification()
    {
        $certification = $this->makeCertification();
        $this->json('GET', '/api/v1/certifications/'.$certification->id);

        $this->assertApiResponse($certification->toArray());
    }

    /**
     * @test
     */
    public function testUpdateCertification()
    {
        $certification = $this->makeCertification();
        $editedCertification = $this->fakeCertificationData();

        $this->json('PUT', '/api/v1/certifications/'.$certification->id, $editedCertification);

        $this->assertApiResponse($editedCertification);
    }

    /**
     * @test
     */
    public function testDeleteCertification()
    {
        $certification = $this->makeCertification();
        $this->json('DELETE', '/api/v1/certifications/'.$certification->id);

        $this->assertApiSuccess();
        $this->json('GET', '/api/v1/certifications/'.$certification->id);

        $this->assertResponseStatus(404);
    }
}
