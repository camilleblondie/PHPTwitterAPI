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
        $response = $this->call('GET', '/followings?screen_name=test_php_2015&count=1');
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
