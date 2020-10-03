<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class APITest extends TestCase
{
    /**
     * A basic feature test example.
     *
     * @return void
     */
    public function testReports()
    {
        $responseSurvivors = $this->get('/api/v1/reports/survivors');
        $responseAgregate = $this->get('/api/v1/reports/resources?agregate=avg');
        $responsePointsLost = $this->get('/api/v1/reports/points/pointsLost');
        $responseInfected = $this->get('/api/v1/reports/survivors?infected=1');
        
        $responseSurvivors->assertStatus(200);
        $responseAgregate->assertStatus(200);
        $responsePointsLost->assertStatus(200);
        $responseInfected->assertStatus(200);

    }

    public function testCreateSurvivor()
    {
        $userData = [
             "name" => "Otavio Costa Lima"
            , "age" => 23
            , "gender"=> "M"
            , "latitude"=> "222222-222222"
            , "longitude"=> "343434343"
            , "contaminated_count"=> 0
           , "items"=>   [   
                ["item_id"=> 1, "quantity"=> 3] 
               ,[ "item_id"=> 3, "quantity"=> 1]                        
        ]
        ];

        $this->json('POST', '/api/v1/survivors', $userData, ['Accept' => 'application/json'])
            ->assertStatus(200);
    }


    public function testUpdateLocation()
    {
        $userData = ["latitude" => "1", "longitude" => "1"];

        $this->json('PUT', '/api/v1/survivors/1', $userData, ['Accept' => 'application/json'])
            ->assertStatus(200);
    }

    public function testNotifyInfected()
    {
        $userData = ["notifier_id" => 3];

        $this->json('POST', '/api/v1/survivors/1/infected', $userData, ['Accept' => 'application/json'])
            ->assertStatus(200);
    }

}
