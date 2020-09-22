<?php

namespace App\Http\Controllers\API;

use App\Http\Requests\API\CreateAnnouncementAPIRequest;
use App\Http\Requests\API\UpdateAnnouncementAPIRequest;
use App\Models\Announcement;
use App\Repositories\AnnouncementRepository;
use Illuminate\Http\Request;
use App\Http\Controllers\AppBaseController;
use Webcore\Generator\Criteria\LimitOffsetCriteria;
use Prettus\Repository\Criteria\RequestCriteria;
use Response;

/**
 * Class AnnouncementController
 * @package App\Http\Controllers\API
 */

class AnnouncementAPIController extends AppBaseController
{
    /** @var  AnnouncementRepository */
    private $announcementRepository;

    public function __construct(AnnouncementRepository $announcementRepo)
    {
        $this->middleware('auth:api');
        $this->announcementRepository = $announcementRepo;
    }

    /**
     * @param Request $request
     * @return Response
     *
     * @SWG\Get(
     *      path="/announcements",
     *      summary="Get a listing of the Announcements.",
     *      tags={"Announcement"},
     *      description="Get all Announcements",
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
     *                  @SWG\Items(ref="#/definitions/Announcement")
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
        $this->announcementRepository->pushCriteria(new RequestCriteria($request));
        $this->announcementRepository->pushCriteria(new LimitOffsetCriteria($request));
        $announcements = $this->announcementRepository->all();

        return $this->sendResponse($announcements->toArray(), 'Announcements retrieved successfully');
    }

    /**
     * @param CreateAnnouncementAPIRequest $request
     * @return Response
     *
     * @SWG\Post(
     *      path="/announcements",
     *      summary="Store a newly created Announcement in storage",
     *      tags={"Announcement"},
     *      description="Store Announcement",
     *      produces={"application/json"},
     *      @SWG\Parameter(
     *          name="body",
     *          in="body",
     *          description="Announcement that should be stored",
     *          required=false,
     *          @SWG\Schema(ref="#/definitions/Announcement")
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
     *                  ref="#/definitions/Announcement"
     *              ),
     *              @SWG\Property(
     *                  property="message",
     *                  type="string"
     *              )
     *          )
     *      )
     * )
     */
    public function store(CreateAnnouncementAPIRequest $request)
    {
        $input = $request->all();

        $announcements = $this->announcementRepository->create($input);

        return $this->sendResponse($announcements->toArray(), 'Announcement saved successfully');
    }

    /**
     * @param int $id
     * @return Response
     *
     * @SWG\Get(
     *      path="/announcements/{id}",
     *      summary="Display the specified Announcement",
     *      tags={"Announcement"},
     *      description="Get Announcement",
     *      produces={"application/json"},
     *      @SWG\Parameter(
     *          name="id",
     *          description="id of Announcement",
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
     *                  ref="#/definitions/Announcement"
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
        /** @var Announcement $announcement */
        $announcement = $this->announcementRepository->findWithoutFail($id);

        if (empty($announcement)) {
            return $this->sendError('Announcement not found');
        }

        return $this->sendResponse($announcement->toArray(), 'Announcement retrieved successfully');
    }

    /**
     * @param int $id
     * @param UpdateAnnouncementAPIRequest $request
     * @return Response
     *
     * @SWG\Put(
     *      path="/announcements/{id}",
     *      summary="Update the specified Announcement in storage",
     *      tags={"Announcement"},
     *      description="Update Announcement",
     *      produces={"application/json"},
     *      @SWG\Parameter(
     *          name="id",
     *          description="id of Announcement",
     *          type="integer",
     *          required=true,
     *          in="path"
     *      ),
     *      @SWG\Parameter(
     *          name="body",
     *          in="body",
     *          description="Announcement that should be updated",
     *          required=false,
     *          @SWG\Schema(ref="#/definitions/Announcement")
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
     *                  ref="#/definitions/Announcement"
     *              ),
     *              @SWG\Property(
     *                  property="message",
     *                  type="string"
     *              )
     *          )
     *      )
     * )
     */
    public function update($id, UpdateAnnouncementAPIRequest $request)
    {
        $input = $request->all();

        /** @var Announcement $announcement */
        $announcement = $this->announcementRepository->findWithoutFail($id);

        if (empty($announcement)) {
            return $this->sendError('Announcement not found');
        }

        $announcement = $this->announcementRepository->update($input, $id);

        return $this->sendResponse($announcement->toArray(), 'Announcement updated successfully');
    }

    /**
     * @param int $id
     * @return Response
     *
     * @SWG\Delete(
     *      path="/announcements/{id}",
     *      summary="Remove the specified Announcement from storage",
     *      tags={"Announcement"},
     *      description="Delete Announcement",
     *      produces={"application/json"},
     *      @SWG\Parameter(
     *          name="id",
     *          description="id of Announcement",
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
        /** @var Announcement $announcement */
        $announcement = $this->announcementRepository->findWithoutFail($id);

        if (empty($announcement)) {
            return $this->sendError('Announcement not found');
        }

        $announcement->delete();

        return $this->sendResponse($id, 'Announcement deleted successfully');
    }
}
