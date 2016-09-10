<?php
/**
 * @file
 * Contains \Drupal\lesson4\Controller\Lesson4JsonResponseController.
 */
namespace Drupal\lesson4\Controller;

use Drupal\Core\Controller\ControllerBase;
use Symfony\Component\HttpFoundation\JsonResponse;

class Lesson4JsonResponseController extends ControllerBase {

  public function page_json() {
    $response = new JsonResponse();
    $response->setData(array(
      'data' => 'Test Json DATA'
    ));

    return $response;
  }

}