<?php

/**
 * @file
 * Contains \Drupal\lesson6\Plugin\Block\CustomModuleExampleBlock.
 */

namespace Drupal\lesson6\Plugin\Block;

use Drupal\Core\Block\BlockBase;
use Drupal\Core\Form\FormStateInterface;

/**
 * Provides a CustomModuleExampleBlock plugin.
 *
 * @Block(
 *   id = "lesson6_currency_block",
 *   admin_label = @Translation("Custom module block example"),
 * )
 */
class CurrencyBlock extends BlockBase {

  /**
   * {@inheritdoc}
   */
  public function build() {
    $service = \Drupal::service('lesson6.service');
    $service_value = $service->getServiceValue();
    return [
      '#type' => 'markup',
      '#markup' => '<b>Returned by Service: </b>' . $service_value . '<br />' .
        '<b>Returned by Block Config: </b>' . $this->configuration['lesson6_block_string'],
    ];
  }

  /**
   * {@inheritdoc}
   */
  public function defaultConfiguration() {
    return [
      'lesson6_block_string' => $this->t('A default value. This block was created at %time', array('%time' => date('c'))),
    ];
  }

  /**
   * {@inheritdoc}
   */
  public function blockForm($form, FormStateInterface $form_state) {
    $form['lesson6_block_string'] = [
      '#type' => 'textarea',
      '#title' => $this->t('Block contents'),
      '#description' => $this->t('This text will appear in the block.'),
      '#default_value' => $this->configuration['lesson6_block_string'],
    ];

    return $form;
  }

  /**
   * {@inheritdoc}
   */
  public function blockSubmit($form, FormStateInterface $form_state) {
    $this->configuration['lesson6_block_string']
      = $form_state->getValue('lesson6_block_string');
  }

}
