<?php
/**
 * Created by PhpStorm.
 * User: jeanreptile
 * Date: 6/12/15
 * Time: 5:48 PM
 */

class Favorites extends TestCase
{

    var $api_key = '557aef0ca09a4';

    public function testFavorites()
    {
        $response = $this->call('GET', '/api/favorites?api_key=' . $this->api_key . '&screen_name=eric_reptile');
        $respJson = json_decode($response->getContent());

        $dataTest = array(
            array(
                "text" => "Le mot bonheur est si usé qu'on distingue à travers sa trame le visage ironique de l'utopie.",
                "screen_name" => "bernardpivot1",
                "id" => "608497615374852097"
            ),
            array(
                "text" => "En philosophie ou au Café du Commerce, on se contredit ; en politique, on dit contre.",
                "screen_name" => "bernardpivot1",
                "id" => "607776112958177280"
            )
        );

        $respTest = json_decode(json_encode($dataTest));


        $this->assertEquals($respJson, $respTest);
    }
}
?>