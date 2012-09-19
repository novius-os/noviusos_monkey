<?php
return array(
    'query' => array(
        'model' => 'Nos\Monkey\Model_Species',
        'order_by' => array('mksp_title' => 'ASC'),
    ),
    'dataset' => array(
        'title' => array(
            'column'        => 'mksp_title',
            'headerText'    => __('Species')
        ),
    )
);