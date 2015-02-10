<?php

namespace Claroline\Archiver\Controller;

class ArchiverController {

  protected $app;

  public function __construct( $app ) {
    $this->app = $app;
  }

  public function loadCourse() {

    $data = array(
        'courseId' => ''
    );

    $form = $this->app->form($data)
      ->setAction('/course/search')
      ->add('courseId')
      ->getForm();

    return $this->app->render(
      'courseform.html.twig',
      array(
        'form'=>$form->createView()
      )
    );
  }
}
