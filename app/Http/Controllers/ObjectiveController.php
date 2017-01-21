<?php

namespace App\Http\Controllers;

use Laravel\Lumen\Routing\Controller as BaseController;
use Illuminate\Http\Request;
use JWTAuth;

class ObjectiveController extends BaseController
{
    public function getObjectives(Request $request){
        try{
            if (! $user = JWTAuth::parseToken()->authenticate()) {
                $response = response()->json(['user_not_found'], 404);
            } else {
                $response = response()->json(['Hello ' . $user->name], 200);
            }
        } catch (Tymon\JWTAuth\Exceptions\TokenExpiredException $e) {
            $response = response()->json(['token_expired'], $e->getStatusCode());
        } catch (Tymon\JWTAuth\Exceptions\TokenInvalidException $e) {
            $response = response()->json(['token_invalid'], $e->getStatusCode());
        } catch (Tymon\JWTAuth\Exceptions\JWTException $e) {
            $response = response()->json(['token_absent'], $e->getStatusCode());
        }

        return $response;
    }
}
