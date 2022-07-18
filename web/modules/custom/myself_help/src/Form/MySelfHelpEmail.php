<?php
/**
 * @file
 * Contains \Drupal\myself_help\Form\MySelfHelpEmail.
 */
namespace Drupal\myself_help\Form;


use Drupal\Core\Form\FormBase;
use Drupal\Core\Form\FormStateInterface;

class MySelfHelpEmail extends FormBase {

  /**
   * {@inheritdoc}
   */
  public function getFormId() {
    return 'MySelfHelpEmail';
  }

  /**
   * {@inheritdoc}
   */

  public function buildForm(array $form, FormStateInterface $form_state) {

    $form['#prefix'] = '<div id="myselfhelp-email-template">';
    $form['#suffix'] = '</div>';

    $form['html'] = array(
      '#type' => 'markup',
      '#markup' => "<h2>Email your progress to continue later:</h2><p>Enter your email to save your My Self-Help progress. If you don't save now, your inputs and results will be lost</p>",
     );

    $form['email'] = array(
      '#type' => 'email',
      '#title' => $this->t('Email'),
      '#attributes' => array(
        'placeholder' => t('Email'),
      ),
      '#required' => TRUE,
    );

    $form['my_captcha_element'] = array(
      '#type' => 'captcha',
      '#captcha_type' => 'recaptcha/reCAPTCHA',
    );

    $form['submit'] = array(
      '#type' => 'submit',
      '#value' => $this->t('Submit'),
    );

    return $form; 
  }

 /**Form validation */
  /**
   * {@inheritdoc}
   */
  public function validateForm(array &$form, FormStateInterface $form_state) {

  }

 /**Form save */
   /**
   * {@inheritdoc}
   */
  public function submitForm(array &$form, FormStateInterface $form_state) {
    $email_id = $form_state->getValue('email');
    //\Drupal::messenger()->addMessage($this->t($email_id), 'status', TRUE);
	//\Drupal::logger('form_state')->notice('<pre><code>' . print_r($form_state, TRUE) . '</code></pre>' );
  }
}