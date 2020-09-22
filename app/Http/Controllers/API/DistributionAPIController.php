<?php

namespace App\Http\Controllers\API;

use App\Http\Requests\API\CreateDistributionAPIRequest;
use App\Http\Requests\API\UpdateDistributionAPIRequest;
use App\Models\Distribution;
use App\Repositories\DistributionRepository;
use Illuminate\Http\Request;
use App\Http\Controllers\AppBaseController;
use Webcore\Generator\Criteria\LimitOffsetCriteria;
use Prettus\Repository\Criteria\RequestCriteria;
use Response;

/**
 * Class DistributionController
 * @package App\Http\Controllers\API
 */

class DistributionAPIController extends AppBaseController
{
    /** @var  DistributionRepository */
    private $distributionRepository;

    public function __construct(DistributionRepository $distributionRepo)
    {
        $this->middleware('auth:api');
        $this->distributionRepository = $distributionRepo;
    }

    /**
     * @param Request $request
     * @return Response
     *
     * @SWG\Get(
     *      path="/distributions",
     *      summary="Get a listing of the Distributions.",
     *      tags={"Distribution"},
     *      description="Get all Distributions",
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
     *                  @SWG\Items(ref="#/definitions/Distribution")
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
        $this->distributionRepository->pushCriteria(new RequestCriteria($request));
        $this->distributionRepository->pushCriteria(new LimitOffsetCriteria($request));
        $distributions = $this->distributionRepository->all();

        return $this->sendResponse($distributions->toArray(), 'Distributions retrieved successfully');
    }

    /**
     * @param CreateDistributionAPIRequest $request
     * @return Response
     *
     * @SWG\Post(
     *      path="/distributions",
     *      summary="Store a newly created Distribution in storage",
     *      tags={"Distribution"},
     *      description="Store Distribution",
     *      produces={"application/json"},
     *      @SWG\Parameter(
     *          name="body",
     *          in="body",
     *          description="Distribution that should be stored",
     *          required=false,
     *          @SWG\Schema(ref="#/definitions/Distribution")
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
     *                  ref="#/definitions/Distribution"
     *              ),
     *              @SWG\Property(
     *                  property="message",
     *                  type="string"
     *              )
     *          )
     *      )
     * )
     */
    public function store(CreateDistributionAPIRequest $request)
    {
        $input = $request->all();

        $distributions = $this->distributionRepository->create($input);

        return $this->sendResponse($distributions->toArray(), 'Distribution saved successfully');
    }

    /**
     * @param int $id
     * @return Response
     *
     * @SWG\Get(
     *      path="/distributions/{id}",
     *      summary="Display the specified Distribution",
     *      tags={"Distribution"},
     *      description="Get Distribution",
     *      produces={"application/json"},
     *      @SWG\Parameter(
     *          name="id",
     *          description="id of Distribution",
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
     *                  ref="#/definitions/Distribution"
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
        /** @var Distribution $distribution */
        $distribution = $this->distributionRepository->findWithoutFail($id);

        if (empty($distribution)) {
            return $this->sendError('Distribution not found');
        }

        return $this->sendResponse($distribution->toArray(), 'Distribution retrieved successfully');
    }

    /**
     * @param int $id
     * @param UpdateDistributionAPIRequest $request
     * @return Response
     *
     * @SWG\Put(
     *      path="/distributions/{id}",
     *      summary="Update the specified Distribution in storage",
     *      tags={"Distribution"},
     *      description="Update Distribution",
     *      produces={"application/json"},
     *      @SWG\Parameter(
     *          name="id",
     *          description="id of Distribution",
     *          type="integer",
     *          required=true,
     *          in="path"
     *      ),
     *      @SWG\Parameter(
     *          name="body",
     *          in="body",
     *          description="Distribution that should be updated",
     *          required=false,
     *          @SWG\Schema(ref="#/definitions/Distribution")
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
     *                  ref="#/definitions/Distribution"
     *              ),
     *              @SWG\Property(
     *                  property="message",
     *                  type="string"
     *              )
     *          )
     *      )
     * )
     */
    public function update($id, UpdateDistributionAPIRequest $request)
    {
        $input = $request->all();

        /** @var Distribution $distribution */
        $distribution = $this->distributionRepository->findWithoutFail($id);

        if (empty($distribution)) {
            return $this->sendError('Distribution not found');
        }

        $distribution = $this->distributionRepository->update($input, $id);

        return $this->sendResponse($distribution->toArray(), 'Distribution updated successfully');
    }

    /**
     * @param int $id
     * @return Response
     *
     * @SWG\Delete(
     *      path="/distributions/{id}",
     *      summary="Remove the specified Distribution from storage",
     *      tags={"Distribution"},
     *      description="Delete Distribution",
     *      produces={"application/json"},
     *      @SWG\Parameter(
     *          name="id",
     *          description="id of Distribution",
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
        /** @var Distribution $distribution */
        $distribution = $this->distributionRepository->findWithoutFail($id);

        if (empty($distribution)) {
            return $this->sendError('Distribution not found');
        }

        $distribution->delete();

        return $this->sendResponse($id, 'Distribution deleted successfully');
    }
}
