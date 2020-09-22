<?php

use App\Models\Certification;
use App\Repositories\CertificationRepository;
use Illuminate\Foundation\Testing\DatabaseTransactions;

class CertificationRepositoryTest extends TestCase
{
    use MakeCertificationTrait, ApiTestTrait, DatabaseTransactions;

    /**
     * @var CertificationRepository
     */
    protected $certificationRepo;

    public function setUp()
    {
        parent::setUp();
        $this->certificationRepo = App::make(CertificationRepository::class);
    }

    /**
     * @test create
     */
    public function testCreateCertification()
    {
        $certification = $this->fakeCertificationData();
        $createdCertification = $this->certificationRepo->create($certification);
        $createdCertification = $createdCertification->toArray();
        $this->assertArrayHasKey('id', $createdCertification);
        $this->assertNotNull($createdCertification['id'], 'Created Certification must have id specified');
        $this->assertNotNull(Certification::find($createdCertification['id']), 'Certification with given id must be in DB');
        $this->assertModelData($certification, $createdCertification);
    }

    /**
     * @test read
     */
    public function testReadCertification()
    {
        $certification = $this->makeCertification();
        $dbCertification = $this->certificationRepo->find($certification->id);
        $dbCertification = $dbCertification->toArray();
        $this->assertModelData($certification->toArray(), $dbCertification);
    }

    /**
     * @test update
     */
    public function testUpdateCertification()
    {
        $certification = $this->makeCertification();
        $fakeCertification = $this->fakeCertificationData();
        $updatedCertification = $this->certificationRepo->update($fakeCertification, $certification->id);
        $this->assertModelData($fakeCertification, $updatedCertification->toArray());
        $dbCertification = $this->certificationRepo->find($certification->id);
        $this->assertModelData($fakeCertification, $dbCertification->toArray());
    }

    /**
     * @test delete
     */
    public function testDeleteCertification()
    {
        $certification = $this->makeCertification();
        $resp = $this->certificationRepo->delete($certification->id);
        $this->assertTrue($resp);
        $this->assertNull(Certification::find($certification->id), 'Certification should not exist in DB');
    }
}
