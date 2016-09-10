<?php

namespace Drupal\lesson4\Plugin\Block;

use Drupal\Core\Block\BlockBase;

/**
 * Provides a Lesson 4: custom block.
 *
 * @Block(
 *   id = "lesson4_example_block",
 *   admin_label = @Translation("Lesson 4: custom block")
 * )
 */
class Lesson4ExampleBlock extends BlockBase {

  /**
   * {@inheritdoc}
   */
  public function build() {

    return [
      '#type' => 'markup',
      '#markup' => $this->t('Lesson 4 custom block content.'),
    ];
  }

}
