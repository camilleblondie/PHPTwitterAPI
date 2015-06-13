<?php

class FollowingsTest extends TestCase {

    /**
     * A basic test example.
     *
     * @return void
     */

    var $api_key = '557aef0ca09a4';


    public function testGetFollowings()
    {
        $response = $this->call('GET', '/api/followings?api_key='.$this->api_key.'&screen_name=eric_reptile');
        $respJson = json_decode($response->getContent());
        $dataTest = array(
            array(
                "screen_name" => "michel_denisot"),
            array(
                "screen_name" => "CartmanOfficiel"),
            array(
                "screen_name" => "Monsieur_Poulpe"),
            array(
                "screen_name" => "kyank")
        );
        $respTest = json_decode(json_encode($dataTest));

        $this->assertEquals($respJson, $respTest);
    }

}
