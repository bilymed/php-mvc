<?php


$router->get('/', "Home#index");
$router->get('/home', function() {echo 'home';});