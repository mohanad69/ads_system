<?php

namespace App\Http\Controllers\Api;
use App\Http\Controllers\Controller;
use App\Http\Resources\Api\Spaces\SpacesResource;
use App\Models\Space;
use Illuminate\Support\Facades\Redis;

class SpaceController extends Controller
{
    public function index(){
        $spaces = Space::get();
        return SpacesResource::collection($spaces);
    }
}
