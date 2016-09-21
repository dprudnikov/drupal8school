<?php

namespace Drupal\prudnikov_denis_lesson8\Form;

use Drupal\Core\Form\FormBase;
use Drupal\Core\Form\FormStateInterface;

class LoggingCache extends FormBase {

  /**
   * {@inheritdoc}
   */
  public function buildForm(array $form, FormStateInterface $form_state) {
    $message = $this->getCacheMessage();
    $_SESSION['messages'] = null;
    drupal_set_message($message);

    $form['title'] = [
      '#type' => 'textfield',
      '#title' => $this->t('Type a message'),
    ];

    $form['actions'] = [
      '#type' => 'actions',
    ];

    $form['actions']['log_cache'] = [
      '#type' => 'submit',
      '#value' => 'Save message in log & cache',
      '#submit' => ['::log_cacheFormSubmit'],
    ];

    $form['actions']['invalidate_cache'] = [
      '#type' => 'submit',
      '#value' => 'Invalidate cache',
      '#submit' => ['::invalidateFormSubmit'],
    ];

    $form['actions']['delete_cache'] = [
      '#type' => 'submit',
      '#value' => 'Delete cache',
      '#submit' => ['::deleteFormSubmit'],
    ];

    return $form;
  }

  /**
   * {@inheritdoc}
   */
  public function getFormId() {
    return 'prudnikov_denis_lesson8_form';
  }

  /**
   * {@inheritdoc}
   */
  public function getCidCache(){
    return 'prudnikov_denis_lesson8:test_cache';
  }

  /**
   * {@inheritdoc}
   */
  public function validateForm(array &$form, FormStateInterface $form_state) {
    $title = $form_state->getValue('title');
    $handlers = $form_state->getSubmitHandlers();
    if (in_array('::log_cacheFormSubmit', $handlers) && empty($title)){
      $form_state->setErrorByName('title', $this->t('Type a message is required.'));
    }
  }

  /**
   * {@inheritdoc}
   */
  public function submitForm(array &$form, FormStateInterface $form_state) {
    parent::submitForm($form, $form_state);
  }

  /**
   * {@inheritdoc}
   */
  public function log_cacheFormSubmit(array &$form, FormStateInterface $form_state) {
    $title = $form_state->getValue('title');
    \Drupal::service('prudnikov_denis_lesson8.service_log_multiple_channels')->logOtherChannels($title);
    \Drupal::cache('data')->set($this->getCidCache(), $title);
    $form_state->setRebuild(TRUE);
  }

  /**
   * {@inheritdoc}
   */
  public function invalidateFormSubmit(array &$form, FormStateInterface $form_state) {
    \Drupal::cache('data')->invalidate($this->getCidCache());
    $form_state->setRebuild(TRUE);
  }

  /**
   * {@inheritdoc}
   */
  public function deleteFormSubmit(array &$form, FormStateInterface $form_state) {
    \Drupal::cache('data')->delete($this->getCidCache());
    $form_state->setRebuild(TRUE);
  }

  /**
   * {@inheritdoc}
   */
  public function getCacheMessage() {
    $message = $this->t('There are no any cache items');
    $cache = \Drupal::cache('data')->get($this->getCidCache(), TRUE);
    if ($cache) {
      if (!$cache->valid) {
        $message = 'Cache Item: ' . $cache->data . ' - Invalid';
      }
      else {
        $message = 'Cache Item: ' . $cache->data . ' - valid';
      }
    }

    return $message;
  }
}
