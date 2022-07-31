<?php

namespace App\Interfaces;

interface AdRepositoryInterface
{
    public function getAllAds();
    public function storeAd($attributes);
    public function searchAd($attributes);
}

