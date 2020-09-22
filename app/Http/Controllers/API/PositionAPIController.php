<?php

namespace App\Http\Controllers\API;

use App\Http\Requests\API\CreatePositionAPIRequest;
use App\Http\Requests\API\UpdatePositionAPIRequest;
use App\Models\Position;
use App\Repositories\PositionRepository;
use Illuminate\Http\Request;
use App\Http\Controllers\AppBaseController;
use Webcore\Generator\Criteria\LimitOffsetCriteria;
use Prettus\Repository\Criteria\RequestCriteria;
use Response;

/**
 * Class PositionController
 * @package App\Http\Controllers\API
 */

class PositionAPIController extends AppBaseController
{
    /** @var  PositionRepository */
    private $positionRepository;

    public function __construct(PositionRepository $positionRepo)
    {
        $this->middleware('auth:api');
        $this->positionRepository = $positionRepo;
    }

    /**
     * @param Request $request
     * @return Response
     *
     * @SWG\Get(
     *      path="/positions",
     *      summary="Get a listing of the Positions.",
     *      tags={"Position"},
     *      description="Get all Positions",
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
     *                  @SWG\Items(ref="#/definitions/Position")
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
        $this->positionRepository->pushCriteria(new RequestCriteria($request));
        $this->positionRepository->pushCriteria(new LimitOffsetCriteria($request));
        $positions = $this->positionRepository->all();

        return $this->sendResponse($positions->toArray(), 'Positions retrieved successfully');
    }

    /**
     * @param CreatePositionAPIRequest $request
     * @return Response
     *
     * @SWG\Post(
     *      path="/positions",
     *      summary="Store a newly created Position in storage",
     *      tags={"Position"},
     *      description="Store Position",
     *      produces={"application/json"},
     *      @SWG\Parameter(
     *          name="body",
     *          in="body",
     *          description="Position that should be stored",
     *          required=false,
     *          @SWG\Schema(ref="#/definitions/Position")
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
     *                  ref="#/definitions/Position"
     *              ),
     *              @SWG\Property(
     *                  property="message",
     *                  type="string"
     *              )
     *          )
     *      )
     * )
     */
    public function store(CreatePositionAPIRequest $request)
    {
        $input = $request->all();

        $positions = $this->positionRepository->create($input);

        return $this->sendResponse($positions->toArray(), 'Position saved successfully');
    }

    /**
     * @param int $id
     * @return Response
     *
     * @SWG\Get(
     *      path="/positions/{id}",
     *      summary="Display the specified Position",
     *      tags={"Position"},
     *      description="Get Position",
     *      produces={"application/json"},
     *      @SWG\Parameter(
     *          name="id",
     *          description="id of Position",
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
     *                  ref="#/definitions/Position"
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
        /** @var Position $position */
        $position = $this->positionRepository->findWithoutFail($id);

        if (empty($position)) {
            return $this->sendError('Position not found');
        }

        return $this->sendResponse($position->toArray(), 'Position retrieved successfully');
    }

    /**
     * @param int $id
     * @param UpdatePositionAPIRequest $request
     * @return Response
     *
     * @SWG\Put(
     *      path="/positions/{id}",
     *      summary="Update the specified Position in storage",
     *      tags={"Position"},
     *      description="Update Position",
     *      produces={"application/json"},
     *      @SWG\Parameter(
     *          name="id",
     *          description="id of Position",
     *          type="integer",
     *          required=true,
     *          in="path"
     *      ),
     *      @SWG\Parameter(
     *          name="body",
     *          in="body",
     *          description="Position that should be updated",
     *          required=false,
     *          @SWG\Schema(ref="#/definitions/Position")
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
     *                  ref="#/definitions/Position"
     *              ),
     *              @SWG\Property(
     *                  property="message",
     *                  type="string"
     *              )
     *          )
     *      )
     * )
     */
    public function update($id, UpdatePositionAPIRequest $request)
    {
        $input = $request->all();

        /** @var Position $position */
        $position = $this->positionRepository->findWithoutFail($id);

        if (empty($position)) {
            return $this->sendError('Position not found');
        }

        $position = $this->positionRepository->update($input, $id);

        return $this->sendResponse($position->toArray(), 'Position updated successfully');
    }

    /**
     * @param int $id
     * @return Response
     *
     * @SWG\Delete(
     *      path="/positions/{id}",
     *      summary="Remove the specified Position from storage",
     *      tags={"Position"},
     *      description="Delete Position",
     *      produces={"application/json"},
     *      @SWG\Parameter(
     *          name="id",
     *          description="id of Position",
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
        /** @var Position $position */
        $position = $this->positionRepository->findWithoutFail($id);

        if (empty($position)) {
            return $this->sendError('Position not found');
        }

        $position->delete();

        return $this->sendResponse($id, 'Position deleted successfully');
    }
}
