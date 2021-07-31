<?php

    require 'vendor/autoload.php';

    $app = new \strawberrykit\strawberryphp\App();
    //$app->config->setEndpoint('/method/resource');
    //$app->config->setResourcePath("/");
    $app->boot();
    $app->serve();
