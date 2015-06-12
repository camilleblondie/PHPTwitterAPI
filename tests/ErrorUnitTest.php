<?php
/**
 * Created by PhpStorm.
 * User: jeanreptile
 * Date: 6/12/15
 * Time: 5:17 PM
 */

class ErrorUnitTest extends TestCase
{
    var $api_key = '557aef0ca09a4';

    public function testNotExistingUser()
    {
        $response = $this->call('GET', '/api/followers?api_key='.$this->api_key.'&screen_name=eradsic_reptsadsadile');
        $respJson = json_decode($response->getContent());

        $dataTest = array(
                "error" => "This user does not exist"
        );

        $respTest = json_decode(json_encode($dataTest));

        $this->assertResponseStatus(200);
        $this->assertEquals($respJson, $respTest);
    }
}