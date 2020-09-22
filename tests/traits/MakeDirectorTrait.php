<?php

use Faker\Factory as Faker;
use App\Models\Director;
use App\Repositories\DirectorRepository;

trait MakeDirectorTrait
{
    /**
     * Create fake instance of Director and save it in database
     *
     * @param array $directorFields
     * @return Director
     */
    public function makeDirector($directorFields = [])
    {
        /** @var DirectorRepository $directorRepo */
        $directorRepo = App::make(DirectorRepository::class);
        $theme = $this->fakeDirectorData($directorFields);
        return $directorRepo->create($theme);
    }

    /**
     * Get fake instance of Director
     *
     * @param array $directorFields
     * @return Director
     */
    public function fakeDirector($directorFields = [])
    {
        return new Director($this->fakeDirectorData($directorFields));
    }

    /**
     * Get fake data of Director
     *
     * @param array $postFields
     * @return array
     */
    public function fakeDirectorData($directorFields = [])
    {
        $fake = Faker::create();

        return array_merge([
            'category_id' => $fake->randomDigitNotNull,
            'fullname' => $fake->word,
            'position' => $fake->word,
            'title' => $fake->word,
            'picture' => $fake->word,
            'citizen' => $fake->word,
            'age' => $fake->word,
            'education' => $fake->text,
            'legal' => $fake->text,
            'experience' => $fake->text,
            'concurrent' => $fake->text,
            'affiliate' => $fake->text,
            'desciption' => $fake->text,
            'status' => $fake->randomDigitNotNull,
            'created_by' => $fake->randomDigitNotNull,
            'updated_by' => $fake->randomDigitNotNull,
            'created_at' => $fake->word,
            'updated_at' => $fake->word
        ], $directorFields);
    }
}
