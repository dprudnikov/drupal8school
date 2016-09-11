<?php

namespace Drupal\lesson8;

class Lesson8Service {

  /**
   * {@inheritdoc}
   */
  public function __construct($factory) {
    $this->loggerFactory = $factory;
  }

  /**
   * {@inheritdoc}
   */
  public function logOtherChannels($message) {
    $this->loggerFactory->get('lesson8')->emergency('@placeholder', ['@placeholder'=>$message]);
    $this->loggerFactory->get('mytype')->warning('@placeholder', ['@placeholder'=>$message]);
  }

}
