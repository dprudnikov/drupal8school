<?php
/**
 * @file
 * Contains Drupal\lesson4\Element\CustomElement.
 */

namespace Drupal\lesson4\Element;

use Drupal\Core\Render\Element\RenderElement;

/**
 * Class Lesson4CustomElement
 * @package Drupal\lesson4\Element
 *
 * @RenderElement("lesson4_custom_element")
 */
class Lesson4CustomElement extends RenderElement {

  /**
   * Returns the element properties for this element.
   *
   * @return array
   *   An array of element properties. See
   *   \Drupal\Core\Render\ElementInfoManagerInterface::getInfo() for
   *   documentation of the standard properties of all elements, and the
   *   return value format.
   */
  public function getInfo() {
    $class = get_class($this);
    return array(
      '#theme' => 'custom_element',
      '#text' => 'Custom Element Text',
      '#pre_render' => [
        array($class, 'preRenderCustomElement'),
      ],
    );
  }

  public static function preRenderCustomElement($element) {
    $element['text'] = [
      '#markup' => 'Text:' . $element['#text']
    ];

    return $element;
  }
}
