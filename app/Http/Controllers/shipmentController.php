<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class shipmentController extends Controller
{

    /**
     * @OA\Get(
     *     path="/api/get_lunar_shipment_time",
     *     tags={"Shipment API"},
     *     @OA\Parameter(
     *         name="earth_time",
     *         in="query",
     *         description="The earth_time parameter in path",
     *         required=true,
     *         
     *     ),
 *     @OA\Response(
     *         response="200",
     *         description="ok",
     *         content={
     *             @OA\MediaType(
     *                 mediaType="application/json",
     *                 @OA\Schema(
     *                     @OA\Property(
     *                         property="success",
     *                         type="integer",
     *                         description="The response code"
     *                     ),
     *                     @OA\Property(
     *                         property="message",
     *                         type="string",
     *                         description="The response message"
     *                     ),
     *                     @OA\Property(
     *                         property="delivery_time",
     *                         type="string",
     *                         description="The response data",
     *                     ),
     *                     example={
     *                         "success": 1,
     *                         "message": "ok",
     *                         "delivery_time": "54-9-18 ∇  4:6:17"
     *                     }
     *                 )
     *             )
     *         }
     *     ),
  *     @OA\Response(
     *         response="400",
     *         description="Validation Error",
     *         content={
     *             @OA\MediaType(
     *                 mediaType="application/json",
     *                 @OA\Schema(
     *                     @OA\Property(
     *                         property="success",
     *                         type="integer",
     *                         description="The response code"
     *                     ),
     *                     @OA\Property(
     *                         property="message",
     *                         type="string",
     *                         description="The response message"
     *                     ),
     *                     example={
     *                         "success": 0,
     *                         "message": "The earth time field is required."
     *                     }
     *                 )
     *             )
     *         }
     *     ),
     * )
     */

    public function getDeliveryTime(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'earth_time' => 'required'
        ]);

        if ($validator->fails()) {
            return response()->json(['success' => 0, 'message' => $validator->errors()->first()], 400);
        }

        $earthTime = $request->input('earth_time');
        $this->validate($request, [
            'earth_time' => 'required'
        ]);

        $lunarTime = calculateArrivalInUTC($earthTime);
        $time = convertUTCToLST($lunarTime);
        return response()->json(['success' => 1, 'message' => 'Success', 'delivery_time' => $time], 200);
    }
}
