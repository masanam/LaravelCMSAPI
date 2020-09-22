<?php

use App\Models\Investor;
use App\Repositories\InvestorRepository;
use Illuminate\Foundation\Testing\DatabaseTransactions;

class InvestorRepositoryTest extends TestCase
{
    use MakeInvestorTrait, ApiTestTrait, DatabaseTransactions;

    /**
     * @var InvestorRepository
     */
    protected $investorRepo;

    public function setUp()
    {
        parent::setUp();
        $this->investorRepo = App::make(InvestorRepository::class);
    }

    /**
     * @test create
     */
    public function testCreateInvestor()
    {
        $investor = $this->fakeInvestorData();
        $createdInvestor = $this->investorRepo->create($investor);
        $createdInvestor = $createdInvestor->toArray();
        $this->assertArrayHasKey('id', $createdInvestor);
        $this->assertNotNull($createdInvestor['id'], 'Created Investor must have id specified');
        $this->assertNotNull(Investor::find($createdInvestor['id']), 'Investor with given id must be in DB');
        $this->assertModelData($investor, $createdInvestor);
    }

    /**
     * @test read
     */
    public function testReadInvestor()
    {
        $investor = $this->makeInvestor();
        $dbInvestor = $this->investorRepo->find($investor->id);
        $dbInvestor = $dbInvestor->toArray();
        $this->assertModelData($investor->toArray(), $dbInvestor);
    }

    /**
     * @test update
     */
    public function testUpdateInvestor()
    {
        $investor = $this->makeInvestor();
        $fakeInvestor = $this->fakeInvestorData();
        $updatedInvestor = $this->investorRepo->update($fakeInvestor, $investor->id);
        $this->assertModelData($fakeInvestor, $updatedInvestor->toArray());
        $dbInvestor = $this->investorRepo->find($investor->id);
        $this->assertModelData($fakeInvestor, $dbInvestor->toArray());
    }

    /**
     * @test delete
     */
    public function testDeleteInvestor()
    {
        $investor = $this->makeInvestor();
        $resp = $this->investorRepo->delete($investor->id);
        $this->assertTrue($resp);
        $this->assertNull(Investor::find($investor->id), 'Investor should not exist in DB');
    }
}
