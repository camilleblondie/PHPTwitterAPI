<?php
/**
 * Created by PhpStorm.
 * User: jeanreptile
 * Date: 6/12/15
 * Time: 3:58 PM
 */

class PostTweetsTest extends TestCase
{
    var $tweetId = 0;

    public function testPostTweet()
    {
        $credentials = array(
            'status'=>'Teeest'
        );
        $response = $this->call('POST', '/api/tweet', $credentials);
        $respJson = json_decode($response->getContent());

        echo 'resp is :' ;
        echo $respJson;
        //$this->assertEquals($respJson, $respTest);
        $this->assertResponseOk();
    }

    /*
    public function testGetLastPostedTweet()
    {
        $response = $this->call('GET', '/api/twwets?api_key=5579bec3f0432&screen_name=eric_reptile');
        $respJson = json_decode($response->getContent());
        $dataTest = array(
            array(
                "screen_name" => "michel_denisot"),
            array(
                "screen_name" => "CartmanOfficiel"),
            array(
                "screen_name" => "Monsieur_Poulpe"),
            array(
                "screen_name" => "kyank")
        );
        $respTest = json_decode(json_encode($dataTest));

        $this->assertEquals($respJson, $respTest);
    }

    public function testDeleteTweet()
    {
        $response = $this->call('GET', '/api/twwets?api_key=5579bec3f0432&screen_name=eric_reptile');
        $respJson = json_decode($response->getContent());
        $dataTest = array(
            array(
                "screen_name" => "michel_denisot"),
            array(
                "screen_name" => "CartmanOfficiel"),
            array(
                "screen_name" => "Monsieur_Poulpe"),
            array(
                "screen_name" => "kyank")
        );
        $respTest = json_decode(json_encode($dataTest));

        $this->assertEquals($respJson, $respTest);
    }

    public function testTweetDeleted()
    {
        $response = $this->call('GET', '/api/twwets?api_key=5579bec3f0432&screen_name=eric_reptile');
        $respJson = json_decode($response->getContent());
        $dataTest = array(
            array(
                "screen_name" => "michel_denisot"),
            array(
                "screen_name" => "CartmanOfficiel"),
            array(
                "screen_name" => "Monsieur_Poulpe"),
            array(
                "screen_name" => "kyank")
        );
        $respTest = json_decode(json_encode($dataTest));

        $this->assertEquals($respJson, $respTest);
    }
    */
}

?>