<?php

use App\Models\Part;
use App\Repositories\PartRepository;
use Illuminate\Foundation\Testing\DatabaseTransactions;

class PartRepositoryTest extends TestCase
{
    use MakePartTrait, ApiTestTrait, DatabaseTransactions;

    /**
     * @var PartRepository
     */
    protected $partRepo;

    public function setUp()
    {
        parent::setUp();
        $this->partRepo = App::make(PartRepository::class);
    }

    /**
     * @test create
     */
    public function testCreatePart()
    {
        $part = $this->fakePartData();
        $createdPart = $this->partRepo->create($part);
        $createdPart = $createdPart->toArray();
        $this->assertArrayHasKey('id', $createdPart);
        $this->assertNotNull($createdPart['id'], 'Created Part must have id specified');
        $this->assertNotNull(Part::find($createdPart['id']), 'Part with given id must be in DB');
        $this->assertModelData($part, $createdPart);
    }

    /**
     * @test read
     */
    public function testReadPart()
    {
        $part = $this->makePart();
        $dbPart = $this->partRepo->find($part->id);
        $dbPart = $dbPart->toArray();
        $this->assertModelData($part->toArray(), $dbPart);
    }

    /**
     * @test update
     */
    public function testUpdatePart()
    {
        $part = $this->makePart();
        $fakePart = $this->fakePartData();
        $updatedPart = $this->partRepo->update($fakePart, $part->id);
        $this->assertModelData($fakePart, $updatedPart->toArray());
        $dbPart = $this->partRepo->find($part->id);
        $this->assertModelData($fakePart, $dbPart->toArray());
    }

    /**
     * @test delete
     */
    public function testDeletePart()
    {
        $part = $this->makePart();
        $resp = $this->partRepo->delete($part->id);
        $this->assertTrue($resp);
        $this->assertNull(Part::find($part->id), 'Part should not exist in DB');
    }
}
