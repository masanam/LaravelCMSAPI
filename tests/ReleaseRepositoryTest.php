<?php

use App\Models\Release;
use App\Repositories\ReleaseRepository;
use Illuminate\Foundation\Testing\DatabaseTransactions;

class ReleaseRepositoryTest extends TestCase
{
    use MakeReleaseTrait, ApiTestTrait, DatabaseTransactions;

    /**
     * @var ReleaseRepository
     */
    protected $releaseRepo;

    public function setUp()
    {
        parent::setUp();
        $this->releaseRepo = App::make(ReleaseRepository::class);
    }

    /**
     * @test create
     */
    public function testCreateRelease()
    {
        $release = $this->fakeReleaseData();
        $createdRelease = $this->releaseRepo->create($release);
        $createdRelease = $createdRelease->toArray();
        $this->assertArrayHasKey('id', $createdRelease);
        $this->assertNotNull($createdRelease['id'], 'Created Release must have id specified');
        $this->assertNotNull(Release::find($createdRelease['id']), 'Release with given id must be in DB');
        $this->assertModelData($release, $createdRelease);
    }

    /**
     * @test read
     */
    public function testReadRelease()
    {
        $release = $this->makeRelease();
        $dbRelease = $this->releaseRepo->find($release->id);
        $dbRelease = $dbRelease->toArray();
        $this->assertModelData($release->toArray(), $dbRelease);
    }

    /**
     * @test update
     */
    public function testUpdateRelease()
    {
        $release = $this->makeRelease();
        $fakeRelease = $this->fakeReleaseData();
        $updatedRelease = $this->releaseRepo->update($fakeRelease, $release->id);
        $this->assertModelData($fakeRelease, $updatedRelease->toArray());
        $dbRelease = $this->releaseRepo->find($release->id);
        $this->assertModelData($fakeRelease, $dbRelease->toArray());
    }

    /**
     * @test delete
     */
    public function testDeleteRelease()
    {
        $release = $this->makeRelease();
        $resp = $this->releaseRepo->delete($release->id);
        $this->assertTrue($resp);
        $this->assertNull(Release::find($release->id), 'Release should not exist in DB');
    }
}
