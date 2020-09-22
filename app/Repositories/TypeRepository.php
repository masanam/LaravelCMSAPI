<?php

namespace App\Repositories;

use App\Models\Type;
use Webcore\Generator\Common\BaseRepository;

/**
 * Class TypeRepository
 * @package App\Repositories
 * @version June 17, 2020, 2:17 pm WIB
 *
 * @method Type findWithoutFail($id, $columns = ['*'])
 * @method Type find($id, $columns = ['*'])
 * @method Type first($columns = ['*'])
*/
class TypeRepository extends BaseRepository
{
    /**
     * @var array
     */
    protected $fieldSearchable = [
        'title',
        'created_by',
        'updated_by'
    ];

    /**
     * Configure the Model
     **/
    public function model()
    {
        return Type::class;
    }
}
