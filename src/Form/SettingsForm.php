<?php

namespace Drupal\template_form\Form;

use Drupal\Core\Form\ConfigFormBase;
use Drupal\Core\Form\FormStateInterface;

/**
 * Configure template form settings for this site.
 */
class SettingsForm extends ConfigFormBase {

  /**
   * {@inheritdoc}
   */
  public function getFormId() {
    return 'template_form_settings';
  }

  /**
   * {@inheritdoc}
   */
  protected function getEditableConfigNames() {
    return ['template_form.settings'];
  }

  /**
   * {@inheritdoc}
   */
  public function buildForm(array $form, FormStateInterface $form_state) {
    $form['title'] = [
      '#type' => 'textfield',
      '#title' => $this->t('Title'),
      '#default_value' => $this->config('template_form.settings')->get('title'),
    ];
    $text_format = 'full_html';
    if ($this->config('template_form.settings')->get('text')['format']) {
      $text_format = $this->config('template_form.settings')->get('text')['format'];
    }
    $form['text'] = [
      '#type' => 'text_format',
      '#title' => 'Text',
      '#format' => $text_format,
      '#default_value' => $this->config('template_form.settings')->get('text')['value'],
    ];
    $form['color'] = [
      '#type' => 'textfield',
      '#title' => $this->t('Color'),
      '#default_value' => $this->config('template_form.settings')->get('color'),
    ];
    return parent::buildForm($form, $form_state);
  }

  /**
   * {@inheritdoc}
   */
  public function submitForm(array &$form, FormStateInterface $form_state) {
    $this->config('template_form.settings')
      ->set('title', $form_state->getValue('title'))
      ->set('text', $form_state->getValue('text'))
      ->set('color', $form_state->getValue('color'))
      ->save();
    parent::submitForm($form, $form_state);
  }

}
