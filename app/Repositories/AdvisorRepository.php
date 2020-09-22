<?php

namespace App\Repositories;

use App\Models\Advisor;
use Webcore\Generator\Common\BaseRepository;

/**
 * Class AdvisorRepository
 * @package App\Repositories
 * @version July 2, 2020, 10:52 am WIB
 *
 * @method Advisor findWithoutFail($id, $columns = ['*'])
 * @method Advisor find($id, $columns = ['*'])
 * @method Advisor first($columns = ['*'])
*/
class AdvisorRepository extends BaseRepository
{
    /**
     * @var array
     */
    protected $fieldSearchable = [
        'title',
        'slug',
        'created_by',
        'updated_by'
    ];

    /**
     * Configure the Model
     **/
    public function model()
    {
        return Advisor::class;
    }
}
