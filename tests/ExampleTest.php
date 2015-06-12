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

    public function test_not_existing_user()
    {
        $response = $this->call('GET', '/api/followers?api_key=5579bec3f0432&screen_name=eradsic_reptsadsadile');
        $this->assertResponseStatus(500);
    }

}
