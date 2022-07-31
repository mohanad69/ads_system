<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\API\BaseController as BaseController;
use App\Http\Requests\Api\Ads\SearchAdRequest;
use App\Http\Requests\Api\Ads\StoreAdRequest;
use App\Http\Resources\Api\Ads\AdsResource;
use App\Models\Ad;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redis;

class AdController extends BaseController
{
    public function __construct()
    {
        // $this->middleware(['permission:get_ads'])->only('index');
        // $this->middleware(['permission:add_ads'])->only('store');
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return AdsResource::collection(cache('ads', function () {
            return Ad::with('spaces')->get();
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
        # take all inputs except file and ad_spaces
        $attributes = $request->except('file', 'ad_spaces');

        # store file in storage and add it to attributes array
        $attributes['file'] = $request->file('file')->store('ads_media', 'public');
        #insert data into ads table in db
        $ad = Ad::create($attributes);
        # link ad with spaces through relation
        $ad->spaces()->attach($request->ad_spaces);
        # retrieve insered ad
        return AdsResource::make($ad);
    }

    public function searchAds(SearchAdRequest $request)
    {

        $ad = Ad::search($request);
        return AdsResource::make($ad);
    }
}
