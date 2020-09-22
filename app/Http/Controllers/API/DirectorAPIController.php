<?php

namespace App\Http\Controllers\API;

use App\Http\Requests\API\CreateDirectorAPIRequest;
use App\Http\Requests\API\UpdateDirectorAPIRequest;
use App\Models\Director;
use App\Repositories\DirectorRepository;
use Illuminate\Http\Request;
use App\Http\Controllers\AppBaseController;
use Webcore\Generator\Criteria\LimitOffsetCriteria;
use Prettus\Repository\Criteria\RequestCriteria;
use Response;

/**
 * Class DirectorController
 * @package App\Http\Controllers\API
 */

class DirectorAPIController extends AppBaseController
{
    /** @var  DirectorRepository */
    private $directorRepository;

    public function __construct(DirectorRepository $directorRepo)
    {
        $this->middleware('auth:api');
        $this->directorRepository = $directorRepo;
    }

    /**
     * @param Request $request
     * @return Response
     *
     * @SWG\Get(
     *      path="/directors",
     *      summary="Get a listing of the Directors.",
     *      tags={"Director"},
     *      description="Get all Directors",
     *      produces={"application/json"},
     *      @SWG\Response(
     *          response=200,
     *          description="successful operation",
     *          @SWG\Schema(
     *              type="object",
     *              @SWG\Property(
     *                  property="success",
     *                  type="boolean"
     *              ),
     *              @SWG\Property(
     *                  property="data",
     *                  type="array",
     *                  @SWG\Items(ref="#/definitions/Director")
     *              ),
     *              @SWG\Property(
     *                  property="message",
     *                  type="string"
     *              )
     *          )
     *      )
     * )
     */
    public function index(Request $request)
    {
        $this->directorRepository->pushCriteria(new RequestCriteria($request));
        $this->directorRepository->pushCriteria(new LimitOffsetCriteria($request));
        $directors = $this->directorRepository->all();

        return $this->sendResponse($directors->toArray(), 'Directors retrieved successfully');
    }

    /**
     * @param CreateDirectorAPIRequest $request
     * @return Response
     *
     * @SWG\Post(
     *      path="/directors",
     *      summary="Store a newly created Director in storage",
     *      tags={"Director"},
     *      description="Store Director",
     *      produces={"application/json"},
     *      @SWG\Parameter(
     *          name="body",
     *          in="body",
     *          description="Director that should be stored",
     *          required=false,
     *          @SWG\Schema(ref="#/definitions/Director")
     *      ),
     *      @SWG\Response(
     *          response=200,
     *          description="successful operation",
     *          @SWG\Schema(
     *              type="object",
     *              @SWG\Property(
     *                  property="success",
     *                  type="boolean"
     *              ),
     *              @SWG\Property(
     *                  property="data",
     *                  ref="#/definitions/Director"
     *              ),
     *              @SWG\Property(
     *                  property="message",
     *                  type="string"
     *              )
     *          )
     *      )
     * )
     */
    public function store(CreateDirectorAPIRequest $request)
    {
        $input = $request->all();

        $directors = $this->directorRepository->create($input);

        return $this->sendResponse($directors->toArray(), 'Director saved successfully');
    }

    /**
     * @param int $id
     * @return Response
     *
     * @SWG\Get(
     *      path="/directors/{id}",
     *      summary="Display the specified Director",
     *      tags={"Director"},
     *      description="Get Director",
     *      produces={"application/json"},
     *      @SWG\Parameter(
     *          name="id",
     *          description="id of Director",
     *          type="integer",
     *          required=true,
     *          in="path"
     *      ),
     *      @SWG\Response(
     *          response=200,
     *          description="successful operation",
     *          @SWG\Schema(
     *              type="object",
     *              @SWG\Property(
     *                  property="success",
     *                  type="boolean"
     *              ),
     *              @SWG\Property(
     *                  property="data",
     *                  ref="#/definitions/Director"
     *              ),
     *              @SWG\Property(
     *                  property="message",
     *                  type="string"
     *              )
     *          )
     *      )
     * )
     */
    public function show($id)
    {
        /** @var Director $director */
        $director = $this->directorRepository->findWithoutFail($id);

        if (empty($director)) {
            return $this->sendError('Director not found');
        }

        return $this->sendResponse($director->toArray(), 'Director retrieved successfully');
    }

    /**
     * @param int $id
     * @param UpdateDirectorAPIRequest $request
     * @return Response
     *
     * @SWG\Put(
     *      path="/directors/{id}",
     *      summary="Update the specified Director in storage",
     *      tags={"Director"},
     *      description="Update Director",
     *      produces={"application/json"},
     *      @SWG\Parameter(
     *          name="id",
     *          description="id of Director",
     *          type="integer",
     *          required=true,
     *          in="path"
     *      ),
     *      @SWG\Parameter(
     *          name="body",
     *          in="body",
     *          description="Director that should be updated",
     *          required=false,
     *          @SWG\Schema(ref="#/definitions/Director")
     *      ),
     *      @SWG\Response(
     *          response=200,
     *          description="successful operation",
     *          @SWG\Schema(
     *              type="object",
     *              @SWG\Property(
     *                  property="success",
     *                  type="boolean"
     *              ),
     *              @SWG\Property(
     *                  property="data",
     *                  ref="#/definitions/Director"
     *              ),
     *              @SWG\Property(
     *                  property="message",
     *                  type="string"
     *              )
     *          )
     *      )
     * )
     */
    public function update($id, UpdateDirectorAPIRequest $request)
    {
        $input = $request->all();

        /** @var Director $director */
        $director = $this->directorRepository->findWithoutFail($id);

        if (empty($director)) {
            return $this->sendError('Director not found');
        }

        $director = $this->directorRepository->update($input, $id);

        return $this->sendResponse($director->toArray(), 'Director updated successfully');
    }

    /**
     * @param int $id
     * @return Response
     *
     * @SWG\Delete(
     *      path="/directors/{id}",
     *      summary="Remove the specified Director from storage",
     *      tags={"Director"},
     *      description="Delete Director",
     *      produces={"application/json"},
     *      @SWG\Parameter(
     *          name="id",
     *          description="id of Director",
     *          type="integer",
     *          required=true,
     *          in="path"
     *      ),
     *      @SWG\Response(
     *          response=200,
     *          description="successful operation",
     *          @SWG\Schema(
     *              type="object",
     *              @SWG\Property(
     *                  property="success",
     *                  type="boolean"
     *              ),
     *              @SWG\Property(
     *                  property="data",
     *                  type="string"
     *              ),
     *              @SWG\Property(
     *                  property="message",
     *                  type="string"
     *              )
     *          )
     *      )
     * )
     */
    public function destroy($id)
    {
        /** @var Director $director */
        $director = $this->directorRepository->findWithoutFail($id);

        if (empty($director)) {
            return $this->sendError('Director not found');
        }

        $director->delete();

        return $this->sendResponse($id, 'Director deleted successfully');
    }
}
