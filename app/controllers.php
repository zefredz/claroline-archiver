<?php

$app->match('/', function() use ($app) {
  return 'It works!';
})->bind('homepage');
