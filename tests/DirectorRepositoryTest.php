<?php

use App\Models\Director;
use App\Repositories\DirectorRepository;
use Illuminate\Foundation\Testing\DatabaseTransactions;

class DirectorRepositoryTest extends TestCase
{
    use MakeDirectorTrait, ApiTestTrait, DatabaseTransactions;

    /**
     * @var DirectorRepository
     */
    protected $directorRepo;

    public function setUp()
    {
        parent::setUp();
        $this->directorRepo = App::make(DirectorRepository::class);
    }

    /**
     * @test create
     */
    public function testCreateDirector()
    {
        $director = $this->fakeDirectorData();
        $createdDirector = $this->directorRepo->create($director);
        $createdDirector = $createdDirector->toArray();
        $this->assertArrayHasKey('id', $createdDirector);
        $this->assertNotNull($createdDirector['id'], 'Created Director must have id specified');
        $this->assertNotNull(Director::find($createdDirector['id']), 'Director with given id must be in DB');
        $this->assertModelData($director, $createdDirector);
    }

    /**
     * @test read
     */
    public function testReadDirector()
    {
        $director = $this->makeDirector();
        $dbDirector = $this->directorRepo->find($director->id);
        $dbDirector = $dbDirector->toArray();
        $this->assertModelData($director->toArray(), $dbDirector);
    }

    /**
     * @test update
     */
    public function testUpdateDirector()
    {
        $director = $this->makeDirector();
        $fakeDirector = $this->fakeDirectorData();
        $updatedDirector = $this->directorRepo->update($fakeDirector, $director->id);
        $this->assertModelData($fakeDirector, $updatedDirector->toArray());
        $dbDirector = $this->directorRepo->find($director->id);
        $this->assertModelData($fakeDirector, $dbDirector->toArray());
    }

    /**
     * @test delete
     */
    public function testDeleteDirector()
    {
        $director = $this->makeDirector();
        $resp = $this->directorRepo->delete($director->id);
        $this->assertTrue($resp);
        $this->assertNull(Director::find($director->id), 'Director should not exist in DB');
    }
}
