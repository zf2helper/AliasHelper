<?php
return array(
    'service_manager' => array(
        'factories' => array(
            'AliasHelper' => function($serviceManager) {
            $em = $serviceManager->get('doctrine.entitymanager.orm_default');
            $model = new Alias\Model\Alias($em);
            
            return $model;
        }
        )
    )
);