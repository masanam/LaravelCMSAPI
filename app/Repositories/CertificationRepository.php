<?php

namespace App\Repositories;

use App\Models\Certification;
use Webcore\Generator\Common\BaseRepository;

/**
 * Class CertificationRepository
 * @package App\Repositories
 * @version June 17, 2020, 2:55 pm WIB
 *
 * @method Certification findWithoutFail($id, $columns = ['*'])
 * @method Certification find($id, $columns = ['*'])
 * @method Certification first($columns = ['*'])
*/
class CertificationRepository extends BaseRepository
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
        return Certification::class;
    }
}
