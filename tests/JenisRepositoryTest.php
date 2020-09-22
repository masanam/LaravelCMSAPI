<?php

use App\Models\Jenis;
use App\Repositories\JenisRepository;
use Illuminate\Foundation\Testing\DatabaseTransactions;

class JenisRepositoryTest extends TestCase
{
    use MakeJenisTrait, ApiTestTrait, DatabaseTransactions;

    /**
     * @var JenisRepository
     */
    protected $jenisRepo;

    public function setUp()
    {
        parent::setUp();
        $this->jenisRepo = App::make(JenisRepository::class);
    }

    /**
     * @test create
     */
    public function testCreateJenis()
    {
        $jenis = $this->fakeJenisData();
        $createdJenis = $this->jenisRepo->create($jenis);
        $createdJenis = $createdJenis->toArray();
        $this->assertArrayHasKey('id', $createdJenis);
        $this->assertNotNull($createdJenis['id'], 'Created Jenis must have id specified');
        $this->assertNotNull(Jenis::find($createdJenis['id']), 'Jenis with given id must be in DB');
        $this->assertModelData($jenis, $createdJenis);
    }

    /**
     * @test read
     */
    public function testReadJenis()
    {
        $jenis = $this->makeJenis();
        $dbJenis = $this->jenisRepo->find($jenis->id);
        $dbJenis = $dbJenis->toArray();
        $this->assertModelData($jenis->toArray(), $dbJenis);
    }

    /**
     * @test update
     */
    public function testUpdateJenis()
    {
        $jenis = $this->makeJenis();
        $fakeJenis = $this->fakeJenisData();
        $updatedJenis = $this->jenisRepo->update($fakeJenis, $jenis->id);
        $this->assertModelData($fakeJenis, $updatedJenis->toArray());
        $dbJenis = $this->jenisRepo->find($jenis->id);
        $this->assertModelData($fakeJenis, $dbJenis->toArray());
    }

    /**
     * @test delete
     */
    public function testDeleteJenis()
    {
        $jenis = $this->makeJenis();
        $resp = $this->jenisRepo->delete($jenis->id);
        $this->assertTrue($resp);
        $this->assertNull(Jenis::find($jenis->id), 'Jenis should not exist in DB');
    }
}
