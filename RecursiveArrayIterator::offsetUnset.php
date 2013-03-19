<?php

// Very simple use case of RecursiveArrayIterator::offsetUnset method

function offsetUnsetTest() {

    $array = array (
            'a' => array(
                    'a_1' => 'a 1 first',
                    'a_2' => 'a 2 first',
            ),
            'b' => array(
                    'b_1' => array(
                            'b_1_1' => 'b 1 1 first',
                            'b_1_2' => 'b 1 2 first',
                            'b_1_3' => 'b 1 3 first',
                    ),

                    'b_2' => 0,
                    'b_3' => '',
                    'b_4' => array(),
                    'b_5' => new stdClass(),


                    'a' => array(
                            'a_1' => 'a 1 second',
                            'a_2' => 'a 2 second',
                    ),
                    'b' => array(
                            'b_1' => array(
                                    'b_1_1' => 'b 1 1 second',
                                    'b_1_2' => 'b 1 2 second',
                                    'b_1_3' => 'b 1 3 second',
                            ),

                            'b_2' => 0,
                            'b_3' => '',
                            'b_4' => array(),
                            'b_5' => new stdClass(),
                    ),
            ),
    );



    $object   = json_decode( json_encode( $array ));
//**    $object   = new ArrayObject( $array, 0, "RecursiveArrayIterator" );
    $iterator = new RecursiveIteratorIterator( new RecursiveArrayIterator( $object ), RecursiveIteratorIterator::CHILD_FIRST );
//    $iterator = new RecursiveIteratorIterator( new RecursiveArrayIterator( $object ), RecursiveIteratorIterator::SELF_FIRST );


////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////


    foreach( $iterator as $key => $current ) {

        if( in_array( $key, array( 'a_1', 'b_1', 'b_2', 'b_3', 'b_4', 'b_5' ))) {

            $iterator->getInnerIterator()->offsetUnset( $key );
        }
    }

////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////


print_r($object);


}

offsetUnsetTest();



/*

stdClass Object
(
    [a] => stdClass Object
        (
            [a_2] => a 2 first
        )

    [b] => stdClass Object
        (
            [b_2] => 0
            [a] => stdClass Object
                (
                    [a_2] => a 2 second
                )

            [b] => stdClass Object
                (
                    [b_2] => 0
                )
        )
)

*/

