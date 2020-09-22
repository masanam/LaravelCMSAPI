<?php

namespace App\Http\Controllers;

use Webcore\Generator\Utils\ResponseUtil;
use Response;

/**
 * @SWG\Swagger(
 *   basePath="/api",
 *   @SWG\Info(
 *     title="Kino.co.id API Documentation",
 *     version="1.0.0",
 *         description="Integrate Swagger in Laravel application",
 *         termsOfService="",
 *         @SWG\Contact(
 *             email="info@redtech.com"
 *         ),
 *     ),
 * )
* This class should be parent class for other API controllers
 * Class AppBaseController
 */

class AppBaseController extends Controller
{
    public function sendResponse($result, $message)
    {
        return Response::json(ResponseUtil::makeResponse($message, $result));
    }

    public function sendError($error, $message, $code = 404)
    {
        return Response::json(ResponseUtil::makeError($message, $error), $code);
    }
}
