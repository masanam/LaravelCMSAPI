<?php

use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseTransactions;

class AnnouncementApiTest extends TestCase
{
    use MakeAnnouncementTrait, ApiTestTrait, WithoutMiddleware, DatabaseTransactions;

    /**
     * @test
     */
    public function testCreateAnnouncement()
    {
        $announcement = $this->fakeAnnouncementData();
        $this->json('POST', '/api/v1/announcements', $announcement);

        $this->assertApiResponse($announcement);
    }

    /**
     * @test
     */
    public function testReadAnnouncement()
    {
        $announcement = $this->makeAnnouncement();
        $this->json('GET', '/api/v1/announcements/'.$announcement->id);

        $this->assertApiResponse($announcement->toArray());
    }

    /**
     * @test
     */
    public function testUpdateAnnouncement()
    {
        $announcement = $this->makeAnnouncement();
        $editedAnnouncement = $this->fakeAnnouncementData();

        $this->json('PUT', '/api/v1/announcements/'.$announcement->id, $editedAnnouncement);

        $this->assertApiResponse($editedAnnouncement);
    }

    /**
     * @test
     */
    public function testDeleteAnnouncement()
    {
        $announcement = $this->makeAnnouncement();
        $this->json('DELETE', '/api/v1/announcements/'.$announcement->id);

        $this->assertApiSuccess();
        $this->json('GET', '/api/v1/announcements/'.$announcement->id);

        $this->assertResponseStatus(404);
    }
}
