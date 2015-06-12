<?php
/**
 * Created by PhpStorm.
 * User: jeanreptile
 * Date: 6/12/15
 * Time: 3:58 PM
 */

class PostGetAndDeleteTweetTest extends TestCase
{

    public function testPostGetAndDeleteTweet()
    {
        $tweetToTest = 'Test '.rand(0, 2000);
        $credentials = array(
            'status'=> $tweetToTest
        );
        $response = $this->call('POST', '/api/tweet?api_key=557aef0ca09a4', $credentials);
        $respJson = json_decode($response->getContent());

        $this->assertResponseStatus(200);


        $tweetId = $respJson->{"id"};
        $response = $this->call('GET', '/api/tweet/'.$tweetId.'?api_key=557aef0ca09a4');
        $respJson = json_decode($response->getContent());

        $this->assertResponseStatus(200);

        $this->assertEquals($tweetToTest, $respJson->{'text'});

        $response = $this->call('DELETE', '/api/tweet/'.$tweetId.'?api_key=557aef0ca09a4');


        $this->assertResponseStatus(200);
    }
}

?>