<?php

namespace App\Repositories;

use App\Models\Content;
use Webcore\Generator\Common\BaseRepository;

/**
 * Class ContentRepository
 * @package App\Repositories
 * @version June 17, 2020, 2:43 pm WIB
 *
 * @method Content findWithoutFail($id, $columns = ['*'])
 * @method Content find($id, $columns = ['*'])
 * @method Content first($columns = ['*'])
*/
class ContentRepository extends BaseRepository
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
        return Content::class;
    }
}
