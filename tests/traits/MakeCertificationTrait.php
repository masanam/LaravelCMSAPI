<?php

use Faker\Factory as Faker;
use App\Models\Certification;
use App\Repositories\CertificationRepository;

trait MakeCertificationTrait
{
    /**
     * Create fake instance of Certification and save it in database
     *
     * @param array $certificationFields
     * @return Certification
     */
    public function makeCertification($certificationFields = [])
    {
        /** @var CertificationRepository $certificationRepo */
        $certificationRepo = App::make(CertificationRepository::class);
        $theme = $this->fakeCertificationData($certificationFields);
        return $certificationRepo->create($theme);
    }

    /**
     * Get fake instance of Certification
     *
     * @param array $certificationFields
     * @return Certification
     */
    public function fakeCertification($certificationFields = [])
    {
        return new Certification($this->fakeCertificationData($certificationFields));
    }

    /**
     * Get fake data of Certification
     *
     * @param array $postFields
     * @return array
     */
    public function fakeCertificationData($certificationFields = [])
    {
        $fake = Faker::create();

        return array_merge([
            'category_id' => $fake->randomDigitNotNull,
            'title' => $fake->word,
            'seotitle' => $fake->word,
            'content' => $fake->text,
            'picture' => $fake->word,
            'year' => $fake->randomDigitNotNull,
            'status' => $fake->randomDigitNotNull,
            'created_by' => $fake->randomDigitNotNull,
            'updated_by' => $fake->randomDigitNotNull,
            'created_at' => $fake->word,
            'updated_at' => $fake->word
        ], $certificationFields);
    }
}
