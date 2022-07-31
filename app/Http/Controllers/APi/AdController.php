<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\API\BaseController as BaseController;
use App\Http\Requests\Api\Ads\SearchAdRequest;
use App\Http\Requests\Api\Ads\StoreAdRequest;
use App\Http\Resources\Api\Ads\AdsResource;
use App\Models\Ad;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redis;
use App\Interfaces\AdRepositoryInterface;

class AdController extends BaseController
{
    private AdRepositoryInterface $adRepository;

    public function __construct(AdRepositoryInterface $adRepository)
    {
        $this->adRepository = $adRepository;

        $this->middleware(['permission:get_ads'])->only('index');
        $this->middleware(['permission:add_ads'])->only('store');
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return AdsResource::collection(cache('ads', function () {
            return $this->adRepository->getAllAds();
        }));

    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreAdRequest $request)
    {
        // $attributes = $request->except('file', 'ad_spaces');
        // $attributes['file'] = $request->file('file')->store('ads_media', 'public');
        // $ad = Ad::create($attributes);
        // $ad->spaces()->attach($request->ad_spaces);
        $ad = $this->adRepository->storeAd($request->all());
        return AdsResource::make($ad);
    }

    public function searchAds(SearchAdRequest $request)
    {

        // $ad = Ad::search($request);
        // return AdsResource::make($ad);
        return AdsResource::make($this->adRepository->searchAd($request));
    }
}
