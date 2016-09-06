<?php

/**
 * @file
 * Contains \Drupal\tr_module\TrModuleService.
 */

namespace Drupal\tr_module;

class TrModuleService {

  protected $value;

  /**
   * When the service is created, set a value for the example variable.
   */
  public function __construct() {
    $this->value = 'Simple Service Returned value';
  }

  /**
   * Return the value of the example variable.
   */
  public function getServiceValue() {
    return $this->value;
  }

}