<?php

namespace App\Repositories;

use App\Models\Testimony;
use Webcore\Generator\Common\BaseRepository;

/**
 * Class TestimonyRepository
 * @package App\Repositories
 * @version June 17, 2020, 3:04 pm WIB
 *
 * @method Testimony findWithoutFail($id, $columns = ['*'])
 * @method Testimony find($id, $columns = ['*'])
 * @method Testimony first($columns = ['*'])
*/
class TestimonyRepository extends BaseRepository
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
        return Testimony::class;
    }
}
