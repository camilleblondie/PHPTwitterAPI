<?php
/**
 * Created by PhpStorm.
 * User: jeanreptile
 * Date: 6/13/15
 * Time: 5:40 PM
 */


class GetTweetTest extends TestCase {

    /**
     * A basic test example.
     *
     * @return void
     */

    var $api_key = '557aef0ca09a4';


    public function testGetTweet()
    {
        $response = $this->call('GET', '/api/tweet/609470005969817600?api_key='.$this->api_key);
        $respJson = json_decode($response->getContent());
        $dataTest = array(
                "text" => "mtiphp2015twitter"
        );
        $respTest = json_decode(json_encode($dataTest));

        $this->assertEquals($respJson, $respTest);
    }

}