<?php

namespace Drupal\myself_help\Form;

use Drupal\Core\Form\FormBase;
use Drupal\Core\Form\FormStateInterface;
use Drupal\Core\Entity\EntityTypeManagerInterface;
use Drupal\Core\Routing\RouteMatchInterface;
use Symfony\Component\DependencyInjection\ContainerInterface;
use Drupal\path_alias\AliasManagerInterface;
use Drupal\file\Entity\File;

 /**
  * {@inheritdoc}
 */
class MySelfHelpForm extends FormBase {
  /**
   * The entity type manager.
   *
   * @var \Drupal\Core\Entity\EntityTypeManagerInterface
   */
  protected $entityTypeManager;

  /**
   * The path alias manager.
   *
   * @var \Drupal\path_alias\AliasManagerInterface
   */
  protected $aliasManager;

  /**
   * The current route match.
   *
   * @var \Drupal\Core\Routing\RouteMatchInterface
   */
  protected $routeMatch;

  /**
   * {@inheritdoc}
   */
  public function __construct(EntityTypeManagerInterface $entity_type_manager, RouteMatchInterface $route_match, AliasManagerInterface $alias_manager) {
    $this->entityTypeManager = $entity_type_manager;
    $this->routeMatch = $route_match;
    $this->aliasManager = $alias_manager;
  }

  /**
   * {@inheritdoc}
   */
  public static function create(ContainerInterface $container) {
    return new static(
      $container->get('entity_type.manager'),
      $container->get('current_route_match'),
      $container->get('path_alias.manager')
    );
  }

  /**
   * {@inheritdoc}
   */
  public function getFormId() {
    return 'my_self_help_form';
  }

  /**
   * {@inheritdoc}
   */
  public function buildForm(array $form, FormStateInterface $form_state) {

	  $config = \Drupal::config('termsofservicesettings.termsofservice');
    $title_text = $config->get('title');
    $body_text = $config->get('body_text');
    $progress_bar = $config->get('progress_bar');
    $term_service_label = $config->get('term_service_label');
	  $term_service_help_text = $config->get('term_service_help_text');
	  $next_button_url = $config->get('next_button_url');
    $upload_icon = $config->get('upload_icon');
    $fid = $upload_icon['0'];
    if ($fid) {
      $icon_image = File::load($fid);
      $file_url = $icon_image->createFileUrl();
      $icon_image->setPermanent();
      $icon_image->save();
    }
	  //\Drupal::logger('fid')->notice('<pre><code>' . print_r($fid, TRUE) . '</code></pre>' );

    $form['#prefix'] = '<div class="terms-service-details container"><h2 class="page-header">My Self-Help</h2><div class="left--sidebar--area col-sm-4">'.$progress_bar.'</div>';
    $form['terms_service_markup'] = [
      '#type' => 'markup',
      '#prefix' => '<div class="right--content--area col-sm-8">',
      '#markup' => '
      <div class="header-wrapper">
      <div class="icon-image"><img src="'.$file_url.'"></div>
      <div class="title-text">'.$title_text.'</div>
      </div>
      <div class="body-text">'.$body_text.'</div>',
    ];
    $form['terms_service_agreement'] = [
      '#type' => 'checkbox',
      '#title' => $term_service_label,
      '#default_value' => 0,
	    '#required' => TRUE,
    ];

    $form['agreement_markup'] = [
      '#type' => 'markup',
      '#markup' => '<div class="terms-service-agreement-text">'.$term_service_help_text.'</div></div>',
    ];

    $form['actions']['back'] = [
      '#type' => 'markup',
      '#markup' => '<div class="prev-next--button"><a href="/" class="btn-cancel btn btn-back">Back</a>',
    ];
    
    $form['submit'] = [
      '#type' => 'markup',
      '#markup' => '<a href="'.$next_button_url.'" class="btn-primary btn btn-next js-form-submit form-submit disabled">Next</a>',
      '#suffix' => '</div></div>',
    ];

	$form['#attached']['library'][] = 'myself_help/myself_help';

    return $form;

  }


  /**
   * {@inheritdoc}
   */
  public function validateForm(array &$form, FormStateInterface $form_state) {

  }

  /**
   * {@inheritdoc}
   */
  public function submitForm(array &$form, FormStateInterface $form_state) {

	  //\Drupal::logger('upload_icon')->notice('<pre><code>' . print_r($form, TRUE) . '</code></pre>' );

  }

}