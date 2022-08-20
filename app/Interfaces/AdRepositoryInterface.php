<?php

namespace App\Interfaces;

interface AdRepositoryInterface
{
    public function getAllAds();
    public function storeAd($attributes);
    public function updateAd($attributes, $ad);
    public function destroyAd($ad);
    public function searchAd($attributes);
}

