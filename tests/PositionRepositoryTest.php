<?php

use App\Models\Position;
use App\Repositories\PositionRepository;
use Illuminate\Foundation\Testing\DatabaseTransactions;

class PositionRepositoryTest extends TestCase
{
    use MakePositionTrait, ApiTestTrait, DatabaseTransactions;

    /**
     * @var PositionRepository
     */
    protected $positionRepo;

    public function setUp()
    {
        parent::setUp();
        $this->positionRepo = App::make(PositionRepository::class);
    }

    /**
     * @test create
     */
    public function testCreatePosition()
    {
        $position = $this->fakePositionData();
        $createdPosition = $this->positionRepo->create($position);
        $createdPosition = $createdPosition->toArray();
        $this->assertArrayHasKey('id', $createdPosition);
        $this->assertNotNull($createdPosition['id'], 'Created Position must have id specified');
        $this->assertNotNull(Position::find($createdPosition['id']), 'Position with given id must be in DB');
        $this->assertModelData($position, $createdPosition);
    }

    /**
     * @test read
     */
    public function testReadPosition()
    {
        $position = $this->makePosition();
        $dbPosition = $this->positionRepo->find($position->id);
        $dbPosition = $dbPosition->toArray();
        $this->assertModelData($position->toArray(), $dbPosition);
    }

    /**
     * @test update
     */
    public function testUpdatePosition()
    {
        $position = $this->makePosition();
        $fakePosition = $this->fakePositionData();
        $updatedPosition = $this->positionRepo->update($fakePosition, $position->id);
        $this->assertModelData($fakePosition, $updatedPosition->toArray());
        $dbPosition = $this->positionRepo->find($position->id);
        $this->assertModelData($fakePosition, $dbPosition->toArray());
    }

    /**
     * @test delete
     */
    public function testDeletePosition()
    {
        $position = $this->makePosition();
        $resp = $this->positionRepo->delete($position->id);
        $this->assertTrue($resp);
        $this->assertNull(Position::find($position->id), 'Position should not exist in DB');
    }
}
