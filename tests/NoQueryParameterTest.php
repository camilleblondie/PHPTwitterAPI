<?php
/**
 * Created by PhpStorm.
 * User: jeanreptile
 * Date: 6/12/15
 * Time: 11:29 PM
 */

class NoQueryParameterTest extends TestCase
{

    public function testNoQueryParameter()
    {
        $response = $this->call('GET', '/api/search?api_key=557aef0ca09a4');
        $respJson = json_decode($response->getContent());
        $dataTest = array(
                "error" => "Please specify a \"query\" parameter"
        );

        $respTest = json_decode(json_encode($dataTest));

        $this->assertResponseStatus(200);
        $this->assertEquals($respJson, $respTest);
    }
}

?>T