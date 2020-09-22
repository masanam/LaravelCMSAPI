<?php

namespace App\Models;

use Eloquent as Model;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * @SWG\Definition(
 *      definition="Registrant",
 *      required={""},
 *      @SWG\Property(
 *          property="id",
 *          description="id",
 *          type="integer",
 *          format="int32"
 *      ),
 *      @SWG\Property(
 *          property="firstname",
 *          description="firstname",
 *          type="string"
 *      ),
 *      @SWG\Property(
 *          property="lastname",
 *          description="lastname",
 *          type="string"
 *      ),
 *      @SWG\Property(
 *          property="email",
 *          description="email",
 *          type="string"
 *      ),
 *      @SWG\Property(
 *          property="phone",
 *          description="phone",
 *          type="string"
 *      ),
 *      @SWG\Property(
 *          property="address",
 *          description="address",
 *          type="string"
 *      ),
 *      @SWG\Property(
 *          property="position",
 *          description="position",
 *          type="string"
 *      ),
 *      @SWG\Property(
 *          property="resume",
 *          description="resume",
 *          type="string"
 *      ),
 *      @SWG\Property(
 *          property="status",
 *          description="status",
 *          type="integer",
 *          format="int32"
 *      ),
 *      @SWG\Property(
 *          property="created_by",
 *          description="created_by",
 *          type="integer",
 *          format="int32"
 *      ),
 *      @SWG\Property(
 *          property="updated_by",
 *          description="updated_by",
 *          type="integer",
 *          format="int32"
 *      ),
 *      @SWG\Property(
 *          property="created_at",
 *          description="created_at",
 *          type="string",
 *          format="date-time"
 *      ),
 *      @SWG\Property(
 *          property="updated_at",
 *          description="updated_at",
 *          type="string",
 *          format="date-time"
 *      )
 * )
 */
class Registrant extends Model
{
    use SoftDeletes;

    public $table = 'registrants';
    

    protected $dates = ['deleted_at'];


    public $fillable = [
        'fullName',
        'dateOfBirth',
        'gender',
        'phone',
        'email',
        'idKTP',
        'address',
        'city',
        'province',
        'school',
        'major',
        'gpa',
        'startYear',
        'endYear',
        'maritalStatus',
        'driving',
        'profExperience',
        'curCom',
        'curPos',
        'jobDesc',
        'curYear',
        'haveDisease',
        'typeDisease',
        'yearDisease',
        'frequency',
        'processed',
        'proPosition',
        'proYear',
        'local',
        'overseas',
        'englishSpeak',
        'mandarinSpeak',
        'otherSpeak',
        'english',
        'mandarin',
        'other',
        'filename',
        'positionId',
        'userid',
        'resume',
        'status',
        'created_by',
        'updated_by'

    ];

    /**
     * The attributes that should be casted to native types.
     *
     * @var array
     */
    protected $casts = [
        'fullName' => 'string',
        'dateOfBirth' => 'string',
        'gender' => 'string',
        'phone' => 'string',
        'email' => 'string',
        'idKTP' => 'string',
        'address' => 'string',
        'city' => 'string',
        'province' => 'string',
        'school' => 'string',
        'major' => 'string',
        'gpa' => 'string',
        'startYear' => 'string',
        'endYear' => 'string',
        'maritalStatus' => 'integer',
        'driving' => 'integer',
        'profExperience' => 'string',
        'curCom' => 'string',
        'curPos' => 'string',
        'jobDesc' => 'string',
        'curYear' => 'string',
        'haveDisease' => 'string',
        'typeDisease' => 'string',
        'yearDisease' => 'string',
        'frequency' => 'string',
        'processed' => 'string',
        'proPosition' => 'string',
        'proYear' => 'string',
        'local' => 'integer',
        'overseas' => 'integer',
        'englishSpeak' => 'integer',
        'mandarinSpeak' => 'integer',
        'otherSpeak' => 'integer',
        'english' => 'integer',
        'mandarin' => 'integer',
        'other' => 'integer',
        'filename' => 'string',
        'positionId' => 'integer',
        'userid' => 'integer',
        'resume' => 'string',
        'status' => 'integer',
        'created_by' => 'integer',
        'updated_by' => 'integer'
    ];

    /**
     * Validation rules
     *
     * @var array
     */
    public static $rules = [
        
    ];

    public function getTableColumns() {
        return $this->getConnection()->getSchemaBuilder()->getColumnListing($this->getTable());
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     **/
    public function status()
    {
        return $this->belongsTo(\App\Models\Status::class, 'status', 'id');
    }

    public function position()
    {
        return $this->belongsTo(\App\Models\Career::class, 'positionId', 'id');
    }

    public function user()
    {
        return $this->belongsTo(\App\User::class, 'userid', 'id');
    }
}
