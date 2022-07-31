<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Redis;
use Cache;

class Ad extends Model
{
    use HasFactory;

    protected $fillable = [
        'agent',
        'mobile_content',
        'desktop_content',
        'file',
        'start_date',
        'end_date',
        'url',
        'views',
    ];
    protected $appends = ['filePath'];
    protected $hidden = ['file'];

    public function getFilePathAttribute()
    {
        return  asset('storage/' . $this->attributes['file']);
    }

    public function spaces()
    {
        return $this->belongsToMany(Space::class, 'ads_spaces', 'ad_id', 'space_id');
    }

    /**
     * The "booted" method of the model.
     *
     * @return void
     */
    protected static function booted()
    {
        static::created(function ($ad) {
            Cache::forget('ads'); //forget all the Cache data initially
            $ads = self::all(); //fetch all data
            Cache::forever('posts', $ads);
        });
    }

    public static function search($request)
    {
        return self::where('agent', detectDevice())
                ->where('start_date', '>=', $request->start_date)
                ->where('end_date', '<=', $request->end_date)
                ->whereHas('spaces', function ($q) use ($request) {
                    $q->where('space_id', $request->space_id);
                })->firstOrFail();
    }
}
