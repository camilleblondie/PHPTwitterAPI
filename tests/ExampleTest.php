<?php

class ExampleTest extends TestCase {

    /**
     * A basic test example.
     *
     * @return void
     */
    public function testBasicExample()
    {
        $response = $this->call('GET', '/');

        $this->assertResponseOk();
    }

    public function testGetFollowers()
    {
        $response = $this->call('GET', '/api/followings?api_key=5579bec3f0432&screen_name=eric_reptile');
        //echo 'TEST 1';
        echo $response->getContent();
        $respJson = json_decode($response->getContent());
        $dataTest = array(
            array(
                'screen_name' => "jean_reptile"
            )
        );
        $respTest = json_decode(json_encode($dataTest));

        $this->assertEquals($respJson, $respTest);
    }

}
