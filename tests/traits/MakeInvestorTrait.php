<?php

use Faker\Factory as Faker;
use App\Models\Investor;
use App\Repositories\InvestorRepository;

trait MakeInvestorTrait
{
    /**
     * Create fake instance of Investor and save it in database
     *
     * @param array $investorFields
     * @return Investor
     */
    public function makeInvestor($investorFields = [])
    {
        /** @var InvestorRepository $investorRepo */
        $investorRepo = App::make(InvestorRepository::class);
        $theme = $this->fakeInvestorData($investorFields);
        return $investorRepo->create($theme);
    }

    /**
     * Get fake instance of Investor
     *
     * @param array $investorFields
     * @return Investor
     */
    public function fakeInvestor($investorFields = [])
    {
        return new Investor($this->fakeInvestorData($investorFields));
    }

    /**
     * Get fake data of Investor
     *
     * @param array $postFields
     * @return array
     */
    public function fakeInvestorData($investorFields = [])
    {
        $fake = Faker::create();

        return array_merge([
            'name' => $fake->word,
            'email' => $fake->word,
            'phone' => $fake->word,
            'country' => $fake->word,
            'title' => $fake->word,
            'content' => $fake->text,
            'status' => $fake->randomDigitNotNull,
            'created_by' => $fake->randomDigitNotNull,
            'updated_by' => $fake->randomDigitNotNull,
            'created_at' => $fake->word,
            'updated_at' => $fake->word
        ], $investorFields);
    }
}
