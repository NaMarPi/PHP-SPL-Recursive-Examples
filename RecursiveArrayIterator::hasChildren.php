<?php

// A simple use case of RecursiveArrayIterator::hasChildren method

function hasChildrenTest() {

    $array = array (

            'a' => 'a text',

            'b' => array(
                    'b_1' => 'b_1 text',
                    'b_2' => 'b_2 text',
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



    $iterator = new RecursiveIteratorIterator( new RecursiveArrayIterator( $array ), RecursiveIteratorIterator::CHILD_FIRST );


////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////


    foreach( $iterator as $key => $current ) {

        if( ! $iterator->getInnerIterator()->hasChildren() ) {

            $iterator->getInnerIterator()->offsetSet( $key, 'LEAF' );
        }
    }


print_r($object);

////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////


    foreach( $iterator as $key => $current ) {

        if( $iterator->getInnerIterator()->hasChildren() && $iterator->getInnerIterator()->count() == 2 ) {

            $iterator->getInnerIterator()->offsetSet( $key, 'NODE' );
        }
    }


print_r($object);

////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////

}

hasChildrenTest();



/* Result

stdClass Object
(
    [a] => LEAF
    [b] => stdClass Object
        (
            [b_1] => LEAF
            [b_2] => LEAF
        )

    [c] => stdClass Object
        (
            [c_1] => stdClass Object
                (
                    [c_1_1] => LEAF
                )

            [c_2] => stdClass Object
                (
                    [c_2_1] => LEAF
                    [c_2_2] => LEAF
                )
        )
)

////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////

stdClass Object
(
    [a] => LEAF
    [b] => stdClass Object
        (
            [b_1] => LEAF
            [b_2] => LEAF
        )

    [c] => stdClass Object
        (
            [c_1] => NODE
            [c_2] => NODE
        )
)

