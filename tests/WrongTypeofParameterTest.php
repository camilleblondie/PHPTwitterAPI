<?php
/**
 * Created by PhpStorm.
 * User: jeanreptile
 * Date: 6/14/15
 * Time: 8:00 PM
 */

class WrongTypeofParameterTest extends TestCase
{

    public function testWrongTypeofParameter()
    {
        $response = $this->call('GET', '/api/tweet/poney?api_key=557aef0ca09a4');
        $respJson = json_decode($response->getContent());
        $dataTest = array(
            "error" => "The id must be a number"
        );

        $respTest = json_decode(json_encode($dataTest));

        $this->assertResponseStatus(200);
        $this->assertEquals($respJson, $respTest);
    }
}