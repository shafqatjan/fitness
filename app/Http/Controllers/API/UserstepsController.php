<?php

namespace App\Http\Controllers\API;

use Illuminate\Http\Request;
use App\Http\Controllers\API\BaseController as BaseController;
use App\Models\Usersteps;
use Validator;
use App\Http\Resources\UserstepsResource;

class UserstepsController extends BaseController
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $loggedInUser = $request->user();
        $usersteps = Usersteps::where('user_id', $loggedInUser->id)->get();
        return $this->sendResponse(UserstepsResource::collection($usersteps), 'Usersteps retrieved successfully.');
    }
    /**
     * Display a leaderboard of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function leaderboard(Request $request)
    {
        $usersteps = Usersteps::all();
        return $this->sendResponse(UserstepsResource::collection($usersteps), 'Usersteps retrieved successfully.');
    }
    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $input = $request->all();
        $validator = Validator::make($input, [
            'steps' => 'required',
            'start_date' => 'required',
            'end_date' => 'required'
        ]);

        if ($validator->fails()) {
            return $this->sendError('Validation Error.', $validator->errors());
        }
        $loggedInUser = $request->user();
        $input['user_id'] = $loggedInUser->id;
        $userstep = Usersteps::create($input);

        return $this->sendResponse(new UserstepsResource($userstep), 'User step created successfully.');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $userstep = Usersteps::find($id);

        if (is_null($userstep)) {
            return $this->sendError('Userstep not found.');
        }

        return $this->sendResponse(new UserstepsResource($userstep), 'Userstep retrieved successfully.');
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Usersteps $userstep)
    {
        $input = $request->all();

        $validator = Validator::make($input, [
            'name' => 'required',
            'detail' => 'required'
        ]);

        if ($validator->fails()) {
            return $this->sendError('Validation Error.', $validator->errors());
        }

        $userstep->name = $input['name'];
        $userstep->detail = $input['detail'];
        $userstep->save();

        return $this->sendResponse(new UserstepsResource($userstep), 'Userstep updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Usersteps $userstep)
    {
        $userstep->delete();

        return $this->sendResponse([], 'Userstep deleted successfully.');
    }
}
