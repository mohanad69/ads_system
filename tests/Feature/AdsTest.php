<?php

namespace Tests\Feature;

use App\Models\Ad;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class AdsTest extends TestCase
{
    /**
     * A basic feature test example.
     *
     * @return void
     */
    public function test_example()
    {
        $response = $this->get('/');

        $response->assertStatus(200);
    }

    public function test_get_all_example()
    {

        $user = User::first();
        $this->actingAs($user);
        $response = $this->get('/api/ads');

        $response->assertStatus(200);
    }

    public function test_store_example()
    {

        $user = User::first();
        # authenticate user
        $this->actingAs($user);

        $response = $this->post('/api/ads',[
            'agent' => 'mobile',
            'mobile_content' => 'mobile_content',
            'file' => new \Illuminate\Http\UploadedFile(public_path('/dragon.png'), 'dragon.png', null, null, true, true),
            'start_date' => '2022-09-30',
            'end_date' => '2022-10-30',
            'url' => 'https://facebook.com',
            'ad_spaces' => ['space_id' => 1],
        ]);

        $response->assertStatus(201);
    }

    public function test_update_example()
    {

        $user = User::first();
        $this->actingAs($user);

        $ad = Ad::firstOrFail();

        $response = $this->put('/api/ads/'.$ad->id,[
            // 'agent' => 'mobile',
            // 'mobile_content' => 'mobile_content',
            'file' => new \Illuminate\Http\UploadedFile(public_path('/chicken.png'), 'chicken.png', null, null, true, true),
            // 'start_date' => '2022-09-30',
            // 'end_date' => '2022-10-30',
            'url' => 'https://google.com',
            'ad_spaces' => ['space_id' => 2],
        ]);

        $response->assertStatus(200);
    }

    public function test_destroy_example()
    {

        $user = User::first();
        $this->actingAs($user);

        $ad = Ad::firstOrFail();

        $response = $this->delete('/api/ads/'.$ad->id);

        $response->assertStatus(200);
    }

}
