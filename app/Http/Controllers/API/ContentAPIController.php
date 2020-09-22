<?php

namespace App\Http\Controllers\API;

use App\Http\Requests\API\CreateContentAPIRequest;
use App\Http\Requests\API\UpdateContentAPIRequest;
use App\Models\Content;
use App\Repositories\ContentRepository;
use Illuminate\Http\Request;
use App\Http\Controllers\AppBaseController;
use Webcore\Generator\Criteria\LimitOffsetCriteria;
use Prettus\Repository\Criteria\RequestCriteria;
use Response;

/**
 * Class ContentController
 * @package App\Http\Controllers\API
 */

class ContentAPIController extends AppBaseController
{
    /** @var  ContentRepository */
    private $contentRepository;

    public function __construct(ContentRepository $contentRepo)
    {
        $this->middleware('auth:api');
        $this->contentRepository = $contentRepo;
    }

    /**
     * @param Request $request
     * @return Response
     *
     * @SWG\Get(
     *      path="/contents",
     *      summary="Get a listing of the Contents.",
     *      tags={"Content"},
     *      description="Get all Contents",
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
     *                  @SWG\Items(ref="#/definitions/Content")
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
        $this->contentRepository->pushCriteria(new RequestCriteria($request));
        $this->contentRepository->pushCriteria(new LimitOffsetCriteria($request));
        $contents = $this->contentRepository->all();

        return $this->sendResponse($contents->toArray(), 'Contents retrieved successfully');
    }

    /**
     * @param CreateContentAPIRequest $request
     * @return Response
     *
     * @SWG\Post(
     *      path="/contents",
     *      summary="Store a newly created Content in storage",
     *      tags={"Content"},
     *      description="Store Content",
     *      produces={"application/json"},
     *      @SWG\Parameter(
     *          name="body",
     *          in="body",
     *          description="Content that should be stored",
     *          required=false,
     *          @SWG\Schema(ref="#/definitions/Content")
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
     *                  ref="#/definitions/Content"
     *              ),
     *              @SWG\Property(
     *                  property="message",
     *                  type="string"
     *              )
     *          )
     *      )
     * )
     */
    public function store(CreateContentAPIRequest $request)
    {
        $input = $request->all();

        $contents = $this->contentRepository->create($input);

        return $this->sendResponse($contents->toArray(), 'Content saved successfully');
    }

    /**
     * @param int $id
     * @return Response
     *
     * @SWG\Get(
     *      path="/contents/{id}",
     *      summary="Display the specified Content",
     *      tags={"Content"},
     *      description="Get Content",
     *      produces={"application/json"},
     *      @SWG\Parameter(
     *          name="id",
     *          description="id of Content",
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
     *                  ref="#/definitions/Content"
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
        /** @var Content $content */
        $content = $this->contentRepository->findWithoutFail($id);

        if (empty($content)) {
            return $this->sendError('Content not found');
        }

        return $this->sendResponse($content->toArray(), 'Content retrieved successfully');
    }

    /**
     * @param int $id
     * @param UpdateContentAPIRequest $request
     * @return Response
     *
     * @SWG\Put(
     *      path="/contents/{id}",
     *      summary="Update the specified Content in storage",
     *      tags={"Content"},
     *      description="Update Content",
     *      produces={"application/json"},
     *      @SWG\Parameter(
     *          name="id",
     *          description="id of Content",
     *          type="integer",
     *          required=true,
     *          in="path"
     *      ),
     *      @SWG\Parameter(
     *          name="body",
     *          in="body",
     *          description="Content that should be updated",
     *          required=false,
     *          @SWG\Schema(ref="#/definitions/Content")
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
     *                  ref="#/definitions/Content"
     *              ),
     *              @SWG\Property(
     *                  property="message",
     *                  type="string"
     *              )
     *          )
     *      )
     * )
     */
    public function update($id, UpdateContentAPIRequest $request)
    {
        $input = $request->all();

        /** @var Content $content */
        $content = $this->contentRepository->findWithoutFail($id);

        if (empty($content)) {
            return $this->sendError('Content not found');
        }

        $content = $this->contentRepository->update($input, $id);

        return $this->sendResponse($content->toArray(), 'Content updated successfully');
    }

    /**
     * @param int $id
     * @return Response
     *
     * @SWG\Delete(
     *      path="/contents/{id}",
     *      summary="Remove the specified Content from storage",
     *      tags={"Content"},
     *      description="Delete Content",
     *      produces={"application/json"},
     *      @SWG\Parameter(
     *          name="id",
     *          description="id of Content",
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
        /** @var Content $content */
        $content = $this->contentRepository->findWithoutFail($id);

        if (empty($content)) {
            return $this->sendError('Content not found');
        }

        $content->delete();

        return $this->sendResponse($id, 'Content deleted successfully');
    }
}
