<?php

use App\Models\Registrant;
use App\Repositories\RegistrantRepository;
use Illuminate\Foundation\Testing\DatabaseTransactions;

class RegistrantRepositoryTest extends TestCase
{
    use MakeRegistrantTrait, ApiTestTrait, DatabaseTransactions;

    /**
     * @var RegistrantRepository
     */
    protected $registrantRepo;

    public function setUp()
    {
        parent::setUp();
        $this->registrantRepo = App::make(RegistrantRepository::class);
    }

    /**
     * @test create
     */
    public function testCreateRegistrant()
    {
        $registrant = $this->fakeRegistrantData();
        $createdRegistrant = $this->registrantRepo->create($registrant);
        $createdRegistrant = $createdRegistrant->toArray();
        $this->assertArrayHasKey('id', $createdRegistrant);
        $this->assertNotNull($createdRegistrant['id'], 'Created Registrant must have id specified');
        $this->assertNotNull(Registrant::find($createdRegistrant['id']), 'Registrant with given id must be in DB');
        $this->assertModelData($registrant, $createdRegistrant);
    }

    /**
     * @test read
     */
    public function testReadRegistrant()
    {
        $registrant = $this->makeRegistrant();
        $dbRegistrant = $this->registrantRepo->find($registrant->id);
        $dbRegistrant = $dbRegistrant->toArray();
        $this->assertModelData($registrant->toArray(), $dbRegistrant);
    }

    /**
     * @test update
     */
    public function testUpdateRegistrant()
    {
        $registrant = $this->makeRegistrant();
        $fakeRegistrant = $this->fakeRegistrantData();
        $updatedRegistrant = $this->registrantRepo->update($fakeRegistrant, $registrant->id);
        $this->assertModelData($fakeRegistrant, $updatedRegistrant->toArray());
        $dbRegistrant = $this->registrantRepo->find($registrant->id);
        $this->assertModelData($fakeRegistrant, $dbRegistrant->toArray());
    }

    /**
     * @test delete
     */
    public function testDeleteRegistrant()
    {
        $registrant = $this->makeRegistrant();
        $resp = $this->registrantRepo->delete($registrant->id);
        $this->assertTrue($resp);
        $this->assertNull(Registrant::find($registrant->id), 'Registrant should not exist in DB');
    }
}
