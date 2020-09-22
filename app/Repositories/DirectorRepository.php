<?php

namespace App\Repositories;

use App\Models\Director;
use Webcore\Generator\Common\BaseRepository;

/**
 * Class DirectorRepository
 * @package App\Repositories
 * @version July 2, 2020, 11:40 am WIB
 *
 * @method Director findWithoutFail($id, $columns = ['*'])
 * @method Director find($id, $columns = ['*'])
 * @method Director first($columns = ['*'])
*/
class DirectorRepository extends BaseRepository
{
    /**
     * @var array
     */
    protected $fieldSearchable = [
        'category_id',
        'fullname',
        'position',
        'title',
        'citizen',
        'age',
        'status',
        'created_by',
        'updated_by'
    ];

    /**
     * Configure the Model
     **/
    public function model()
    {
        return Director::class;
    }
}
