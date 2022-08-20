<?php

namespace App\Repositories;
use App\Interfaces\AdRepositoryInterface;
use App\Models\Ad;
use File;

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

    public function updateAd($attributes, $ad)
    {
        if(isset($attributes['file'])){
            if (File::exists(storage_path('app/public/' . $ad->file)))
                File::delete(storage_path('app/public/' . $ad->file));
            $attributes['file'] = $attributes['file']->store('ads_media', 'public');
        }
        $ad->update($attributes);
        if(isset($attributes['ad_spaces']))
            $ad->spaces()->sync($attributes['ad_spaces']);
        return $ad;
    }

    public function destroyAd($ad)
    {
        if (File::exists(storage_path('app/public/' . $ad->file)))
            File::delete(storage_path('app/public/' . $ad->file));
        $ad->delete();
    }

    public function searchAd($attributes)
    {
        return Ad::search($attributes);
    }


}

