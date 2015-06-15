<?php
/**
 * Created by PhpStorm.
 * User: jeanreptile
 * Date: 6/14/15
 * Time: 7:58 PM
 */

class NotExistingTweet extends TestCase
{

    public function testNotExistingTweet()
    {
        $response = $this->call('GET', '/api/tweet/1?api_key=557aef0ca09a4');
        $respJson = json_decode($response->getContent());
        $dataTest = array(
            "error" => "This tweet does not exist."
        );

        $respTest = json_decode(json_encode($dataTest));

        $this->assertResponseStatus(200);
        $this->assertEquals($respJson, $respTest);
    }
}