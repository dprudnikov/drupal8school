<?php

namespace Drupal\tr_module\Plugin\views\area;

use Drupal\Core\Form\FormStateInterface;
use Drupal\views\Plugin\views\area\TextCustom;

/**
 * Views area text handler.
 *
 * @ingroup views_area_handlers
 *
 * @ViewsArea("tr_module_text_custom_year")
 */
class TrModuleTextCustomYear extends TextCustom {

  /**
   * {@inheritdoc}
   */
  public function buildOptionsForm(&$form, FormStateInterface $form_state) {
    parent::buildOptionsForm($form, $form_state);

    $form['content'] = [
      '#title' => $this->t('Content'),
      '#type' => 'textarea',
      '#default_value' => $this->options['content'],
      '#rows' => 3,
    ];
  }

  /**
   * {@inheritdoc}
   */
  public function render($empty = FALSE) {
    if (!$empty || !empty($this->options['empty'])) {
      return array(
        '#markup' => date('Y') . ' ' . $this->renderTextarea($this->options['content']),
      );
    }

    return array();
  }

}
