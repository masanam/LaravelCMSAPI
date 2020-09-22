<?php

namespace App\Repositories;

use App\Models\Achievement;
use Webcore\Generator\Common\BaseRepository;

/**
 * Class AchievementRepository
 * @package App\Repositories
 * @version June 17, 2020, 2:54 pm WIB
 *
 * @method Achievement findWithoutFail($id, $columns = ['*'])
 * @method Achievement find($id, $columns = ['*'])
 * @method Achievement first($columns = ['*'])
*/
class AchievementRepository extends BaseRepository
{
    /**
     * @var array
     */
    protected $fieldSearchable = [
        'category_id',
        'title',
        'seotitle',
        'year',
        'status',
        'created_by',
        'updated_by'
    ];

    /**
     * Configure the Model
     **/
    public function model()
    {
        return Achievement::class;
    }
}
