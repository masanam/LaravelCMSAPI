<?php

namespace App\Repositories;

use App\Models\Section;
use Webcore\Generator\Common\BaseRepository;

/**
 * Class SectionRepository
 * @package App\Repositories
 * @version July 2, 2020, 5:26 pm WIB
 *
 * @method Section findWithoutFail($id, $columns = ['*'])
 * @method Section find($id, $columns = ['*'])
 * @method Section first($columns = ['*'])
*/
class SectionRepository extends BaseRepository
{
    /**
     * @var array
     */
    protected $fieldSearchable = [
        'title',
        'slug',
        'created_by',
        'type',
        'orderid',
        'updated_by'
    ];

    /**
     * Configure the Model
     **/
    public function model()
    {
        return Section::class;
    }
}
