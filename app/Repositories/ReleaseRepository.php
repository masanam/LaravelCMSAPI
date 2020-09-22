<?php

namespace App\Repositories;

use App\Models\Release;
use Webcore\Generator\Common\BaseRepository;

/**
 * Class ReleaseRepository
 * @package App\Repositories
 * @version June 17, 2020, 3:07 pm WIB
 *
 * @method Release findWithoutFail($id, $columns = ['*'])
 * @method Release find($id, $columns = ['*'])
 * @method Release first($columns = ['*'])
*/
class ReleaseRepository extends BaseRepository
{
    /**
     * @var array
     */
    protected $fieldSearchable = [
        'category_id',
        'title',
        'seotitle',
        'picture_description',
        'tag',
        'active',
        'headline',
        'hits',
        'status',
        'created_by',
        'updated_by'
    ];

    /**
     * Configure the Model
     **/
    public function model()
    {
        return Release::class;
    }
}
