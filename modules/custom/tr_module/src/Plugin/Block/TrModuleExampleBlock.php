<?php

/**
 * @file
 * Contains \Drupal\tr_module\Plugin\Block\CustomModuleExampleBlock.
 */

namespace Drupal\tr_module\Plugin\Block;

use Drupal\Core\Block\BlockBase;
use Drupal\Core\Form\FormStateInterface;

/**
 * Provides a CustomModuleExampleBlock plugin.
 *
 * @Block(
 *   id = "tr_module_example_block",
 *   admin_label = @Translation("Custom module block example"),
 * )
 */
class TrModuleExampleBlock extends BlockBase {

  /**
   * {@inheritdoc}
   */
  public function build() {
    $service = \Drupal::service('tr_module.service');
    $service_value = $service->getServiceValue();
    return [
      '#type' => 'markup',
      '#markup' => '<b>Returned by Service: </b>' . $service_value . '<br />' .
        '<b>Returned by Block Config: </b>' . $this->configuration['tr_module_block_string'],
    ];
  }

  /**
   * {@inheritdoc}
   */
  public function defaultConfiguration() {
    return [
      'tr_module_block_string' => $this->t('A default value. This block was created at %time', array('%time' => date('c'))),
    ];
  }

  /**
   * {@inheritdoc}
   */
  public function blockForm($form, FormStateInterface $form_state) {
    $form['tr_module_block_string'] = [
      '#type' => 'textarea',
      '#title' => $this->t('Block contents'),
      '#description' => $this->t('This text will appear in the block.'),
      '#default_value' => $this->configuration['tr_module_block_string'],
    ];

    return $form;
  }

  /**
   * {@inheritdoc}
   */
  public function blockSubmit($form, FormStateInterface $form_state) {
    $this->configuration['tr_module_block_string']
      = $form_state->getValue('tr_module_block_string');
  }

}
