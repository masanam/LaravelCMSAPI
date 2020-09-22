<?php

use App\Models\Announcement;
use App\Repositories\AnnouncementRepository;
use Illuminate\Foundation\Testing\DatabaseTransactions;

class AnnouncementRepositoryTest extends TestCase
{
    use MakeAnnouncementTrait, ApiTestTrait, DatabaseTransactions;

    /**
     * @var AnnouncementRepository
     */
    protected $announcementRepo;

    public function setUp()
    {
        parent::setUp();
        $this->announcementRepo = App::make(AnnouncementRepository::class);
    }

    /**
     * @test create
     */
    public function testCreateAnnouncement()
    {
        $announcement = $this->fakeAnnouncementData();
        $createdAnnouncement = $this->announcementRepo->create($announcement);
        $createdAnnouncement = $createdAnnouncement->toArray();
        $this->assertArrayHasKey('id', $createdAnnouncement);
        $this->assertNotNull($createdAnnouncement['id'], 'Created Announcement must have id specified');
        $this->assertNotNull(Announcement::find($createdAnnouncement['id']), 'Announcement with given id must be in DB');
        $this->assertModelData($announcement, $createdAnnouncement);
    }

    /**
     * @test read
     */
    public function testReadAnnouncement()
    {
        $announcement = $this->makeAnnouncement();
        $dbAnnouncement = $this->announcementRepo->find($announcement->id);
        $dbAnnouncement = $dbAnnouncement->toArray();
        $this->assertModelData($announcement->toArray(), $dbAnnouncement);
    }

    /**
     * @test update
     */
    public function testUpdateAnnouncement()
    {
        $announcement = $this->makeAnnouncement();
        $fakeAnnouncement = $this->fakeAnnouncementData();
        $updatedAnnouncement = $this->announcementRepo->update($fakeAnnouncement, $announcement->id);
        $this->assertModelData($fakeAnnouncement, $updatedAnnouncement->toArray());
        $dbAnnouncement = $this->announcementRepo->find($announcement->id);
        $this->assertModelData($fakeAnnouncement, $dbAnnouncement->toArray());
    }

    /**
     * @test delete
     */
    public function testDeleteAnnouncement()
    {
        $announcement = $this->makeAnnouncement();
        $resp = $this->announcementRepo->delete($announcement->id);
        $this->assertTrue($resp);
        $this->assertNull(Announcement::find($announcement->id), 'Announcement should not exist in DB');
    }
}
