<?php

namespace Drupal\myself_help\Form;

use Drupal\Core\Form\ConfigFormBase;
use Drupal\Core\Form\FormStateInterface;

/**
 * Provides a form for saving the error page title and content.
 */
class mySelfHelpConfigForm extends ConfigFormBase {

  /**
   * {@inheritdoc}
   */
  public function getFormId() {
    return 'my_self_help_config_form';
  }

  /**
   * {@inheritdoc}
   */
  protected function getEditableConfigNames() {
    return [
      'termsofservicesettings.termsofservice',
    ];
  }

  /**
   * {@inheritdoc}
   */
  public function buildForm(array $form, FormStateInterface $form_state) {
    $config = $this->config('termsofservicesettings.termsofservice');

    $form = parent::buildForm($form, $form_state);

    $form['title'] = [
      '#type' => 'textfield',
      '#title' => $this->t('Title'),
      '#default_value' => $config->get('title'),
    ];

    $form['upload_icon'] = [
      '#type' => 'managed_file',
      '#title' => 'Upload Icon',
      '#description' => $this->t('Upload Icon Image'),
      '#default_value' => $config->get('upload_icon'),
      '#upload_location' => 'public://icon_images/',
	  "#upload_validators" => [
        "file_validate_extensions" => ["jpeg png"],
      ],
    ];

    $form['body_text'] = [
      '#type' => 'text_format',
      '#format' => 'full_html',
      '#title' => $this->t('Description'),
      '#default_value' => $config->get('body_text') ? $config->get('body_text') : '',
    ];

    $form['progress_bar'] = [
      '#type' => 'textarea',
      '#title' => $this->t('Progress Bar'),
      '#default_value' => $config->get('progress_bar'),
    ];

    $form['term_service_label'] = [
      '#type' => 'textfield',
      '#title' => $this->t('Term & Services Label'),
      '#default_value' => $config->get('term_service_label'),
    ];

	$form['term_service_help_text'] = [
      '#type' => 'text_format',
	  '#format' => 'full_html',
      '#title' => $this->t('Term & Services Help Text'),
      '#default_value' => $config->get('term_service_help_text') ? $config->get('term_service_help_text') : '',
    ];

	$form['next_button_url'] = [
      '#type' => 'textfield',
      '#title' => $this->t('Next Button URL'),
      '#default_value' => $config->get('next_button_url'),
    ];

    return $form;
  }

  /**
   * {@inheritdoc}
   */
  public function submitForm(array &$form, FormStateInterface $form_state) {
    $this->config('termsofservicesettings.termsofservice')
      ->set('title', $form_state->getValue('title'))
	  ->set('upload_icon', $form_state->getValue('upload_icon'))
      ->set('body_text', $form_state->getValue('body_text')['value'])
	  ->set('progress_bar', $form_state->getValue('progress_bar'))
      ->set('term_service_label', $form_state->getValue('term_service_label'))
	  ->set('term_service_help_text', $form_state->getValue('term_service_help_text')['value'])
	  ->set('next_button_url', $form_state->getValue('next_button_url'))
      ->save();
  }

}
