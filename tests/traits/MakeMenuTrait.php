<?php

use Faker\Factory as Faker;
use App\Models\Menu;
use App\Repositories\MenuRepository;

trait MakeMenuTrait
{
    /**
     * Create fake instance of Menu and save it in database
     *
     * @param array $menuFields
     * @return Menu
     */
    public function makeMenu($menuFields = [])
    {
        /** @var MenuRepository $menuRepo */
        $menuRepo = App::make(MenuRepository::class);
        $theme = $this->fakeMenuData($menuFields);
        return $menuRepo->create($theme);
    }

    /**
     * Get fake instance of Menu
     *
     * @param array $menuFields
     * @return Menu
     */
    public function fakeMenu($menuFields = [])
    {
        return new Menu($this->fakeMenuData($menuFields));
    }

    /**
     * Get fake data of Menu
     *
     * @param array $postFields
     * @return array
     */
    public function fakeMenuData($menuFields = [])
    {
        $fake = Faker::create();

        return array_merge([
            'parent_id' => $fake->randomDigitNotNull,
            'type' => $fake->randomDigitNotNull,
            'title' => $fake->word,
            'picture' => $fake->word,
            'created_by' => $fake->randomDigitNotNull,
            'updated_by' => $fake->randomDigitNotNull,
            'created_at' => $fake->word,
            'updated_at' => $fake->word
        ], $menuFields);
    }
}
