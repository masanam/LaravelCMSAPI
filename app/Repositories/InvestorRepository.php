<?php

namespace App\Repositories;

use App\Models\Investor;
use Webcore\Generator\Common\BaseRepository;

/**
 * Class InvestorRepository
 * @package App\Repositories
 * @version July 8, 2020, 11:12 am WIB
 *
 * @method Investor findWithoutFail($id, $columns = ['*'])
 * @method Investor find($id, $columns = ['*'])
 * @method Investor first($columns = ['*'])
*/
class InvestorRepository extends BaseRepository
{
    /**
     * @var array
     */
    protected $fieldSearchable = [
        'name',
        'email',
        'phone',
        'country',
        'title',
        'status',
        'created_by',
        'updated_by'
    ];

    /**
     * Configure the Model
     **/
    public function model()
    {
        return Investor::class;
    }
}
