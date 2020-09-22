<?php

use App\Models\Career;
use App\Repositories\CareerRepository;
use Illuminate\Foundation\Testing\DatabaseTransactions;

class CareerRepositoryTest extends TestCase
{
    use MakeCareerTrait, ApiTestTrait, DatabaseTransactions;

    /**
     * @var CareerRepository
     */
    protected $careerRepo;

    public function setUp()
    {
        parent::setUp();
        $this->careerRepo = App::make(CareerRepository::class);
    }

    /**
     * @test create
     */
    public function testCreateCareer()
    {
        $career = $this->fakeCareerData();
        $createdCareer = $this->careerRepo->create($career);
        $createdCareer = $createdCareer->toArray();
        $this->assertArrayHasKey('id', $createdCareer);
        $this->assertNotNull($createdCareer['id'], 'Created Career must have id specified');
        $this->assertNotNull(Career::find($createdCareer['id']), 'Career with given id must be in DB');
        $this->assertModelData($career, $createdCareer);
    }

    /**
     * @test read
     */
    public function testReadCareer()
    {
        $career = $this->makeCareer();
        $dbCareer = $this->careerRepo->find($career->id);
        $dbCareer = $dbCareer->toArray();
        $this->assertModelData($career->toArray(), $dbCareer);
    }

    /**
     * @test update
     */
    public function testUpdateCareer()
    {
        $career = $this->makeCareer();
        $fakeCareer = $this->fakeCareerData();
        $updatedCareer = $this->careerRepo->update($fakeCareer, $career->id);
        $this->assertModelData($fakeCareer, $updatedCareer->toArray());
        $dbCareer = $this->careerRepo->find($career->id);
        $this->assertModelData($fakeCareer, $dbCareer->toArray());
    }

    /**
     * @test delete
     */
    public function testDeleteCareer()
    {
        $career = $this->makeCareer();
        $resp = $this->careerRepo->delete($career->id);
        $this->assertTrue($resp);
        $this->assertNull(Career::find($career->id), 'Career should not exist in DB');
    }
}
