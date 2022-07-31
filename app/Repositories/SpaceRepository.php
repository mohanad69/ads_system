<?php

namespace App\Repositories;
use App\Interfaces\SpaceRepositoryInterface;
use App\Models\Space;

class SpaceRepository implements SpaceRepositoryInterface
{
    public function getAllSpaces()
    {
        return Space::get();
    }


}
