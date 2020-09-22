<?php

namespace App\Repositories;

use App\Models\Career;
use Webcore\Generator\Common\BaseRepository;

/**
 * Class CareerRepository
 * @package App\Repositories
 * @version June 17, 2020, 2:50 pm WIB
 *
 * @method Career findWithoutFail($id, $columns = ['*'])
 * @method Career find($id, $columns = ['*'])
 * @method Career first($columns = ['*'])
*/
class CareerRepository extends BaseRepository
{
    /**
     * @var array
     */
    protected $fieldSearchable = [
        'category_id',
        'title',
        'seotitle',
        'status',
        'created_by',
        'updated_by'
    ];

    /**
     * Configure the Model
     **/
    public function model()
    {
        return Career::class;
    }
}
