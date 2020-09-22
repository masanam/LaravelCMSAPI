<?php

namespace App\Http\Controllers\API;

use App\Http\Requests\API\CreateReleaseAPIRequest;
use App\Http\Requests\API\UpdateReleaseAPIRequest;
use App\Models\Release;
use App\Repositories\ReleaseRepository;
use Illuminate\Http\Request;
use App\Http\Controllers\AppBaseController;
use Webcore\Generator\Criteria\LimitOffsetCriteria;
use Prettus\Repository\Criteria\RequestCriteria;
use Response;

/**
 * Class ReleaseController
 * @package App\Http\Controllers\API
 */

class ReleaseAPIController extends AppBaseController
{
    /** @var  ReleaseRepository */
    private $releaseRepository;

    public function __construct(ReleaseRepository $releaseRepo)
    {
        $this->middleware('auth:api');
        $this->releaseRepository = $releaseRepo;
    }

    /**
     * @param Request $request
     * @return Response
     *
     * @SWG\Get(
     *      path="/releases",
     *      summary="Get a listing of the Releases.",
     *      tags={"Release"},
     *      description="Get all Releases",
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
     *                  @SWG\Items(ref="#/definitions/Release")
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
        $this->releaseRepository->pushCriteria(new RequestCriteria($request));
        $this->releaseRepository->pushCriteria(new LimitOffsetCriteria($request));
        $releases = $this->releaseRepository->all();

        return $this->sendResponse($releases->toArray(), 'Releases retrieved successfully');
    }

    /**
     * @param CreateReleaseAPIRequest $request
     * @return Response
     *
     * @SWG\Post(
     *      path="/releases",
     *      summary="Store a newly created Release in storage",
     *      tags={"Release"},
     *      description="Store Release",
     *      produces={"application/json"},
     *      @SWG\Parameter(
     *          name="body",
     *          in="body",
     *          description="Release that should be stored",
     *          required=false,
     *          @SWG\Schema(ref="#/definitions/Release")
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
     *                  ref="#/definitions/Release"
     *              ),
     *              @SWG\Property(
     *                  property="message",
     *                  type="string"
     *              )
     *          )
     *      )
     * )
     */
    public function store(CreateReleaseAPIRequest $request)
    {
        $input = $request->all();

        $releases = $this->releaseRepository->create($input);

        return $this->sendResponse($releases->toArray(), 'Release saved successfully');
    }

    /**
     * @param int $id
     * @return Response
     *
     * @SWG\Get(
     *      path="/releases/{id}",
     *      summary="Display the specified Release",
     *      tags={"Release"},
     *      description="Get Release",
     *      produces={"application/json"},
     *      @SWG\Parameter(
     *          name="id",
     *          description="id of Release",
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
     *                  ref="#/definitions/Release"
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
        /** @var Release $release */
        $release = $this->releaseRepository->findWithoutFail($id);

        if (empty($release)) {
            return $this->sendError('Release not found');
        }

        return $this->sendResponse($release->toArray(), 'Release retrieved successfully');
    }

    /**
     * @param int $id
     * @param UpdateReleaseAPIRequest $request
     * @return Response
     *
     * @SWG\Put(
     *      path="/releases/{id}",
     *      summary="Update the specified Release in storage",
     *      tags={"Release"},
     *      description="Update Release",
     *      produces={"application/json"},
     *      @SWG\Parameter(
     *          name="id",
     *          description="id of Release",
     *          type="integer",
     *          required=true,
     *          in="path"
     *      ),
     *      @SWG\Parameter(
     *          name="body",
     *          in="body",
     *          description="Release that should be updated",
     *          required=false,
     *          @SWG\Schema(ref="#/definitions/Release")
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
     *                  ref="#/definitions/Release"
     *              ),
     *              @SWG\Property(
     *                  property="message",
     *                  type="string"
     *              )
     *          )
     *      )
     * )
     */
    public function update($id, UpdateReleaseAPIRequest $request)
    {
        $input = $request->all();

        /** @var Release $release */
        $release = $this->releaseRepository->findWithoutFail($id);

        if (empty($release)) {
            return $this->sendError('Release not found');
        }

        $release = $this->releaseRepository->update($input, $id);

        return $this->sendResponse($release->toArray(), 'Release updated successfully');
    }

    /**
     * @param int $id
     * @return Response
     *
     * @SWG\Delete(
     *      path="/releases/{id}",
     *      summary="Remove the specified Release from storage",
     *      tags={"Release"},
     *      description="Delete Release",
     *      produces={"application/json"},
     *      @SWG\Parameter(
     *          name="id",
     *          description="id of Release",
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
        /** @var Release $release */
        $release = $this->releaseRepository->findWithoutFail($id);

        if (empty($release)) {
            return $this->sendError('Release not found');
        }

        $release->delete();

        return $this->sendResponse($id, 'Release deleted successfully');
    }
}
