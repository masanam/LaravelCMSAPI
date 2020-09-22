<?php

use Faker\Factory as Faker;
use App\Models\Announcement;
use App\Repositories\AnnouncementRepository;

trait MakeAnnouncementTrait
{
    /**
     * Create fake instance of Announcement and save it in database
     *
     * @param array $announcementFields
     * @return Announcement
     */
    public function makeAnnouncement($announcementFields = [])
    {
        /** @var AnnouncementRepository $announcementRepo */
        $announcementRepo = App::make(AnnouncementRepository::class);
        $theme = $this->fakeAnnouncementData($announcementFields);
        return $announcementRepo->create($theme);
    }

    /**
     * Get fake instance of Announcement
     *
     * @param array $announcementFields
     * @return Announcement
     */
    public function fakeAnnouncement($announcementFields = [])
    {
        return new Announcement($this->fakeAnnouncementData($announcementFields));
    }

    /**
     * Get fake data of Announcement
     *
     * @param array $postFields
     * @return array
     */
    public function fakeAnnouncementData($announcementFields = [])
    {
        $fake = Faker::create();

        return array_merge([
            'category_id' => $fake->randomDigitNotNull,
            'title' => $fake->word,
            'seotitle' => $fake->word,
            'content' => $fake->text,
            'picture' => $fake->word,
            'picture_description' => $fake->word,
            'tag' => $fake->word,
            'active' => $fake->word,
            'headline' => $fake->randomDigitNotNull,
            'hits' => $fake->randomDigitNotNull,
            'status' => $fake->randomDigitNotNull,
            'created_by' => $fake->randomDigitNotNull,
            'updated_by' => $fake->randomDigitNotNull,
            'created_at' => $fake->word,
            'updated_at' => $fake->word
        ], $announcementFields);
    }
}
