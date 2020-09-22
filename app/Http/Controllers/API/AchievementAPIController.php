<?php

namespace App\Http\Controllers\API;

use App\Http\Requests\API\CreateAchievementAPIRequest;
use App\Http\Requests\API\UpdateAchievementAPIRequest;
use App\Models\Achievement;
use App\Repositories\AchievementRepository;
use Illuminate\Http\Request;
use App\Http\Controllers\AppBaseController;
use Webcore\Generator\Criteria\LimitOffsetCriteria;
use Prettus\Repository\Criteria\RequestCriteria;
use Response;

/**
 * Class AchievementController
 * @package App\Http\Controllers\API
 */

class AchievementAPIController extends AppBaseController
{
    /** @var  AchievementRepository */
    private $achievementRepository;

    public function __construct(AchievementRepository $achievementRepo)
    {
        $this->middleware('auth:api');
        $this->achievementRepository = $achievementRepo;
    }

    /**
     * @param Request $request
     * @return Response
     *
     * @SWG\Get(
     *      path="/achievements",
     *      summary="Get a listing of the Achievements.",
     *      tags={"Achievement"},
     *      description="Get all Achievements",
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
     *                  @SWG\Items(ref="#/definitions/Achievement")
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
        $this->achievementRepository->pushCriteria(new RequestCriteria($request));
        $this->achievementRepository->pushCriteria(new LimitOffsetCriteria($request));
        $achievements = $this->achievementRepository->all();

        return $this->sendResponse($achievements->toArray(), 'Achievements retrieved successfully');
    }

    /**
     * @param CreateAchievementAPIRequest $request
     * @return Response
     *
     * @SWG\Post(
     *      path="/achievements",
     *      summary="Store a newly created Achievement in storage",
     *      tags={"Achievement"},
     *      description="Store Achievement",
     *      produces={"application/json"},
     *      @SWG\Parameter(
     *          name="body",
     *          in="body",
     *          description="Achievement that should be stored",
     *          required=false,
     *          @SWG\Schema(ref="#/definitions/Achievement")
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
     *                  ref="#/definitions/Achievement"
     *              ),
     *              @SWG\Property(
     *                  property="message",
     *                  type="string"
     *              )
     *          )
     *      )
     * )
     */
    public function store(CreateAchievementAPIRequest $request)
    {
        $input = $request->all();

        $achievements = $this->achievementRepository->create($input);

        return $this->sendResponse($achievements->toArray(), 'Achievement saved successfully');
    }

    /**
     * @param int $id
     * @return Response
     *
     * @SWG\Get(
     *      path="/achievements/{id}",
     *      summary="Display the specified Achievement",
     *      tags={"Achievement"},
     *      description="Get Achievement",
     *      produces={"application/json"},
     *      @SWG\Parameter(
     *          name="id",
     *          description="id of Achievement",
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
     *                  ref="#/definitions/Achievement"
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
        /** @var Achievement $achievement */
        $achievement = $this->achievementRepository->findWithoutFail($id);

        if (empty($achievement)) {
            return $this->sendError('Achievement not found');
        }

        return $this->sendResponse($achievement->toArray(), 'Achievement retrieved successfully');
    }

    /**
     * @param int $id
     * @param UpdateAchievementAPIRequest $request
     * @return Response
     *
     * @SWG\Put(
     *      path="/achievements/{id}",
     *      summary="Update the specified Achievement in storage",
     *      tags={"Achievement"},
     *      description="Update Achievement",
     *      produces={"application/json"},
     *      @SWG\Parameter(
     *          name="id",
     *          description="id of Achievement",
     *          type="integer",
     *          required=true,
     *          in="path"
     *      ),
     *      @SWG\Parameter(
     *          name="body",
     *          in="body",
     *          description="Achievement that should be updated",
     *          required=false,
     *          @SWG\Schema(ref="#/definitions/Achievement")
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
     *                  ref="#/definitions/Achievement"
     *              ),
     *              @SWG\Property(
     *                  property="message",
     *                  type="string"
     *              )
     *          )
     *      )
     * )
     */
    public function update($id, UpdateAchievementAPIRequest $request)
    {
        $input = $request->all();

        /** @var Achievement $achievement */
        $achievement = $this->achievementRepository->findWithoutFail($id);

        if (empty($achievement)) {
            return $this->sendError('Achievement not found');
        }

        $achievement = $this->achievementRepository->update($input, $id);

        return $this->sendResponse($achievement->toArray(), 'Achievement updated successfully');
    }

    /**
     * @param int $id
     * @return Response
     *
     * @SWG\Delete(
     *      path="/achievements/{id}",
     *      summary="Remove the specified Achievement from storage",
     *      tags={"Achievement"},
     *      description="Delete Achievement",
     *      produces={"application/json"},
     *      @SWG\Parameter(
     *          name="id",
     *          description="id of Achievement",
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
        /** @var Achievement $achievement */
        $achievement = $this->achievementRepository->findWithoutFail($id);

        if (empty($achievement)) {
            return $this->sendError('Achievement not found');
        }

        $achievement->delete();

        return $this->sendResponse($id, 'Achievement deleted successfully');
    }
}
