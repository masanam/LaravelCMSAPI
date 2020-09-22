<?php

namespace App\Http\Controllers\API;

use App\Http\Requests\API\CreateManagementAPIRequest;
use App\Http\Requests\API\UpdateManagementAPIRequest;
use App\Models\Management;
use App\Repositories\ManagementRepository;
use Illuminate\Http\Request;
use App\Http\Controllers\AppBaseController;
use Webcore\Generator\Criteria\LimitOffsetCriteria;
use Prettus\Repository\Criteria\RequestCriteria;
use Response;

/**
 * Class ManagementController
 * @package App\Http\Controllers\API
 */

class ManagementAPIController extends AppBaseController
{
    /** @var  ManagementRepository */
    private $managementRepository;

    public function __construct(ManagementRepository $managementRepo)
    {
        $this->middleware('auth:api');
        $this->managementRepository = $managementRepo;
    }

    /**
     * @param Request $request
     * @return Response
     *
     * @SWG\Get(
     *      path="/managements",
     *      summary="Get a listing of the Managements.",
     *      tags={"Management"},
     *      description="Get all Managements",
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
     *                  @SWG\Items(ref="#/definitions/Management")
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
        $this->managementRepository->pushCriteria(new RequestCriteria($request));
        $this->managementRepository->pushCriteria(new LimitOffsetCriteria($request));
        $managements = $this->managementRepository->all();

        return $this->sendResponse($managements->toArray(), 'Managements retrieved successfully');
    }

    /**
     * @param CreateManagementAPIRequest $request
     * @return Response
     *
     * @SWG\Post(
     *      path="/managements",
     *      summary="Store a newly created Management in storage",
     *      tags={"Management"},
     *      description="Store Management",
     *      produces={"application/json"},
     *      @SWG\Parameter(
     *          name="body",
     *          in="body",
     *          description="Management that should be stored",
     *          required=false,
     *          @SWG\Schema(ref="#/definitions/Management")
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
     *                  ref="#/definitions/Management"
     *              ),
     *              @SWG\Property(
     *                  property="message",
     *                  type="string"
     *              )
     *          )
     *      )
     * )
     */
    public function store(CreateManagementAPIRequest $request)
    {
        $input = $request->all();

        $managements = $this->managementRepository->create($input);

        return $this->sendResponse($managements->toArray(), 'Management saved successfully');
    }

    /**
     * @param int $id
     * @return Response
     *
     * @SWG\Get(
     *      path="/managements/{id}",
     *      summary="Display the specified Management",
     *      tags={"Management"},
     *      description="Get Management",
     *      produces={"application/json"},
     *      @SWG\Parameter(
     *          name="id",
     *          description="id of Management",
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
     *                  ref="#/definitions/Management"
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
        /** @var Management $management */
        $management = $this->managementRepository->findWithoutFail($id);

        if (empty($management)) {
            return $this->sendError('Management not found');
        }

        return $this->sendResponse($management->toArray(), 'Management retrieved successfully');
    }

    /**
     * @param int $id
     * @param UpdateManagementAPIRequest $request
     * @return Response
     *
     * @SWG\Put(
     *      path="/managements/{id}",
     *      summary="Update the specified Management in storage",
     *      tags={"Management"},
     *      description="Update Management",
     *      produces={"application/json"},
     *      @SWG\Parameter(
     *          name="id",
     *          description="id of Management",
     *          type="integer",
     *          required=true,
     *          in="path"
     *      ),
     *      @SWG\Parameter(
     *          name="body",
     *          in="body",
     *          description="Management that should be updated",
     *          required=false,
     *          @SWG\Schema(ref="#/definitions/Management")
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
     *                  ref="#/definitions/Management"
     *              ),
     *              @SWG\Property(
     *                  property="message",
     *                  type="string"
     *              )
     *          )
     *      )
     * )
     */
    public function update($id, UpdateManagementAPIRequest $request)
    {
        $input = $request->all();

        /** @var Management $management */
        $management = $this->managementRepository->findWithoutFail($id);

        if (empty($management)) {
            return $this->sendError('Management not found');
        }

        $management = $this->managementRepository->update($input, $id);

        return $this->sendResponse($management->toArray(), 'Management updated successfully');
    }

    /**
     * @param int $id
     * @return Response
     *
     * @SWG\Delete(
     *      path="/managements/{id}",
     *      summary="Remove the specified Management from storage",
     *      tags={"Management"},
     *      description="Delete Management",
     *      produces={"application/json"},
     *      @SWG\Parameter(
     *          name="id",
     *          description="id of Management",
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
        /** @var Management $management */
        $management = $this->managementRepository->findWithoutFail($id);

        if (empty($management)) {
            return $this->sendError('Management not found');
        }

        $management->delete();

        return $this->sendResponse($id, 'Management deleted successfully');
    }
}
