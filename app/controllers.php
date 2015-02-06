<?php

// use Symfony\Component\Form\FormError;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
// use Symfony\Component\Validator\Constraints as Assert;

$app->match('/', function() use ($app) {
  return 'It works!';
})->bind('homepage');
