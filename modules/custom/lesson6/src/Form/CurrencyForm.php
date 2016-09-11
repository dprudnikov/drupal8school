<?php

namespace Drupal\lesson6\Form;

use Drupal\Core\Entity\ContentEntityForm;
use Drupal\Core\Form\FormStateInterface;

/**
 * Form controller for the lesson6 entity edit forms.
 *
 * @ingroup lesson6
 */
class CurrencyForm extends ContentEntityForm {

  /**
   * {@inheritdoc}
   */
  public function buildForm(array $form, FormStateInterface $form_state) {
    /* @var $entity \Drupal\lesson6\Entity\Currency */
    $form = parent::buildForm($form, $form_state);

    return $form;
  }

  /**
   * {@inheritdoc}
   */
  public function save(array $form, FormStateInterface $form_state) {
    $form_state->setRedirect('entity.currency.collection');
    $entity = $this->getEntity();
    $entity->save();
  }

}
