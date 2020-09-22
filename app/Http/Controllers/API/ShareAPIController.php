<?php

namespace App\Http\Controllers\API;

use App\Http\Requests\API\CreateShareAPIRequest;
use App\Http\Requests\API\UpdateShareAPIRequest;
use App\Models\Share;
use App\Repositories\ShareRepository;
use Illuminate\Http\Request;
use App\Http\Controllers\AppBaseController;
use Webcore\Generator\Criteria\LimitOffsetCriteria;
use Prettus\Repository\Criteria\RequestCriteria;
use Response;

/**
 * Class ShareController
 * @package App\Http\Controllers\API
 */

class ShareAPIController extends AppBaseController
{
    /** @var  ShareRepository */
    private $shareRepository;

    public function __construct(ShareRepository $shareRepo)
    {
        $this->middleware('auth:api');
        $this->shareRepository = $shareRepo;
    }

    /**
     * @param Request $request
     * @return Response
     *
     * @SWG\Get(
     *      path="/shares",
     *      summary="Get a listing of the Shares.",
     *      tags={"Share"},
     *      description="Get all Shares",
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
     *                  @SWG\Items(ref="#/definitions/Share")
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
        $this->shareRepository->pushCriteria(new RequestCriteria($request));
        $this->shareRepository->pushCriteria(new LimitOffsetCriteria($request));
        $shares = $this->shareRepository->all();

        return $this->sendResponse($shares->toArray(), 'Shares retrieved successfully');
    }

    /**
     * @param CreateShareAPIRequest $request
     * @return Response
     *
     * @SWG\Post(
     *      path="/shares",
     *      summary="Store a newly created Share in storage",
     *      tags={"Share"},
     *      description="Store Share",
     *      produces={"application/json"},
     *      @SWG\Parameter(
     *          name="body",
     *          in="body",
     *          description="Share that should be stored",
     *          required=false,
     *          @SWG\Schema(ref="#/definitions/Share")
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
     *                  ref="#/definitions/Share"
     *              ),
     *              @SWG\Property(
     *                  property="message",
     *                  type="string"
     *              )
     *          )
     *      )
     * )
     */
    public function store(CreateShareAPIRequest $request)
    {
        $input = $request->all();

        $shares = $this->shareRepository->create($input);

        return $this->sendResponse($shares->toArray(), 'Share saved successfully');
    }

    /**
     * @param int $id
     * @return Response
     *
     * @SWG\Get(
     *      path="/shares/{id}",
     *      summary="Display the specified Share",
     *      tags={"Share"},
     *      description="Get Share",
     *      produces={"application/json"},
     *      @SWG\Parameter(
     *          name="id",
     *          description="id of Share",
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
     *                  ref="#/definitions/Share"
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
        /** @var Share $share */
        $share = $this->shareRepository->findWithoutFail($id);

        if (empty($share)) {
            return $this->sendError('Share not found');
        }

        return $this->sendResponse($share->toArray(), 'Share retrieved successfully');
    }

    /**
     * @param int $id
     * @param UpdateShareAPIRequest $request
     * @return Response
     *
     * @SWG\Put(
     *      path="/shares/{id}",
     *      summary="Update the specified Share in storage",
     *      tags={"Share"},
     *      description="Update Share",
     *      produces={"application/json"},
     *      @SWG\Parameter(
     *          name="id",
     *          description="id of Share",
     *          type="integer",
     *          required=true,
     *          in="path"
     *      ),
     *      @SWG\Parameter(
     *          name="body",
     *          in="body",
     *          description="Share that should be updated",
     *          required=false,
     *          @SWG\Schema(ref="#/definitions/Share")
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
     *                  ref="#/definitions/Share"
     *              ),
     *              @SWG\Property(
     *                  property="message",
     *                  type="string"
     *              )
     *          )
     *      )
     * )
     */
    public function update($id, UpdateShareAPIRequest $request)
    {
        $input = $request->all();

        /** @var Share $share */
        $share = $this->shareRepository->findWithoutFail($id);

        if (empty($share)) {
            return $this->sendError('Share not found');
        }

        $share = $this->shareRepository->update($input, $id);

        return $this->sendResponse($share->toArray(), 'Share updated successfully');
    }

    /**
     * @param int $id
     * @return Response
     *
     * @SWG\Delete(
     *      path="/shares/{id}",
     *      summary="Remove the specified Share from storage",
     *      tags={"Share"},
     *      description="Delete Share",
     *      produces={"application/json"},
     *      @SWG\Parameter(
     *          name="id",
     *          description="id of Share",
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
        /** @var Share $share */
        $share = $this->shareRepository->findWithoutFail($id);

        if (empty($share)) {
            return $this->sendError('Share not found');
        }

        $share->delete();

        return $this->sendResponse($id, 'Share deleted successfully');
    }
}
