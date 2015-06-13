<?php
/**
 * Created by PhpStorm.
 * User: jeanreptile
 * Date: 6/12/15
 * Time: 7:52 PM
 */

class SearchTest extends TestCase
{

    public function testPostGetAndDeleteTweet()
    {
        $response = $this->call('GET', '/api/search?api_key=557aef0ca09a4&query=mtiphp2015twitter');
        $respJson = json_decode($response->getContent());
        $dataTest = array(
            array(
            "text" => "mtiphp2015twitter",
                "id" => "609470005969817600"
            )
        );

        $respTest = json_decode(json_encode($dataTest));

        $this->assertResponseStatus(200);
        $this->assertEquals($respJson, $respTest);
    }
}

?>