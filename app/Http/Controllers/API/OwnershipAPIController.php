<?php

namespace App\Http\Controllers\API;

use App\Http\Requests\API\CreateOwnershipAPIRequest;
use App\Http\Requests\API\UpdateOwnershipAPIRequest;
use App\Models\Ownership;
use App\Repositories\OwnershipRepository;
use Illuminate\Http\Request;
use App\Http\Controllers\AppBaseController;
use Webcore\Generator\Criteria\LimitOffsetCriteria;
use Prettus\Repository\Criteria\RequestCriteria;
use Response;

/**
 * Class OwnershipController
 * @package App\Http\Controllers\API
 */

class OwnershipAPIController extends AppBaseController
{
    /** @var  OwnershipRepository */
    private $ownershipRepository;

    public function __construct(OwnershipRepository $ownershipRepo)
    {
        $this->middleware('auth:api');
        $this->ownershipRepository = $ownershipRepo;
    }

    /**
     * @param Request $request
     * @return Response
     *
     * @SWG\Get(
     *      path="/ownerships",
     *      summary="Get a listing of the Ownerships.",
     *      tags={"Ownership"},
     *      description="Get all Ownerships",
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
     *                  @SWG\Items(ref="#/definitions/Ownership")
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
        $this->ownershipRepository->pushCriteria(new RequestCriteria($request));
        $this->ownershipRepository->pushCriteria(new LimitOffsetCriteria($request));
        $ownerships = $this->ownershipRepository->all();

        return $this->sendResponse($ownerships->toArray(), 'Ownerships retrieved successfully');
    }

    /**
     * @param CreateOwnershipAPIRequest $request
     * @return Response
     *
     * @SWG\Post(
     *      path="/ownerships",
     *      summary="Store a newly created Ownership in storage",
     *      tags={"Ownership"},
     *      description="Store Ownership",
     *      produces={"application/json"},
     *      @SWG\Parameter(
     *          name="body",
     *          in="body",
     *          description="Ownership that should be stored",
     *          required=false,
     *          @SWG\Schema(ref="#/definitions/Ownership")
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
     *                  ref="#/definitions/Ownership"
     *              ),
     *              @SWG\Property(
     *                  property="message",
     *                  type="string"
     *              )
     *          )
     *      )
     * )
     */
    public function store(CreateOwnershipAPIRequest $request)
    {
        $input = $request->all();

        $ownerships = $this->ownershipRepository->create($input);

        return $this->sendResponse($ownerships->toArray(), 'Ownership saved successfully');
    }

    /**
     * @param int $id
     * @return Response
     *
     * @SWG\Get(
     *      path="/ownerships/{id}",
     *      summary="Display the specified Ownership",
     *      tags={"Ownership"},
     *      description="Get Ownership",
     *      produces={"application/json"},
     *      @SWG\Parameter(
     *          name="id",
     *          description="id of Ownership",
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
     *                  ref="#/definitions/Ownership"
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
        /** @var Ownership $ownership */
        $ownership = $this->ownershipRepository->findWithoutFail($id);

        if (empty($ownership)) {
            return $this->sendError('Ownership not found');
        }

        return $this->sendResponse($ownership->toArray(), 'Ownership retrieved successfully');
    }

    /**
     * @param int $id
     * @param UpdateOwnershipAPIRequest $request
     * @return Response
     *
     * @SWG\Put(
     *      path="/ownerships/{id}",
     *      summary="Update the specified Ownership in storage",
     *      tags={"Ownership"},
     *      description="Update Ownership",
     *      produces={"application/json"},
     *      @SWG\Parameter(
     *          name="id",
     *          description="id of Ownership",
     *          type="integer",
     *          required=true,
     *          in="path"
     *      ),
     *      @SWG\Parameter(
     *          name="body",
     *          in="body",
     *          description="Ownership that should be updated",
     *          required=false,
     *          @SWG\Schema(ref="#/definitions/Ownership")
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
     *                  ref="#/definitions/Ownership"
     *              ),
     *              @SWG\Property(
     *                  property="message",
     *                  type="string"
     *              )
     *          )
     *      )
     * )
     */
    public function update($id, UpdateOwnershipAPIRequest $request)
    {
        $input = $request->all();

        /** @var Ownership $ownership */
        $ownership = $this->ownershipRepository->findWithoutFail($id);

        if (empty($ownership)) {
            return $this->sendError('Ownership not found');
        }

        $ownership = $this->ownershipRepository->update($input, $id);

        return $this->sendResponse($ownership->toArray(), 'Ownership updated successfully');
    }

    /**
     * @param int $id
     * @return Response
     *
     * @SWG\Delete(
     *      path="/ownerships/{id}",
     *      summary="Remove the specified Ownership from storage",
     *      tags={"Ownership"},
     *      description="Delete Ownership",
     *      produces={"application/json"},
     *      @SWG\Parameter(
     *          name="id",
     *          description="id of Ownership",
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
        /** @var Ownership $ownership */
        $ownership = $this->ownershipRepository->findWithoutFail($id);

        if (empty($ownership)) {
            return $this->sendError('Ownership not found');
        }

        $ownership->delete();

        return $this->sendResponse($id, 'Ownership deleted successfully');
    }
}
