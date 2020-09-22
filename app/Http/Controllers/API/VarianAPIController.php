<?php

namespace App\Http\Controllers\API;

use App\Http\Requests\API\CreateVarianAPIRequest;
use App\Http\Requests\API\UpdateVarianAPIRequest;
use App\Models\Varian;
use App\Repositories\VarianRepository;
use Illuminate\Http\Request;
use App\Http\Controllers\AppBaseController;
use Webcore\Generator\Criteria\LimitOffsetCriteria;
use Prettus\Repository\Criteria\RequestCriteria;
use Response;

/**
 * Class VarianController
 * @package App\Http\Controllers\API
 */

class VarianAPIController extends AppBaseController
{
    /** @var  VarianRepository */
    private $varianRepository;

    public function __construct(VarianRepository $varianRepo)
    {
        $this->middleware('auth:api');
        $this->varianRepository = $varianRepo;
    }

    /**
     * @param Request $request
     * @return Response
     *
     * @SWG\Get(
     *      path="/varians",
     *      summary="Get a listing of the Varians.",
     *      tags={"Varian"},
     *      description="Get all Varians",
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
     *                  @SWG\Items(ref="#/definitions/Varian")
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
        $this->varianRepository->pushCriteria(new RequestCriteria($request));
        $this->varianRepository->pushCriteria(new LimitOffsetCriteria($request));
        $varians = $this->varianRepository->all();

        return $this->sendResponse($varians->toArray(), 'Varians retrieved successfully');
    }

    /**
     * @param CreateVarianAPIRequest $request
     * @return Response
     *
     * @SWG\Post(
     *      path="/varians",
     *      summary="Store a newly created Varian in storage",
     *      tags={"Varian"},
     *      description="Store Varian",
     *      produces={"application/json"},
     *      @SWG\Parameter(
     *          name="body",
     *          in="body",
     *          description="Varian that should be stored",
     *          required=false,
     *          @SWG\Schema(ref="#/definitions/Varian")
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
     *                  ref="#/definitions/Varian"
     *              ),
     *              @SWG\Property(
     *                  property="message",
     *                  type="string"
     *              )
     *          )
     *      )
     * )
     */
    public function store(CreateVarianAPIRequest $request)
    {
        $input = $request->all();

        $varians = $this->varianRepository->create($input);

        return $this->sendResponse($varians->toArray(), 'Varian saved successfully');
    }

    /**
     * @param int $id
     * @return Response
     *
     * @SWG\Get(
     *      path="/varians/{id}",
     *      summary="Display the specified Varian",
     *      tags={"Varian"},
     *      description="Get Varian",
     *      produces={"application/json"},
     *      @SWG\Parameter(
     *          name="id",
     *          description="id of Varian",
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
     *                  ref="#/definitions/Varian"
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
        /** @var Varian $varian */
        $varian = $this->varianRepository->findWithoutFail($id);

        if (empty($varian)) {
            return $this->sendError('Varian not found');
        }

        return $this->sendResponse($varian->toArray(), 'Varian retrieved successfully');
    }

    /**
     * @param int $id
     * @param UpdateVarianAPIRequest $request
     * @return Response
     *
     * @SWG\Put(
     *      path="/varians/{id}",
     *      summary="Update the specified Varian in storage",
     *      tags={"Varian"},
     *      description="Update Varian",
     *      produces={"application/json"},
     *      @SWG\Parameter(
     *          name="id",
     *          description="id of Varian",
     *          type="integer",
     *          required=true,
     *          in="path"
     *      ),
     *      @SWG\Parameter(
     *          name="body",
     *          in="body",
     *          description="Varian that should be updated",
     *          required=false,
     *          @SWG\Schema(ref="#/definitions/Varian")
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
     *                  ref="#/definitions/Varian"
     *              ),
     *              @SWG\Property(
     *                  property="message",
     *                  type="string"
     *              )
     *          )
     *      )
     * )
     */
    public function update($id, UpdateVarianAPIRequest $request)
    {
        $input = $request->all();

        /** @var Varian $varian */
        $varian = $this->varianRepository->findWithoutFail($id);

        if (empty($varian)) {
            return $this->sendError('Varian not found');
        }

        $varian = $this->varianRepository->update($input, $id);

        return $this->sendResponse($varian->toArray(), 'Varian updated successfully');
    }

    /**
     * @param int $id
     * @return Response
     *
     * @SWG\Delete(
     *      path="/varians/{id}",
     *      summary="Remove the specified Varian from storage",
     *      tags={"Varian"},
     *      description="Delete Varian",
     *      produces={"application/json"},
     *      @SWG\Parameter(
     *          name="id",
     *          description="id of Varian",
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
        /** @var Varian $varian */
        $varian = $this->varianRepository->findWithoutFail($id);

        if (empty($varian)) {
            return $this->sendError('Varian not found');
        }

        $varian->delete();

        return $this->sendResponse($id, 'Varian deleted successfully');
    }
}
