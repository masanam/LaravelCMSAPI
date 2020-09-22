<?php

namespace App\Http\Controllers\API;

use App\Http\Requests\API\CreatePartAPIRequest;
use App\Http\Requests\API\UpdatePartAPIRequest;
use App\Models\Part;
use App\Repositories\PartRepository;
use Illuminate\Http\Request;
use App\Http\Controllers\AppBaseController;
use Webcore\Generator\Criteria\LimitOffsetCriteria;
use Prettus\Repository\Criteria\RequestCriteria;
use Response;

/**
 * Class PartController
 * @package App\Http\Controllers\API
 */

class PartAPIController extends AppBaseController
{
    /** @var  PartRepository */
    private $partRepository;

    public function __construct(PartRepository $partRepo)
    {
        $this->middleware('auth:api');
        $this->partRepository = $partRepo;
    }

    /**
     * @param Request $request
     * @return Response
     *
     * @SWG\Get(
     *      path="/parts",
     *      summary="Get a listing of the Parts.",
     *      tags={"Part"},
     *      description="Get all Parts",
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
     *                  @SWG\Items(ref="#/definitions/Part")
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
        $this->partRepository->pushCriteria(new RequestCriteria($request));
        $this->partRepository->pushCriteria(new LimitOffsetCriteria($request));
        $parts = $this->partRepository->all();

        return $this->sendResponse($parts->toArray(), 'Parts retrieved successfully');
    }

    /**
     * @param CreatePartAPIRequest $request
     * @return Response
     *
     * @SWG\Post(
     *      path="/parts",
     *      summary="Store a newly created Part in storage",
     *      tags={"Part"},
     *      description="Store Part",
     *      produces={"application/json"},
     *      @SWG\Parameter(
     *          name="body",
     *          in="body",
     *          description="Part that should be stored",
     *          required=false,
     *          @SWG\Schema(ref="#/definitions/Part")
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
     *                  ref="#/definitions/Part"
     *              ),
     *              @SWG\Property(
     *                  property="message",
     *                  type="string"
     *              )
     *          )
     *      )
     * )
     */
    public function store(CreatePartAPIRequest $request)
    {
        $input = $request->all();

        $parts = $this->partRepository->create($input);

        return $this->sendResponse($parts->toArray(), 'Part saved successfully');
    }

    /**
     * @param int $id
     * @return Response
     *
     * @SWG\Get(
     *      path="/parts/{id}",
     *      summary="Display the specified Part",
     *      tags={"Part"},
     *      description="Get Part",
     *      produces={"application/json"},
     *      @SWG\Parameter(
     *          name="id",
     *          description="id of Part",
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
     *                  ref="#/definitions/Part"
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
        /** @var Part $part */
        $part = $this->partRepository->findWithoutFail($id);

        if (empty($part)) {
            return $this->sendError('Part not found');
        }

        return $this->sendResponse($part->toArray(), 'Part retrieved successfully');
    }

    /**
     * @param int $id
     * @param UpdatePartAPIRequest $request
     * @return Response
     *
     * @SWG\Put(
     *      path="/parts/{id}",
     *      summary="Update the specified Part in storage",
     *      tags={"Part"},
     *      description="Update Part",
     *      produces={"application/json"},
     *      @SWG\Parameter(
     *          name="id",
     *          description="id of Part",
     *          type="integer",
     *          required=true,
     *          in="path"
     *      ),
     *      @SWG\Parameter(
     *          name="body",
     *          in="body",
     *          description="Part that should be updated",
     *          required=false,
     *          @SWG\Schema(ref="#/definitions/Part")
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
     *                  ref="#/definitions/Part"
     *              ),
     *              @SWG\Property(
     *                  property="message",
     *                  type="string"
     *              )
     *          )
     *      )
     * )
     */
    public function update($id, UpdatePartAPIRequest $request)
    {
        $input = $request->all();

        /** @var Part $part */
        $part = $this->partRepository->findWithoutFail($id);

        if (empty($part)) {
            return $this->sendError('Part not found');
        }

        $part = $this->partRepository->update($input, $id);

        return $this->sendResponse($part->toArray(), 'Part updated successfully');
    }

    /**
     * @param int $id
     * @return Response
     *
     * @SWG\Delete(
     *      path="/parts/{id}",
     *      summary="Remove the specified Part from storage",
     *      tags={"Part"},
     *      description="Delete Part",
     *      produces={"application/json"},
     *      @SWG\Parameter(
     *          name="id",
     *          description="id of Part",
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
        /** @var Part $part */
        $part = $this->partRepository->findWithoutFail($id);

        if (empty($part)) {
            return $this->sendError('Part not found');
        }

        $part->delete();

        return $this->sendResponse($id, 'Part deleted successfully');
    }
}
