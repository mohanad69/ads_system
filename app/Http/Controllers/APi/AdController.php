<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\Api\Ads\SearchAdRequest;
use App\Http\Requests\Api\Ads\StoreAdRequest;
use App\Http\Requests\Api\Ads\UpdateAdRequest;
use App\Http\Resources\Api\Ads\AdsResource;
use App\Interfaces\AdRepositoryInterface;
use App\Models\Ad;

class AdController extends Controller
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
        $ad = $this->adRepository->storeAd($request->all());
        return AdsResource::make($ad);
    }
    public function update(UpdateAdRequest $request, Ad $ad)
    {
        $ad = $this->adRepository->updateAd($request->all(), $ad);
        return AdsResource::make($ad);
    }

    public function destroy(Ad $ad)
    {
        $ad = $this->adRepository->destroyAd($ad);
        return response(['message' => 'ad is deleted successfully']);
    }

    public function searchAds(SearchAdRequest $request)
    {
        return AdsResource::make($this->adRepository->searchAd($request));
    }
}
