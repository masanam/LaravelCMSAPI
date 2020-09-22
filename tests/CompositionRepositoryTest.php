<?php

use App\Models\Composition;
use App\Repositories\CompositionRepository;
use Illuminate\Foundation\Testing\DatabaseTransactions;

class CompositionRepositoryTest extends TestCase
{
    use MakeCompositionTrait, ApiTestTrait, DatabaseTransactions;

    /**
     * @var CompositionRepository
     */
    protected $compositionRepo;

    public function setUp()
    {
        parent::setUp();
        $this->compositionRepo = App::make(CompositionRepository::class);
    }

    /**
     * @test create
     */
    public function testCreateComposition()
    {
        $composition = $this->fakeCompositionData();
        $createdComposition = $this->compositionRepo->create($composition);
        $createdComposition = $createdComposition->toArray();
        $this->assertArrayHasKey('id', $createdComposition);
        $this->assertNotNull($createdComposition['id'], 'Created Composition must have id specified');
        $this->assertNotNull(Composition::find($createdComposition['id']), 'Composition with given id must be in DB');
        $this->assertModelData($composition, $createdComposition);
    }

    /**
     * @test read
     */
    public function testReadComposition()
    {
        $composition = $this->makeComposition();
        $dbComposition = $this->compositionRepo->find($composition->id);
        $dbComposition = $dbComposition->toArray();
        $this->assertModelData($composition->toArray(), $dbComposition);
    }

    /**
     * @test update
     */
    public function testUpdateComposition()
    {
        $composition = $this->makeComposition();
        $fakeComposition = $this->fakeCompositionData();
        $updatedComposition = $this->compositionRepo->update($fakeComposition, $composition->id);
        $this->assertModelData($fakeComposition, $updatedComposition->toArray());
        $dbComposition = $this->compositionRepo->find($composition->id);
        $this->assertModelData($fakeComposition, $dbComposition->toArray());
    }

    /**
     * @test delete
     */
    public function testDeleteComposition()
    {
        $composition = $this->makeComposition();
        $resp = $this->compositionRepo->delete($composition->id);
        $this->assertTrue($resp);
        $this->assertNull(Composition::find($composition->id), 'Composition should not exist in DB');
    }
}
