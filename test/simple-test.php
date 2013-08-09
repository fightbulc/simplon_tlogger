<?php

    require '../vendor/autoload.php';

    // ##########################################

    // we need an instance
    $tloggerInstance = new \Simplon\Tlogger\Tlogger('http://localhost/logtraffic');

    // ##########################################

    // based on the instance we just keep tracking...

    $tloggerInstance
        ->setTopicId(1)
        ->addParameter('uid', 1)
        ->release();

    $tloggerInstance
        ->setTopicId(2)
        ->addParameter('uid', 1)
        ->addParameter('aid', 100)
        ->release();

    $tloggerInstance
        ->setTopicId(3)
        ->setParameters(['uid' => 1, 'env' => 'mobile', 'name' => 'John', 'ip' => '1.1.1.1'])
        ->release();