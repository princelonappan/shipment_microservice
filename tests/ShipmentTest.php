<?php

use Laravel\Lumen\Testing\DatabaseMigrations;
use Laravel\Lumen\Testing\DatabaseTransactions;


class ShipmentTest extends TestCase
{

    public function testAPIResponseWithEmptyPayload()
    {
        $response = $this->call('GET', 'api/get_lunar_shipment_time');
        $validationResponse = array('success' => 0, 'message' => 'The earth time field is required.');
        $this->assertEquals(400, $response->status());
        $this->assertEquals(json_encode($validationResponse), $response->getContent());
    }

    public function testAPIWithInvalidPayload()
    {
        $parameter = ['earth_time' => 'test'];
        $response = $this->call('GET', 'api/get_lunar_shipment_time', $parameter);
        $validationResponse = array('success' => 0,
            'message' => 'Please provide the date in the following format. Y-m-d H:i:s');
        $this->assertEquals(400, $response->status());
        $this->assertEquals($validationResponse, json_decode($response->getContent(), true));
    }

    public function testAPIwithValidPayload()
    {
        $parameter = ['earth_time' => '2021-08-27 17:22:40'];
        $response = $this->call('GET', 'api/get_lunar_shipment_time', $parameter);
        $validationResponse = array('success' => 1,
            'message' => 'Success', 'delivery_time' => '54-9-18 ∇  4:6:17');
        $this->assertEquals(200, $response->status());
        $this->assertEquals($validationResponse, json_decode($response->getContent(), true));

    }
}
