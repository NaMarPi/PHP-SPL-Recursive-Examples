<?php

function iteratorMethodChainingTest() {

    $array = array (

            'a' => 'a text',

            'b' => array(
                    'b_1' => 'b_1 text',
                    'b_2' => 'b_2 text',
                    'b_3' => 'b_3 text',
            ),

            'c' => array(
                    'c_1' => array(
                            'c_1_1' => 'c_1_1 text',
                    ),
                    'c_2' => array(
                            'c_2_1' => 'c_2_1 text',
                            'c_2_2' => 'c_2_2 text',
                    ),
            ),
    );



    $object   = json_decode( json_encode( $array ));    // in case of array with associative keys
//++    $object   = array_to_object( $array );          // in case of array with numeric and/or associative keys
//**    $object   = new ArrayObject( $array, 0, "RecursiveArrayIterator" );
    $iterator = new RecursiveIteratorIterator( new RecursiveArrayIterator( $object ), RecursiveIteratorIterator::SELF_FIRST );


////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////


    foreach( $iterator as $key => $current ) {

        if( $iterator->getInnerIterator()->hasChildren() ) {

            foreach( $iterator->getInnerIterator()->getChildren() as $key => $value ) {

                if( $iterator->getInnerIterator()->getChildren()->hasChildren()
                      &&
                    $iterator->getInnerIterator()->getChildren()->getChildren()->count() == 1 ) {

                    foreach( $iterator->getInnerIterator()->getChildren()->getChildren() as $key => $value ) {

                        $iterator->getInnerIterator()->getChildren()->getChildren()->offsetSet( $key, 'single here' );
                    }
                }
            }
        }
    }

////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////


print_r($object);

}

iteratorMethodChainingTest();



/* Result

stdClass Object
(
    [a] => a text
    [b] => stdClass Object
        (
            [b_1] => b_1 text
            [b_2] => b_2 text
            [b_3] => b_3 text
        )

    [c] => stdClass Object
        (
            [c_1] => stdClass Object
                (
                    [c_1_1] => single here
                )

            [c_2] => stdClass Object
                (
                    [c_2_1] => c_2_1 text
                    [c_2_2] => c_2_2 text
                )
        )
)


