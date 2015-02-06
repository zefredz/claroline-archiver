<?php

$app->match('/', function() {
  return 'It works!';
})->bind('homepage');
