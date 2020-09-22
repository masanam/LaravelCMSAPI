<?php

namespace App\Repositories;

use App\Models\Document;
use Webcore\Generator\Common\BaseRepository;

/**
 * Class DocumentRepository
 * @package App\Repositories
 * @version June 17, 2020, 2:44 pm WIB
 *
 * @method Document findWithoutFail($id, $columns = ['*'])
 * @method Document find($id, $columns = ['*'])
 * @method Document first($columns = ['*'])
*/
class DocumentRepository extends BaseRepository
{
    /**
     * @var array
     */
    protected $fieldSearchable = [
        'title',
        'seotitle',
        'description',
        'category',
        'status',
        'created_by',
        'updated_by',
        'created_at',
        'updated_at'
    ];

    /**
     * Configure the Model
     **/
    public function model()
    {
        return Document::class;
    }
}
