<?php

namespace App\Http\Controllers\API;

use App\Http\Requests\API\CreateAdvisorAPIRequest;
use App\Http\Requests\API\UpdateAdvisorAPIRequest;
use App\Models\Advisor;
use App\Repositories\AdvisorRepository;
use Illuminate\Http\Request;
use App\Http\Controllers\AppBaseController;
use Webcore\Generator\Criteria\LimitOffsetCriteria;
use Prettus\Repository\Criteria\RequestCriteria;
use Response;

/**
 * Class AdvisorController
 * @package App\Http\Controllers\API
 */

class AdvisorAPIController extends AppBaseController
{
    /** @var  AdvisorRepository */
    private $advisorRepository;

    public function __construct(AdvisorRepository $advisorRepo)
    {
        $this->middleware('auth:api');
        $this->advisorRepository = $advisorRepo;
    }

    /**
     * @param Request $request
     * @return Response
     *
     * @SWG\Get(
     *      path="/advisors",
     *      summary="Get a listing of the Advisors.",
     *      tags={"Advisor"},
     *      description="Get all Advisors",
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
     *                  @SWG\Items(ref="#/definitions/Advisor")
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
        $this->advisorRepository->pushCriteria(new RequestCriteria($request));
        $this->advisorRepository->pushCriteria(new LimitOffsetCriteria($request));
        $advisors = $this->advisorRepository->all();

        return $this->sendResponse($advisors->toArray(), 'Advisors retrieved successfully');
    }

    /**
     * @param CreateAdvisorAPIRequest $request
     * @return Response
     *
     * @SWG\Post(
     *      path="/advisors",
     *      summary="Store a newly created Advisor in storage",
     *      tags={"Advisor"},
     *      description="Store Advisor",
     *      produces={"application/json"},
     *      @SWG\Parameter(
     *          name="body",
     *          in="body",
     *          description="Advisor that should be stored",
     *          required=false,
     *          @SWG\Schema(ref="#/definitions/Advisor")
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
     *                  ref="#/definitions/Advisor"
     *              ),
     *              @SWG\Property(
     *                  property="message",
     *                  type="string"
     *              )
     *          )
     *      )
     * )
     */
    public function store(CreateAdvisorAPIRequest $request)
    {
        $input = $request->all();

        $advisors = $this->advisorRepository->create($input);

        return $this->sendResponse($advisors->toArray(), 'Advisor saved successfully');
    }

    /**
     * @param int $id
     * @return Response
     *
     * @SWG\Get(
     *      path="/advisors/{id}",
     *      summary="Display the specified Advisor",
     *      tags={"Advisor"},
     *      description="Get Advisor",
     *      produces={"application/json"},
     *      @SWG\Parameter(
     *          name="id",
     *          description="id of Advisor",
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
     *                  ref="#/definitions/Advisor"
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
        /** @var Advisor $advisor */
        $advisor = $this->advisorRepository->findWithoutFail($id);

        if (empty($advisor)) {
            return $this->sendError('Advisor not found');
        }

        return $this->sendResponse($advisor->toArray(), 'Advisor retrieved successfully');
    }

    /**
     * @param int $id
     * @param UpdateAdvisorAPIRequest $request
     * @return Response
     *
     * @SWG\Put(
     *      path="/advisors/{id}",
     *      summary="Update the specified Advisor in storage",
     *      tags={"Advisor"},
     *      description="Update Advisor",
     *      produces={"application/json"},
     *      @SWG\Parameter(
     *          name="id",
     *          description="id of Advisor",
     *          type="integer",
     *          required=true,
     *          in="path"
     *      ),
     *      @SWG\Parameter(
     *          name="body",
     *          in="body",
     *          description="Advisor that should be updated",
     *          required=false,
     *          @SWG\Schema(ref="#/definitions/Advisor")
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
     *                  ref="#/definitions/Advisor"
     *              ),
     *              @SWG\Property(
     *                  property="message",
     *                  type="string"
     *              )
     *          )
     *      )
     * )
     */
    public function update($id, UpdateAdvisorAPIRequest $request)
    {
        $input = $request->all();

        /** @var Advisor $advisor */
        $advisor = $this->advisorRepository->findWithoutFail($id);

        if (empty($advisor)) {
            return $this->sendError('Advisor not found');
        }

        $advisor = $this->advisorRepository->update($input, $id);

        return $this->sendResponse($advisor->toArray(), 'Advisor updated successfully');
    }

    /**
     * @param int $id
     * @return Response
     *
     * @SWG\Delete(
     *      path="/advisors/{id}",
     *      summary="Remove the specified Advisor from storage",
     *      tags={"Advisor"},
     *      description="Delete Advisor",
     *      produces={"application/json"},
     *      @SWG\Parameter(
     *          name="id",
     *          description="id of Advisor",
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
        /** @var Advisor $advisor */
        $advisor = $this->advisorRepository->findWithoutFail($id);

        if (empty($advisor)) {
            return $this->sendError('Advisor not found');
        }

        $advisor->delete();

        return $this->sendResponse($id, 'Advisor deleted successfully');
    }
}
