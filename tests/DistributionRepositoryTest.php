<?php

use App\Models\Distribution;
use App\Repositories\DistributionRepository;
use Illuminate\Foundation\Testing\DatabaseTransactions;

class DistributionRepositoryTest extends TestCase
{
    use MakeDistributionTrait, ApiTestTrait, DatabaseTransactions;

    /**
     * @var DistributionRepository
     */
    protected $distributionRepo;

    public function setUp()
    {
        parent::setUp();
        $this->distributionRepo = App::make(DistributionRepository::class);
    }

    /**
     * @test create
     */
    public function testCreateDistribution()
    {
        $distribution = $this->fakeDistributionData();
        $createdDistribution = $this->distributionRepo->create($distribution);
        $createdDistribution = $createdDistribution->toArray();
        $this->assertArrayHasKey('id', $createdDistribution);
        $this->assertNotNull($createdDistribution['id'], 'Created Distribution must have id specified');
        $this->assertNotNull(Distribution::find($createdDistribution['id']), 'Distribution with given id must be in DB');
        $this->assertModelData($distribution, $createdDistribution);
    }

    /**
     * @test read
     */
    public function testReadDistribution()
    {
        $distribution = $this->makeDistribution();
        $dbDistribution = $this->distributionRepo->find($distribution->id);
        $dbDistribution = $dbDistribution->toArray();
        $this->assertModelData($distribution->toArray(), $dbDistribution);
    }

    /**
     * @test update
     */
    public function testUpdateDistribution()
    {
        $distribution = $this->makeDistribution();
        $fakeDistribution = $this->fakeDistributionData();
        $updatedDistribution = $this->distributionRepo->update($fakeDistribution, $distribution->id);
        $this->assertModelData($fakeDistribution, $updatedDistribution->toArray());
        $dbDistribution = $this->distributionRepo->find($distribution->id);
        $this->assertModelData($fakeDistribution, $dbDistribution->toArray());
    }

    /**
     * @test delete
     */
    public function testDeleteDistribution()
    {
        $distribution = $this->makeDistribution();
        $resp = $this->distributionRepo->delete($distribution->id);
        $this->assertTrue($resp);
        $this->assertNull(Distribution::find($distribution->id), 'Distribution should not exist in DB');
    }
}
