<?php

use App\Models\Dividen;
use App\Repositories\DividenRepository;
use Illuminate\Foundation\Testing\DatabaseTransactions;

class DividenRepositoryTest extends TestCase
{
    use MakeDividenTrait, ApiTestTrait, DatabaseTransactions;

    /**
     * @var DividenRepository
     */
    protected $dividenRepo;

    public function setUp()
    {
        parent::setUp();
        $this->dividenRepo = App::make(DividenRepository::class);
    }

    /**
     * @test create
     */
    public function testCreateDividen()
    {
        $dividen = $this->fakeDividenData();
        $createdDividen = $this->dividenRepo->create($dividen);
        $createdDividen = $createdDividen->toArray();
        $this->assertArrayHasKey('id', $createdDividen);
        $this->assertNotNull($createdDividen['id'], 'Created Dividen must have id specified');
        $this->assertNotNull(Dividen::find($createdDividen['id']), 'Dividen with given id must be in DB');
        $this->assertModelData($dividen, $createdDividen);
    }

    /**
     * @test read
     */
    public function testReadDividen()
    {
        $dividen = $this->makeDividen();
        $dbDividen = $this->dividenRepo->find($dividen->id);
        $dbDividen = $dbDividen->toArray();
        $this->assertModelData($dividen->toArray(), $dbDividen);
    }

    /**
     * @test update
     */
    public function testUpdateDividen()
    {
        $dividen = $this->makeDividen();
        $fakeDividen = $this->fakeDividenData();
        $updatedDividen = $this->dividenRepo->update($fakeDividen, $dividen->id);
        $this->assertModelData($fakeDividen, $updatedDividen->toArray());
        $dbDividen = $this->dividenRepo->find($dividen->id);
        $this->assertModelData($fakeDividen, $dbDividen->toArray());
    }

    /**
     * @test delete
     */
    public function testDeleteDividen()
    {
        $dividen = $this->makeDividen();
        $resp = $this->dividenRepo->delete($dividen->id);
        $this->assertTrue($resp);
        $this->assertNull(Dividen::find($dividen->id), 'Dividen should not exist in DB');
    }
}
