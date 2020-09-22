<?php

namespace App\Repositories;

use App\Models\Header;
use Webcore\Generator\Common\BaseRepository;

/**
 * Class HeaderRepository
 * @package App\Repositories
 * @version June 17, 2020, 2:05 pm WIB
 *
 * @method Header findWithoutFail($id, $columns = ['*'])
 * @method Header find($id, $columns = ['*'])
 * @method Header first($columns = ['*'])
*/
class HeaderRepository extends BaseRepository
{
    /**
     * @var array
     */
    protected $fieldSearchable = [
        'album_id',
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
        return Header::class;
    }
}
