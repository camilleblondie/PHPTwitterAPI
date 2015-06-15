<?php
/**
 * Created by PhpStorm.
 * User: jeanreptile
 * Date: 6/14/15
 * Time: 8:06 PM
 */

class WrongTypeofParameterCountTest extends TestCase
{

    public function testWrongTypeofParameterCount()
    {
        $response = $this->call('GET', '/api/favorites?api_key=557aef0ca09a4&screen_name=eric_reptile&count=poney');
        $respJson = json_decode($response->getContent());
        $dataTest = array(
            "error" => "The parameter count must be a number"
        );

        $respTest = json_decode(json_encode($dataTest));

        $this->assertResponseStatus(200);
        $this->assertEquals($respJson, $respTest);
    }
}