<?php
/**
 * Created by PhpStorm.
 * User: jeanreptile
 * Date: 6/12/15
 * Time: 5:45 PM
 */

class FollowersTest extends TestCase
{
    var $api_key = '557aef0ca09a4';
    public function testGetFollowers()
    {
        $response = $this->call('GET', '/api/followers?api_key='.$this->api_key.'&screen_name=eric_reptile');
        $respJson = json_decode($response->getContent());
        $dataTest = array(
            array(
                "screen_name" => "Sherryzzo"
            ),
            array(
                "screen_name" => "VraiHoroscope"),
            array(
                "screen_name" => "oceaneetsarah")
        );
        $respTest = json_decode(json_encode($dataTest));
        $this->assertEquals($respJson, $respTest);
    }


}