<?php

namespace App\Repositories;

use App\Models\Group;
use Webcore\Generator\Common\BaseRepository;

/**
 * Class GroupRepository
 * @package App\Repositories
 * @version June 17, 2020, 2:21 pm WIB
 *
 * @method Group findWithoutFail($id, $columns = ['*'])
 * @method Group find($id, $columns = ['*'])
 * @method Group first($columns = ['*'])
*/
class GroupRepository extends BaseRepository
{
    /**
     * @var array
     */
    protected $fieldSearchable = [
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
        return Group::class;
    }
}
