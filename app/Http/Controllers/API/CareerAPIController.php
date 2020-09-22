<?php

namespace App\Http\Controllers\API;

use App\Http\Requests\API\CreateCareerAPIRequest;
use App\Http\Requests\API\UpdateCareerAPIRequest;
use App\Models\Career;
use App\Repositories\CareerRepository;
use Illuminate\Http\Request;
use App\Http\Controllers\AppBaseController;
use Webcore\Generator\Criteria\LimitOffsetCriteria;
use Prettus\Repository\Criteria\RequestCriteria;
use Response;

/**
 * Class CareerController
 * @package App\Http\Controllers\API
 */

class CareerAPIController extends AppBaseController
{
    /** @var  CareerRepository */
    private $careerRepository;

    public function __construct(CareerRepository $careerRepo)
    {
        $this->middleware('auth:api');
        $this->careerRepository = $careerRepo;
    }

    /**
     * @param Request $request
     * @return Response
     *
     * @SWG\Get(
     *      path="/careers",
     *      summary="Get a listing of the Careers.",
     *      tags={"Career"},
     *      description="Get all Careers",
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
     *                  @SWG\Items(ref="#/definitions/Career")
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
        $this->careerRepository->pushCriteria(new RequestCriteria($request));
        $this->careerRepository->pushCriteria(new LimitOffsetCriteria($request));
        $careers = $this->careerRepository->all();

        return $this->sendResponse($careers->toArray(), 'Careers retrieved successfully');
    }

    /**
     * @param CreateCareerAPIRequest $request
     * @return Response
     *
     * @SWG\Post(
     *      path="/careers",
     *      summary="Store a newly created Career in storage",
     *      tags={"Career"},
     *      description="Store Career",
     *      produces={"application/json"},
     *      @SWG\Parameter(
     *          name="body",
     *          in="body",
     *          description="Career that should be stored",
     *          required=false,
     *          @SWG\Schema(ref="#/definitions/Career")
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
     *                  ref="#/definitions/Career"
     *              ),
     *              @SWG\Property(
     *                  property="message",
     *                  type="string"
     *              )
     *          )
     *      )
     * )
     */
    public function store(CreateCareerAPIRequest $request)
    {
        $input = $request->all();

        $careers = $this->careerRepository->create($input);

        return $this->sendResponse($careers->toArray(), 'Career saved successfully');
    }

    /**
     * @param int $id
     * @return Response
     *
     * @SWG\Get(
     *      path="/careers/{id}",
     *      summary="Display the specified Career",
     *      tags={"Career"},
     *      description="Get Career",
     *      produces={"application/json"},
     *      @SWG\Parameter(
     *          name="id",
     *          description="id of Career",
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
     *                  ref="#/definitions/Career"
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
        /** @var Career $career */
        $career = $this->careerRepository->findWithoutFail($id);

        if (empty($career)) {
            return $this->sendError('Career not found');
        }

        return $this->sendResponse($career->toArray(), 'Career retrieved successfully');
    }

    /**
     * @param int $id
     * @param UpdateCareerAPIRequest $request
     * @return Response
     *
     * @SWG\Put(
     *      path="/careers/{id}",
     *      summary="Update the specified Career in storage",
     *      tags={"Career"},
     *      description="Update Career",
     *      produces={"application/json"},
     *      @SWG\Parameter(
     *          name="id",
     *          description="id of Career",
     *          type="integer",
     *          required=true,
     *          in="path"
     *      ),
     *      @SWG\Parameter(
     *          name="body",
     *          in="body",
     *          description="Career that should be updated",
     *          required=false,
     *          @SWG\Schema(ref="#/definitions/Career")
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
     *                  ref="#/definitions/Career"
     *              ),
     *              @SWG\Property(
     *                  property="message",
     *                  type="string"
     *              )
     *          )
     *      )
     * )
     */
    public function update($id, UpdateCareerAPIRequest $request)
    {
        $input = $request->all();

        /** @var Career $career */
        $career = $this->careerRepository->findWithoutFail($id);

        if (empty($career)) {
            return $this->sendError('Career not found');
        }

        $career = $this->careerRepository->update($input, $id);

        return $this->sendResponse($career->toArray(), 'Career updated successfully');
    }

    /**
     * @param int $id
     * @return Response
     *
     * @SWG\Delete(
     *      path="/careers/{id}",
     *      summary="Remove the specified Career from storage",
     *      tags={"Career"},
     *      description="Delete Career",
     *      produces={"application/json"},
     *      @SWG\Parameter(
     *          name="id",
     *          description="id of Career",
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
        /** @var Career $career */
        $career = $this->careerRepository->findWithoutFail($id);

        if (empty($career)) {
            return $this->sendError('Career not found');
        }

        $career->delete();

        return $this->sendResponse($id, 'Career deleted successfully');
    }
}
