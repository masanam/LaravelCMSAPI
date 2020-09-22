<?php

namespace App\Repositories;

use App\Models\Brand;
use Webcore\Generator\Common\BaseRepository;

/**
 * Class BrandRepository
 * @package App\Repositories
 * @version June 17, 2020, 2:49 pm WIB
 *
 * @method Brand findWithoutFail($id, $columns = ['*'])
 * @method Brand find($id, $columns = ['*'])
 * @method Brand first($columns = ['*'])
*/
class BrandRepository extends BaseRepository
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
        return Brand::class;
    }
}
