<?php

use App\Models\Share;
use App\Repositories\ShareRepository;
use Illuminate\Foundation\Testing\DatabaseTransactions;

class ShareRepositoryTest extends TestCase
{
    use MakeShareTrait, ApiTestTrait, DatabaseTransactions;

    /**
     * @var ShareRepository
     */
    protected $shareRepo;

    public function setUp()
    {
        parent::setUp();
        $this->shareRepo = App::make(ShareRepository::class);
    }

    /**
     * @test create
     */
    public function testCreateShare()
    {
        $share = $this->fakeShareData();
        $createdShare = $this->shareRepo->create($share);
        $createdShare = $createdShare->toArray();
        $this->assertArrayHasKey('id', $createdShare);
        $this->assertNotNull($createdShare['id'], 'Created Share must have id specified');
        $this->assertNotNull(Share::find($createdShare['id']), 'Share with given id must be in DB');
        $this->assertModelData($share, $createdShare);
    }

    /**
     * @test read
     */
    public function testReadShare()
    {
        $share = $this->makeShare();
        $dbShare = $this->shareRepo->find($share->id);
        $dbShare = $dbShare->toArray();
        $this->assertModelData($share->toArray(), $dbShare);
    }

    /**
     * @test update
     */
    public function testUpdateShare()
    {
        $share = $this->makeShare();
        $fakeShare = $this->fakeShareData();
        $updatedShare = $this->shareRepo->update($fakeShare, $share->id);
        $this->assertModelData($fakeShare, $updatedShare->toArray());
        $dbShare = $this->shareRepo->find($share->id);
        $this->assertModelData($fakeShare, $dbShare->toArray());
    }

    /**
     * @test delete
     */
    public function testDeleteShare()
    {
        $share = $this->makeShare();
        $resp = $this->shareRepo->delete($share->id);
        $this->assertTrue($resp);
        $this->assertNull(Share::find($share->id), 'Share should not exist in DB');
    }
}
