<?php

namespace Claroline\Archiver\Controller;

use Silex\Application;

/**
 * Index controller
 * @package claroline-archiver
 */
class ArchiverController {

  /**
   * Serve the index page
   * @param  Silex\Application $app
   * @return page output
   */
  public function index(Application $app) {
    return $app['twig']->render('index.html.twig');
  }

  /**
   * Serve the course loading page
   * @param  Silex\Application $app
   * @return page output
   */
  public function loadCourse(Application $app) {

    $courses = $app['db']->connection()->table('cours')->select('code', 'intitule as title')->get();

    $choices = array();

    foreach ( $courses as $course ) {
      $choices[$course->code] = utf8_encode($course->title);
    }

    $data = array(
        'courseId' => ''
    );

    $form = $app['form.factory']->createBuilder('form', $data )
      ->setAction('/archiver/course/search')
      ->add('courseId', 'choice', array(
        'choices' => $choices,
        'expanded' => false,
        'multiple' => false
      ))
      ->getForm();

    return $app['twig']->render(
      'courseform.html.twig',
      array(
        'form'=>$form->createView()
      )
    );
  }
}
