<?php
return array(
    'application' => array(
        'name'  => __('Monkey'),
        'actions' => array(
            /*'crud' => array('Nos\Monkey\Model_Monkey', 'Nos\Monkey\Model_Species')*/
            'crud' => array(
                'Nos\Monkey\Model_Monkey' => array(
                    'labels' => array(
                        'add' => __('Add a monkey'),
                    ),
                ),
                'Nos\Monkey\Model_Species' => array(
                    'labels' => array(
                        'add' => __('Add a species'),
                    ),
                )
            ),
        )
    )
);