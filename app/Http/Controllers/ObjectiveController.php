<?php

namespace App\Http\Controllers;

use Laravel\Lumen\Routing\Controller as BaseController;
use Illuminate\Http\Request;
use App\Http\Helpers\JsonHelper;
use App\Http\Helpers\AuthHelper;

class ObjectiveController extends BaseController
{
    /**
    * Retuns all objectives
    **/
    public function getObjectives(Request $request) {
        $response = AuthHelper::checkAuth();
        if ($response['code'] == 200) {
            $objectives = \App\Objective::all();
            $json = JsonHelper::collectionToArray($objectives);
            $response['message'] = response()->json($json, 200);
        } 

        return $response['message'];
    }

    /**
    * Retuns objective with specified id
    **/
    public function getObjectiveById(Request $request, $id) {
       $response = AuthHelper::checkAuth();
        if ($response['code'] == 200) {
            $objective = \App\Objective::find($id);
            $json = JsonHelper::objectToArray($objective);
            $response['message'] = response()->json($json, 200);
        } 

        return $response['message'];
    }

    /**
    * Create objective with POST data
    **/
    public function addObjective(Request $request) {
        $response = AuthHelper::checkAuth();
        if ($response['code'] == 200) {
            $requestData = $request->all();
            if (isset($requestData['data'])) {
                $data = json_decode($requestData['data'], true);

                $objective = new \App\Objective();
                $objective->label = $data['label'];
                $objective->goal = $data['goal'];
                $objective->deadline = $data['deadline'];
                $objective->parent_objective_id = $data['parent_objective_id'];
                $objective->save();

                $json = JsonHelper::objectToArray($objective);
                $response['message'] = response()->json([$json, 200]);
            } else {
                $response['message'] = response()->json(['No data', 200]);
            }
        } 

        return $response['message'];
    }

    /**
    * Delete objective with specified id
    **/
    public function deleteObjective(Request $request, $id) {
        $response = AuthHelper::checkAuth();
        if ($response['code'] == 200) {
            $result = \App\Objective::destroy($id);
            
            $response['message'] = response()->json($result, 200);
        } 

        return $response['message'];
    }

    /**
    * Update objective with POST data
    **/
    public function updateObjective(Request $request) {
        $response = AuthHelper::checkAuth();
        if ($response['code'] == 200) {
            $requestData = $request->all();
            if (isset($requestData['data'])) {
                $data = json_decode($requestData['data'], true);

                $objective = \App\Objective::find($data['id']);
                $objective->label = $data['label'];
                $objective->goal = $data['goal'];
                $objective->deadline = $data['deadline'];
                $objective->parent_objective_id = $data['parent_objective_id'];
                $objective->save();

                $json = JsonHelper::objectToArray($objective);
                $response['message'] = response()->json([$json, 200]);
            } else {
                $response['message'] = response()->json(['No data', 200]);
            }
        } 

        return $response['message'];
    }
}
