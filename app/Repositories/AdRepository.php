<?php

namespace App\Repositories;
use App\Interfaces\AdRepositoryInterface;
use App\Models\Ad;

class AdRepository implements AdRepositoryInterface
{
    public function getAllAds()
    {
        return Ad::get();
    }

    public function storeAd($attributes)
    {
        $attributes['file'] = $attributes['file']->store('ads_media', 'public');
        $ad = Ad::create($attributes);
        $ad->spaces()->attach($attributes['ad_spaces']);
        return $ad;
    }

    public function searchAd($attributes)
    {
        return Ad::search($attributes);
    }


}

