<?php

namespace App\Http\Controllers\API;

use App\Http\Requests\API\CreateTypeAPIRequest;
use App\Http\Requests\API\UpdateTypeAPIRequest;
use App\Models\Type;
use App\Repositories\TypeRepository;
use Illuminate\Http\Request;
use App\Http\Controllers\AppBaseController;
use Webcore\Generator\Criteria\LimitOffsetCriteria;
use Prettus\Repository\Criteria\RequestCriteria;
use Response;

/**
 * Class TypeController
 * @package App\Http\Controllers\API
 */

class TypeAPIController extends AppBaseController
{
    /** @var  TypeRepository */
    private $typeRepository;

    public function __construct(TypeRepository $typeRepo)
    {
        $this->middleware('auth:api');
        $this->typeRepository = $typeRepo;
    }

    /**
     * @param Request $request
     * @return Response
     *
     * @SWG\Get(
     *      path="/types",
     *      summary="Get a listing of the Types.",
     *      tags={"Type"},
     *      description="Get all Types",
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
     *                  @SWG\Items(ref="#/definitions/Type")
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
        $this->typeRepository->pushCriteria(new RequestCriteria($request));
        $this->typeRepository->pushCriteria(new LimitOffsetCriteria($request));
        $types = $this->typeRepository->all();

        return $this->sendResponse($types->toArray(), 'Types retrieved successfully');
    }

    /**
     * @param CreateTypeAPIRequest $request
     * @return Response
     *
     * @SWG\Post(
     *      path="/types",
     *      summary="Store a newly created Type in storage",
     *      tags={"Type"},
     *      description="Store Type",
     *      produces={"application/json"},
     *      @SWG\Parameter(
     *          name="body",
     *          in="body",
     *          description="Type that should be stored",
     *          required=false,
     *          @SWG\Schema(ref="#/definitions/Type")
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
     *                  ref="#/definitions/Type"
     *              ),
     *              @SWG\Property(
     *                  property="message",
     *                  type="string"
     *              )
     *          )
     *      )
     * )
     */
    public function store(CreateTypeAPIRequest $request)
    {
        $input = $request->all();

        $types = $this->typeRepository->create($input);

        return $this->sendResponse($types->toArray(), 'Type saved successfully');
    }

    /**
     * @param int $id
     * @return Response
     *
     * @SWG\Get(
     *      path="/types/{id}",
     *      summary="Display the specified Type",
     *      tags={"Type"},
     *      description="Get Type",
     *      produces={"application/json"},
     *      @SWG\Parameter(
     *          name="id",
     *          description="id of Type",
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
     *                  ref="#/definitions/Type"
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
        /** @var Type $type */
        $type = $this->typeRepository->findWithoutFail($id);

        if (empty($type)) {
            return $this->sendError('Type not found');
        }

        return $this->sendResponse($type->toArray(), 'Type retrieved successfully');
    }

    /**
     * @param int $id
     * @param UpdateTypeAPIRequest $request
     * @return Response
     *
     * @SWG\Put(
     *      path="/types/{id}",
     *      summary="Update the specified Type in storage",
     *      tags={"Type"},
     *      description="Update Type",
     *      produces={"application/json"},
     *      @SWG\Parameter(
     *          name="id",
     *          description="id of Type",
     *          type="integer",
     *          required=true,
     *          in="path"
     *      ),
     *      @SWG\Parameter(
     *          name="body",
     *          in="body",
     *          description="Type that should be updated",
     *          required=false,
     *          @SWG\Schema(ref="#/definitions/Type")
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
     *                  ref="#/definitions/Type"
     *              ),
     *              @SWG\Property(
     *                  property="message",
     *                  type="string"
     *              )
     *          )
     *      )
     * )
     */
    public function update($id, UpdateTypeAPIRequest $request)
    {
        $input = $request->all();

        /** @var Type $type */
        $type = $this->typeRepository->findWithoutFail($id);

        if (empty($type)) {
            return $this->sendError('Type not found');
        }

        $type = $this->typeRepository->update($input, $id);

        return $this->sendResponse($type->toArray(), 'Type updated successfully');
    }

    /**
     * @param int $id
     * @return Response
     *
     * @SWG\Delete(
     *      path="/types/{id}",
     *      summary="Remove the specified Type from storage",
     *      tags={"Type"},
     *      description="Delete Type",
     *      produces={"application/json"},
     *      @SWG\Parameter(
     *          name="id",
     *          description="id of Type",
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
        /** @var Type $type */
        $type = $this->typeRepository->findWithoutFail($id);

        if (empty($type)) {
            return $this->sendError('Type not found');
        }

        $type->delete();

        return $this->sendResponse($id, 'Type deleted successfully');
    }
}
