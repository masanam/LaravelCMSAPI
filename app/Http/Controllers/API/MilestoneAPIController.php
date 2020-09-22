<?php

namespace App\Http\Controllers\API;

use App\Http\Requests\API\CreateMilestoneAPIRequest;
use App\Http\Requests\API\UpdateMilestoneAPIRequest;
use App\Models\Milestone;
use App\Repositories\MilestoneRepository;
use Illuminate\Http\Request;
use App\Http\Controllers\AppBaseController;
use Webcore\Generator\Criteria\LimitOffsetCriteria;
use Prettus\Repository\Criteria\RequestCriteria;
use Response;

/**
 * Class MilestoneController
 * @package App\Http\Controllers\API
 */

class MilestoneAPIController extends AppBaseController
{
    /** @var  MilestoneRepository */
    private $milestoneRepository;

    public function __construct(MilestoneRepository $milestoneRepo)
    {
        $this->middleware('auth:api');
        $this->milestoneRepository = $milestoneRepo;
    }

    /**
     * @param Request $request
     * @return Response
     *
     * @SWG\Get(
     *      path="/milestones",
     *      summary="Get a listing of the Milestones.",
     *      tags={"Milestone"},
     *      description="Get all Milestones",
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
     *                  @SWG\Items(ref="#/definitions/Milestone")
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
        $this->milestoneRepository->pushCriteria(new RequestCriteria($request));
        $this->milestoneRepository->pushCriteria(new LimitOffsetCriteria($request));
        $milestones = $this->milestoneRepository->all();

        return $this->sendResponse($milestones->toArray(), 'Milestones retrieved successfully');
    }

    /**
     * @param CreateMilestoneAPIRequest $request
     * @return Response
     *
     * @SWG\Post(
     *      path="/milestones",
     *      summary="Store a newly created Milestone in storage",
     *      tags={"Milestone"},
     *      description="Store Milestone",
     *      produces={"application/json"},
     *      @SWG\Parameter(
     *          name="body",
     *          in="body",
     *          description="Milestone that should be stored",
     *          required=false,
     *          @SWG\Schema(ref="#/definitions/Milestone")
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
     *                  ref="#/definitions/Milestone"
     *              ),
     *              @SWG\Property(
     *                  property="message",
     *                  type="string"
     *              )
     *          )
     *      )
     * )
     */
    public function store(CreateMilestoneAPIRequest $request)
    {
        $input = $request->all();

        $milestones = $this->milestoneRepository->create($input);

        return $this->sendResponse($milestones->toArray(), 'Milestone saved successfully');
    }

    /**
     * @param int $id
     * @return Response
     *
     * @SWG\Get(
     *      path="/milestones/{id}",
     *      summary="Display the specified Milestone",
     *      tags={"Milestone"},
     *      description="Get Milestone",
     *      produces={"application/json"},
     *      @SWG\Parameter(
     *          name="id",
     *          description="id of Milestone",
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
     *                  ref="#/definitions/Milestone"
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
        /** @var Milestone $milestone */
        $milestone = $this->milestoneRepository->findWithoutFail($id);

        if (empty($milestone)) {
            return $this->sendError('Milestone not found');
        }

        return $this->sendResponse($milestone->toArray(), 'Milestone retrieved successfully');
    }

    /**
     * @param int $id
     * @param UpdateMilestoneAPIRequest $request
     * @return Response
     *
     * @SWG\Put(
     *      path="/milestones/{id}",
     *      summary="Update the specified Milestone in storage",
     *      tags={"Milestone"},
     *      description="Update Milestone",
     *      produces={"application/json"},
     *      @SWG\Parameter(
     *          name="id",
     *          description="id of Milestone",
     *          type="integer",
     *          required=true,
     *          in="path"
     *      ),
     *      @SWG\Parameter(
     *          name="body",
     *          in="body",
     *          description="Milestone that should be updated",
     *          required=false,
     *          @SWG\Schema(ref="#/definitions/Milestone")
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
     *                  ref="#/definitions/Milestone"
     *              ),
     *              @SWG\Property(
     *                  property="message",
     *                  type="string"
     *              )
     *          )
     *      )
     * )
     */
    public function update($id, UpdateMilestoneAPIRequest $request)
    {
        $input = $request->all();

        /** @var Milestone $milestone */
        $milestone = $this->milestoneRepository->findWithoutFail($id);

        if (empty($milestone)) {
            return $this->sendError('Milestone not found');
        }

        $milestone = $this->milestoneRepository->update($input, $id);

        return $this->sendResponse($milestone->toArray(), 'Milestone updated successfully');
    }

    /**
     * @param int $id
     * @return Response
     *
     * @SWG\Delete(
     *      path="/milestones/{id}",
     *      summary="Remove the specified Milestone from storage",
     *      tags={"Milestone"},
     *      description="Delete Milestone",
     *      produces={"application/json"},
     *      @SWG\Parameter(
     *          name="id",
     *          description="id of Milestone",
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
        /** @var Milestone $milestone */
        $milestone = $this->milestoneRepository->findWithoutFail($id);

        if (empty($milestone)) {
            return $this->sendError('Milestone not found');
        }

        $milestone->delete();

        return $this->sendResponse($id, 'Milestone deleted successfully');
    }
}
