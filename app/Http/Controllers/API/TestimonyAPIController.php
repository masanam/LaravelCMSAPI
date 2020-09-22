<?php

namespace App\Http\Controllers\API;

use App\Http\Requests\API\CreateTestimonyAPIRequest;
use App\Http\Requests\API\UpdateTestimonyAPIRequest;
use App\Models\Testimony;
use App\Repositories\TestimonyRepository;
use Illuminate\Http\Request;
use App\Http\Controllers\AppBaseController;
use Webcore\Generator\Criteria\LimitOffsetCriteria;
use Prettus\Repository\Criteria\RequestCriteria;
use Response;

/**
 * Class TestimonyController
 * @package App\Http\Controllers\API
 */

class TestimonyAPIController extends AppBaseController
{
    /** @var  TestimonyRepository */
    private $testimonyRepository;

    public function __construct(TestimonyRepository $testimonyRepo)
    {
        $this->middleware('auth:api');
        $this->testimonyRepository = $testimonyRepo;
    }

    /**
     * @param Request $request
     * @return Response
     *
     * @SWG\Get(
     *      path="/testimonies",
     *      summary="Get a listing of the Testimonies.",
     *      tags={"Testimony"},
     *      description="Get all Testimonies",
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
     *                  @SWG\Items(ref="#/definitions/Testimony")
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
        $this->testimonyRepository->pushCriteria(new RequestCriteria($request));
        $this->testimonyRepository->pushCriteria(new LimitOffsetCriteria($request));
        $testimonies = $this->testimonyRepository->all();

        return $this->sendResponse($testimonies->toArray(), 'Testimonies retrieved successfully');
    }

    /**
     * @param CreateTestimonyAPIRequest $request
     * @return Response
     *
     * @SWG\Post(
     *      path="/testimonies",
     *      summary="Store a newly created Testimony in storage",
     *      tags={"Testimony"},
     *      description="Store Testimony",
     *      produces={"application/json"},
     *      @SWG\Parameter(
     *          name="body",
     *          in="body",
     *          description="Testimony that should be stored",
     *          required=false,
     *          @SWG\Schema(ref="#/definitions/Testimony")
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
     *                  ref="#/definitions/Testimony"
     *              ),
     *              @SWG\Property(
     *                  property="message",
     *                  type="string"
     *              )
     *          )
     *      )
     * )
     */
    public function store(CreateTestimonyAPIRequest $request)
    {
        $input = $request->all();

        $testimonies = $this->testimonyRepository->create($input);

        return $this->sendResponse($testimonies->toArray(), 'Testimony saved successfully');
    }

    /**
     * @param int $id
     * @return Response
     *
     * @SWG\Get(
     *      path="/testimonies/{id}",
     *      summary="Display the specified Testimony",
     *      tags={"Testimony"},
     *      description="Get Testimony",
     *      produces={"application/json"},
     *      @SWG\Parameter(
     *          name="id",
     *          description="id of Testimony",
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
     *                  ref="#/definitions/Testimony"
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
        /** @var Testimony $testimony */
        $testimony = $this->testimonyRepository->findWithoutFail($id);

        if (empty($testimony)) {
            return $this->sendError('Testimony not found');
        }

        return $this->sendResponse($testimony->toArray(), 'Testimony retrieved successfully');
    }

    /**
     * @param int $id
     * @param UpdateTestimonyAPIRequest $request
     * @return Response
     *
     * @SWG\Put(
     *      path="/testimonies/{id}",
     *      summary="Update the specified Testimony in storage",
     *      tags={"Testimony"},
     *      description="Update Testimony",
     *      produces={"application/json"},
     *      @SWG\Parameter(
     *          name="id",
     *          description="id of Testimony",
     *          type="integer",
     *          required=true,
     *          in="path"
     *      ),
     *      @SWG\Parameter(
     *          name="body",
     *          in="body",
     *          description="Testimony that should be updated",
     *          required=false,
     *          @SWG\Schema(ref="#/definitions/Testimony")
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
     *                  ref="#/definitions/Testimony"
     *              ),
     *              @SWG\Property(
     *                  property="message",
     *                  type="string"
     *              )
     *          )
     *      )
     * )
     */
    public function update($id, UpdateTestimonyAPIRequest $request)
    {
        $input = $request->all();

        /** @var Testimony $testimony */
        $testimony = $this->testimonyRepository->findWithoutFail($id);

        if (empty($testimony)) {
            return $this->sendError('Testimony not found');
        }

        $testimony = $this->testimonyRepository->update($input, $id);

        return $this->sendResponse($testimony->toArray(), 'Testimony updated successfully');
    }

    /**
     * @param int $id
     * @return Response
     *
     * @SWG\Delete(
     *      path="/testimonies/{id}",
     *      summary="Remove the specified Testimony from storage",
     *      tags={"Testimony"},
     *      description="Delete Testimony",
     *      produces={"application/json"},
     *      @SWG\Parameter(
     *          name="id",
     *          description="id of Testimony",
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
        /** @var Testimony $testimony */
        $testimony = $this->testimonyRepository->findWithoutFail($id);

        if (empty($testimony)) {
            return $this->sendError('Testimony not found');
        }

        $testimony->delete();

        return $this->sendResponse($id, 'Testimony deleted successfully');
    }
}
