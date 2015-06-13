<?php
/**
 * Created by PhpStorm.
 * User: jeanreptile
 * Date: 6/12/15
 * Time: 11:26 PM
 */

class NotValidAPIKeyTest extends TestCase
{
    public function testNotValidAPIKey()
    {
        $response = $this->call('GET', '/api/favorites?api_key=wrongasdasdasdpikey&screen_name=eric_reptile');
        $respJson = json_decode($response->getContent());

        $dataTest = array(
            "error" => "API Key is invalid"
        );

        $respTest = json_decode(json_encode($dataTest));

        $this->assertResponseStatus(200);
        $this->assertEquals($respJson, $respTest);
    }
}