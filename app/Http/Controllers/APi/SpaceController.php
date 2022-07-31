<?php

namespace App\Http\Controllers\Api;
use App\Http\Controllers\Controller;
use App\Http\Resources\Api\Spaces\SpacesResource;
use App\Models\Space;
use App\Interfaces\SpaceRepositoryInterface;

class SpaceController extends Controller
{
    private SpaceRepositoryInterface $spaceRepository;

    public function __construct(SpaceRepositoryInterface $spaceRepository)
    {
        $this->spaceRepository = $spaceRepository;
    }

    public function index(){
        return SpacesResource::collection($this->spaceRepository->getAllSpaces());
    }
}
