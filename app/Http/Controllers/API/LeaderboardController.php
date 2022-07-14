<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\API\BaseController as BaseController;
use App\Models\Usersteps;

use App\Http\Resources\UserstepsResource;
use Carbon\Carbon;

class LeaderboardController extends BaseController
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function show($date = '')
    {
        if (empty($date))    $date = Carbon::now()->format('Y-m-d');
        $usersteps = Usersteps::whereRaw("DATE(created_at) = " . $date)->get();
        return $this->sendResponse(UserstepsResource::collection($usersteps), 'Usersteps retrieved successfully.');
    }
}
