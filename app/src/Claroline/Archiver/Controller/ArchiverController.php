<?php

namespace Claroline\Archiver\Controller;

use Silex\Application;

class ArchiverController {

  protected $app;

  public function __construct( Application $app ) {
    $this->app = $app;
  }

  public function loadCourse() {

    $queryBuilder = $this->app['db']->createQueryBuilder();

    $query = $queryBuilder
      ->select('code')
      ->from('cl_cours')
      ->getSQL();

    $results = $this->app['db']->fetchAll($query);

    $choices = array();

    foreach ( $results as $row ) {
      $choices[] = $row['code'];
    }

    $data = array(
        'courseId' => ''
    );

    $form = $this->app['form.factory']->createBuilder('form', $data )
      ->setAction('/archiver/course/search')
      ->add('courseId', 'choice', array(
        'choices' => $choices,
        'expanded' => false,
        'multiple' => false
      ))
      ->getForm();

    return $this->app['twig']->render(
      'courseform.html.twig',
      array(
        'form'=>$form->createView()
      )
    );
  }
}
