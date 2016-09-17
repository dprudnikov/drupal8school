<?php

/**
 * @file
 * Contains \Drupal\tr_module\ServiceExampleController.
 */

namespace Drupal\lesson6\Controller;

use Drupal\tr_module\TrModuleService;
use Drupal\Core\Controller\ControllerBase;
use Symfony\Component\DependencyInjection\ContainerInterface;

class CurrencyServiceController extends ControllerBase {

  /**
   * @var \Drupal\tr_module\TrModuleService
   */
  protected $service;

  /**
   * {@inheritdoc}
   */
  public function __construct(TrModuleService $service) {
    $this->service = $service;
  }

  /**
   * {@inheritdoc}
   */
  public static function create(ContainerInterface $container) {
    return new static(
      $container->get('currency.service')
    );
  }

  /**
   * {@inheritdoc}
   */
  public function simple_service() {
    return [
      '#markup' => $this->service->getServiceValue(),
    ];
  }

}