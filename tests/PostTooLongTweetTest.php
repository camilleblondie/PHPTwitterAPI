<?php
/**
 * Created by PhpStorm.
 * User: jeanreptile
 * Date: 6/12/15
 * Time: 10:57 PM
 */

class PostTooLongTweetTest extends TestCase
{

    var $api_key = '557aef0ca09a4';

    public function testPostTooLongTweet()
    {
        $tweetToTest = 'And I will strike down upon thee with great vengeance and furious anger those who attempt to poison and destroy my brothers. And you will know my name is The Lord when I lay my vengeance upon thee.';
        $credentials = array(
            'status' => $tweetToTest
        );
        $response = $this->call('POST', '/api/tweet?api_key=' . $this->api_key, $credentials);
        $respJson = json_decode($response->getContent());

        $dataTest = array(
            "error" => "Tweet is exceeding 140 characters"
        );

        $respTest = json_decode(json_encode($dataTest));

        $this->assertResponseStatus(200);
        $this->assertEquals($respJson, $respTest);
    }
}