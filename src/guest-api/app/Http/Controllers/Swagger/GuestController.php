<?php

namespace App\Http\Controllers\Swagger;

use App\Http\Controllers\Controller;
use App\Http\Requests\Guest\StoreRequest;
use App\Http\Requests\Guest\UpdateRequest;
use App\Http\Resources\Guest\GuestResource;
use App\Models\Guest;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

/**
 * @OA\Post(
 *     path="/api/guests",
 *     summary="Создание гостя",
 *     tags={"Guest"},
 *
 *     @OA\RequestBody(
 *         @OA\JsonContent(
 *             allOf={
 *                 @OA\Schema(
 *                     @OA\Property(property="name", type="string", example="John"),
 *                     @OA\Property(property="surname", type="string", example="Smith"),
 *                     @OA\Property(property="phone", type="string", example="7 9999999999", description="Номер телефона в формате <Код_страны> . <Пробел> . <Номер телефона>"),
 *                     @OA\Property(property="email", type="string", example="JohnSmith@gmail.com"),
 *                     @OA\Property(property="country_id", type="integer", example=1),
 *                 )
 *             }
 *         )
 *     ),
 *
 *     @OA\Response(
 *         response=200,
 *         description="ok",
 *         @OA\JsonContent(
 *            @OA\Property(property="id", type="integer", example="1"),
 *            @OA\Property(property="name", type="string", example="John"),
 *            @OA\Property(property="surname", type="string", example="Smith"),
 *            @OA\Property(property="phone", type="string", example="7 9999999999"),
 *            @OA\Property(property="email", type="string", example="JohnSmith@gmail.com"),
 *            @OA\Property(property="country_id", type="integer", example=1),
 *            @OA\Property(property="created_at", type="date-time", example="2024-09-15 13:17:35"),
 *            @OA\Property(property="updated_at", type="date-time", example="2024-09-15 13:17:35"),
 *         ),
 *     ),
 *
 * ),
 *
 * @OA\Get(
 *      path="/api/guests",
 *      summary="Получение списка гостей",
 *      tags={"Guest"},
 *
 *      @OA\Response(
 *          response=200,
 *          description="ok",
 *          @OA\JsonContent(
 *             @OA\Property(property="id", type="integer", example="1"),
 *             @OA\Property(property="name", type="string", example="John"),
 *             @OA\Property(property="surname", type="string", example="Smith"),
 *             @OA\Property(property="phone", type="string", example="7 9999999999"),
 *             @OA\Property(property="email", type="string", example="JohnSmith@gmail.com"),
 *             @OA\Property(property="country_id", type="integer", example=1),
 *             @OA\Property(property="created_at", type="date-time", example="2024-09-15 13:17:35"),
 *             @OA\Property(property="updated_at", type="date-time", example="2024-09-15 13:17:35"),
 *          ),
 *      ),
 *  ),
 *
 * @OA\Get(
 *       path="/api/guests/{guest}",
 *       summary="Получение гостя",
 *       tags={"Guest"},
 *
 *       @OA\Parameter(
 *           description="Id гостя",
 *           in="path",
 *           name="guest",
 *           required=true,
 *           example=1
 *       ),
 *
 *       @OA\Response(
 *           response=200,
 *           description="ok",
 *           @OA\JsonContent(
 *              @OA\Property(property="id", type="integer", example="1"),
 *              @OA\Property(property="name", type="string", example="John"),
 *              @OA\Property(property="surname", type="string", example="Smith"),
 *              @OA\Property(property="phone", type="string", example="7 9999999999"),
 *              @OA\Property(property="email", type="string", example="JohnSmith@gmail.com"),
 *              @OA\Property(property="country_id", type="integer", example=1),
 *              @OA\Property(property="created_at", type="date-time", example="2024-09-15 13:17:35"),
 *              @OA\Property(property="updated_at", type="date-time", example="2024-09-15 13:17:35"),
 *           ),
 *       ),
 *   ),
 *
 * @OA\Patch(
 *        path="/api/guests/{guest}",
 *        summary="Измение данных гостя",
 *        tags={"Guest"},
 *
 *        @OA\Parameter(
 *            description="Id гостя",
 *            in="path",
 *            name="guest",
 *            required=true,
 *            example=1
 *        ),
 *
 *        @OA\RequestBody(
 *            @OA\JsonContent(
 *                allOf={
 *                    @OA\Schema(
 *                        @OA\Property(property="name", type="string", example="John"),
 *                        @OA\Property(property="surname", type="string", example="Smith"),
 *                        @OA\Property(property="phone", type="string", example="7 9999999999", description="Номер телефона в формате <Код_страны> . <Пробел> . <Номер телефона>"),
 *                        @OA\Property(property="email", type="string", example="JohnSmith@gmail.com"),
 *                        @OA\Property(property="country_id", type="integer", example=1),
 *                    )
 *              }
 *         ),
 *     ),
 *
 *
 *
 *        @OA\Response(
 *            response=200,
 *            description="ok",
 *            @OA\JsonContent(
 *               @OA\Property(property="id", type="integer", example="1"),
 *               @OA\Property(property="name", type="string", example="John"),
 *               @OA\Property(property="surname", type="string", example="Smith"),
 *               @OA\Property(property="phone", type="string", example="7 9999999999"),
 *               @OA\Property(property="email", type="string", example="JohnSmith@gmail.com"),
 *               @OA\Property(property="country_id", type="integer", example=1),
 *               @OA\Property(property="created_at", type="integer", example="2024-09-15 13:17:35"),
 *               @OA\Property(property="updated_at", type="integer", example="2024-09-15 13:17:35"),
 *            ),
 *        ),
 *    ),
 *
 * @OA\Delete(
 *        path="/api/guests/{guest}",
 *        summary="Удаление гостя",
 *        tags={"Guest"},
 *
 *        @OA\Parameter(
 *            description="Id гостя",
 *            in="path",
 *            name="guest",
 *            required=true,
 *            example=1
 *        ),
 *
 *        @OA\Response(
 *            response=200,
 *            description="Successfully deleted",
 *            @OA\JsonContent(
 *               @OA\Property(property="message", type="string", example="Successfully deleted"),
 *            ),
 *        ),
 *    ),
 *
 *
 */
class GuestController extends Controller
{

}
