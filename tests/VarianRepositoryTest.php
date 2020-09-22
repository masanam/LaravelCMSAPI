<?php

use App\Models\Varian;
use App\Repositories\VarianRepository;
use Illuminate\Foundation\Testing\DatabaseTransactions;

class VarianRepositoryTest extends TestCase
{
    use MakeVarianTrait, ApiTestTrait, DatabaseTransactions;

    /**
     * @var VarianRepository
     */
    protected $varianRepo;

    public function setUp()
    {
        parent::setUp();
        $this->varianRepo = App::make(VarianRepository::class);
    }

    /**
     * @test create
     */
    public function testCreateVarian()
    {
        $varian = $this->fakeVarianData();
        $createdVarian = $this->varianRepo->create($varian);
        $createdVarian = $createdVarian->toArray();
        $this->assertArrayHasKey('id', $createdVarian);
        $this->assertNotNull($createdVarian['id'], 'Created Varian must have id specified');
        $this->assertNotNull(Varian::find($createdVarian['id']), 'Varian with given id must be in DB');
        $this->assertModelData($varian, $createdVarian);
    }

    /**
     * @test read
     */
    public function testReadVarian()
    {
        $varian = $this->makeVarian();
        $dbVarian = $this->varianRepo->find($varian->id);
        $dbVarian = $dbVarian->toArray();
        $this->assertModelData($varian->toArray(), $dbVarian);
    }

    /**
     * @test update
     */
    public function testUpdateVarian()
    {
        $varian = $this->makeVarian();
        $fakeVarian = $this->fakeVarianData();
        $updatedVarian = $this->varianRepo->update($fakeVarian, $varian->id);
        $this->assertModelData($fakeVarian, $updatedVarian->toArray());
        $dbVarian = $this->varianRepo->find($varian->id);
        $this->assertModelData($fakeVarian, $dbVarian->toArray());
    }

    /**
     * @test delete
     */
    public function testDeleteVarian()
    {
        $varian = $this->makeVarian();
        $resp = $this->varianRepo->delete($varian->id);
        $this->assertTrue($resp);
        $this->assertNull(Varian::find($varian->id), 'Varian should not exist in DB');
    }
}
