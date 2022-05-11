<?php

require dirname(__FILE__) . '/vendor/autoload.php';
require dirname(__FILE__) . '/ProjectorService.php';
require dirname(__FILE__) . '/BookingProjection.php';

printf("starting\r\n");
$server = new \Grpc\RpcServer();
$server->addHttp2Port('0.0.0.0:9091');
$server->handle(new ProjectorService(new BookingProjection()));
$server->run();
