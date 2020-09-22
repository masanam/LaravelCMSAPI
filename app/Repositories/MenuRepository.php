<?php

namespace App\Repositories;

use App\Models\Menu;
use Webcore\Generator\Common\BaseRepository;

/**
 * Class MenuRepository
 * @package App\Repositories
 * @version June 22, 2020, 2:23 pm WIB
 *
 * @method Menu findWithoutFail($id, $columns = ['*'])
 * @method Menu find($id, $columns = ['*'])
 * @method Menu first($columns = ['*'])
*/
class MenuRepository extends BaseRepository
{
    /**
     * @var array
     */
    protected $fieldSearchable = [
        'parent_id',
        'type',
        'title',
        'picture',
        'created_by',
        'updated_by'
    ];

    /**
     * Configure the Model
     **/
    public function model()
    {
        return Menu::class;
    }
}
