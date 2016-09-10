<?php

/**
 * @file
 * Contains \Drupal\tr_module\ServiceExampleController.
 */

namespace Drupal\lesson4\Controller;

use Drupal\Core\Controller\ControllerBase;

class Lesson4PageController extends ControllerBase {

  /**
   * {@inheritdoc}
   */
  public function page() {
    return [
      '#theme' => 'custom_element',
      '#text' => $this->t('Lesson 4: custom page content via custom element'),
    ];
  }

}