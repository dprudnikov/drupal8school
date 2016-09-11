<?php

namespace Drupal\lesson6\Entity;

use Drupal\Core\Entity\EntityStorageInterface;
use Drupal\Core\Field\BaseFieldDefinition;
use Drupal\Core\Entity\ContentEntityBase;
use Drupal\Core\Entity\EntityTypeInterface;
use Drupal\lesson6\CurrencyInterface;
use Drupal\user\UserInterface;
use Drupal\Core\Entity\EntityChangedTrait;

/**
 * Defines the ContentEntityExample entity.
 *
 * @ingroup lesson6
 *
 * This is the main definition of the entity type. From it, an entityType is
 * derived. The most important properties in this example are listed below.
 *
 * id: The unique identifier of this entityType. It follows the pattern
 * 'moduleName_xyz' to avoid naming conflicts.
 *
 * label: Human readable name of the entity type.
 *
 * handlers: Handler classes are used for different tasks. You can use
 * standard handlers provided by D8 or build your own, most probably derived
 * from the standard class. In detail:
 *
 * - view_builder: we use the standard controller to view an instance. It is
 *   called when a route lists an '_entity_view' default for the entityType
 *   (see routing.yml for details. The view can be manipulated by using the
 *   standard drupal tools in the settings.
 *
 * - list_builder: We derive our own list builder class from the
 *   entityListBuilder to control the presentation.
 *   If there is a view available for this entity from the views module, it
 *   overrides the list builder. @todo: any view? naming convention?
 *
 * - form: We derive our own forms to add functionality like additional fields,
 *   redirects etc. These forms are called when the routing list an
 *   '_entity_form' default for the entityType. Depending on the suffix
 *   (.add/.edit/.delete) in the route, the correct form is called.
 *
 * - access: Our own accessController where we determine access rights based on
 *   permissions.
 *
 * More properties:
 *
 *  - base_table: Define the name of the table used to store the data. Make sure
 *    it is unique. The schema is automatically determined from the
 *    BaseFieldDefinitions below. The table is automatically created during
 *    installation.
 *
 *  - fieldable: Can additional fields be added to the entity via the GUI?
 *    Analog to content types.
 *
 *  - entity_keys: How to access the fields. Analog to 'nid' or 'uid'.
 *
 *  - links: Provide links to do standard tasks. The 'edit-form' and
 *    'delete-form' links are added to the list built by the
 *    entityListController. They will show up as action buttons in an additional
 *    column.
 *
 * There are many more properties to be used in an entity type definition. For
 * a complete overview, please refer to the '\Drupal\Core\Entity\EntityType'
 * class definition.
 *
 * The following construct is the actual definition of the entity type which
 * is read and cached. Don't forget to clear cache after changes.
 *
 * @ContentEntityType(
 *   id = "lesson6_Currency",
 *   label = @Translation("Currency entity"),
 *   handlers = {
 *     "view_builder" = "Drupal\Core\Entity\EntityViewBuilder",
 *     "list_builder" = "Drupal\lesson6\Entity\Controller\CurrencyListBuilder",
 *     "form" = {
 *       "add" = "Drupal\lesson6\Form\CurrencyForm",
 *       "edit" = "Drupal\lesson6\Form\CurrencyForm",
 *       "delete" = "Drupal\lesson6\Form\CurrencyDeleteForm",
 *     },
 *     "access" = "Drupal\lesson6\CurrencyAccessControlHandler",
 *   },
 *   list_cache_contexts = { "user" },
 *   base_table = "currency",
 *   admin_permission = "administer lesson6 entity",
 *   entity_keys = {
 *     "id" = "id",
 *     "name" = "name",
 *   },
 *   links = {
 *     "canonical" = "/currency/{lesson6_Currency}",
 *     "edit-form" = "/currency/{lesson6_Currency}/edit",
 *     "delete-form" = "/currency/{lesson6_Currency}/delete",
 *     "collection" = "/currency/list"
 *   },
 *   field_ui_base_route = "lesson6.Currency_settings",
 * )
 *
 * The 'links' above are defined by their path. For core to find the
 * corresponding route, the route name must follow the correct pattern:
 *
 * entity.<entity-name>.<link-name> (replace dashes with underscores)
 * Example: 'entity.lesson6_Currency.canonical'
 *
 * See routing file above for the corresponding implementation
 *
 * The Currency class defines methods and fields for the Currency entity.
 *
 * Being derived from the ContentEntityBase class, we can override the methods
 * we want. In our case we want to provide access to the standard fields about
 * creation and changed time stamps.
 *
 * Our interface (see CurrencyInterface) also exposes the EntityOwnerInterface.
 * This allows us to provide methods for setting and providing ownership
 * information.
 *
 * The most important part is the definitions of the field properties for this
 * entity type. These are of the same type as fields added through the GUI, but
 * they can by changed in code. In the definition we can define if the user with
 * the rights privileges can influence the presentation (view, edit) of each
 * field.
 *
 * The class also uses the EntityChangedTrait trait which allows it to record
 * timestamps of save operations.
 */
class Currency extends ContentEntityBase implements CurrencyInterface {

  use EntityChangedTrait;

  /**
   * {@inheritdoc}
   *
   * When a new entity instance is added, set the user_id entity reference to
   * the current user as the creator of the instance.
   */
  public static function preCreate(EntityStorageInterface $storage_controller, array &$values) {
//    parent::preCreate($storage_controller, $values);
//    $values += array(
//      'user_id' => \Drupal::currentUser()->id(),
//    );
  }

  /**
   * {@inheritdoc}
   */
  public function getDate() {
    return $this->get('date')->value;
  }

  /**
   * {@inheritdoc}
   */
  public function getCurrency() {
    return $this->get('currency')->value;
  }

  /**
   * {@inheritdoc}
   */
  public function getRate() {
    return $this->get('rate')->value;
  }

  /**
   * {@inheritdoc}
   */
  public function getRateDiff() {
    return $this->get('ratediff')->value;
  }

  /**
   * {@inheritdoc}
   */
  public function getOwner() {
    return \Drupal\user\Entity\User::load(1);
  }

  /**
   * {@inheritdoc}
   */
  public function getOwnerId() {
    return 1; //$this->get('user_id')->target_id;
  }

  /**
   * {@inheritdoc}
   */
  public function setOwnerId($uid) {
    $this->set('user_id', $uid);
    return $this;
  }

  /**
   * {@inheritdoc}
   */
  public function setOwner(UserInterface $account) {
    $this->set('user_id', $account->id());
    return $this;
  }

  /**
   * {@inheritdoc}
   *
   * Define the field properties here.
   *
   * Field name, type and size determine the table structure.
   *
   * In addition, we can define how the field and its content can be manipulated
   * in the GUI. The behaviour of the widgets used can be determined here.
   */
  public static function baseFieldDefinitions(EntityTypeInterface $entity_type) {

    // Standard field, used as unique if primary index.
    $fields['id'] = BaseFieldDefinition::create('integer')
      ->setLabel(t('ID'))
      ->setDescription(t('The ID of the Currency entity.'))
      ->setReadOnly(TRUE);

    $fields['date'] = BaseFieldDefinition::create('created')
      ->setLabel(t('Date'))
      ->setDescription(t('The date of the rate.'));

    $fields['currency'] = BaseFieldDefinition::create('string')
      ->setLabel(t('Currency code'))
      ->setDescription(t('The currency code of the Currency entity.'))
      ->setSettings(array(
        'default_value' => '',
        'max_length' => 3,
        'text_processing' => 0,
      ))
      ->setDisplayOptions('view', array(
        'label' => 'above',
        'type' => 'string',
        'weight' => -5,
      ))
      ->setDisplayOptions('form', array(
        'type' => 'string_textfield',
        'weight' => -5,
      ))
      ->setDisplayConfigurable('form', TRUE)
      ->setDisplayConfigurable('view', TRUE);

    $fields['rate'] = BaseFieldDefinition::create('integer')
      ->setLabel(t('Rate'))
      ->setDescription(t('The rate of currency in BYN'))
      ->setSettings(array(
        'default_value' => '',
        'max_length' => 255,
        'text_processing' => 0,
      ))
      ->setDisplayOptions('view', array(
        'label' => 'above',
        'type' => 'string',
        'weight' => -6,
      ))
      ->setDisplayOptions('form', array(
        'type' => 'string_textfield',
        'weight' => -6,
      ))
      ->setDisplayConfigurable('form', TRUE)
      ->setDisplayConfigurable('view', TRUE);

    $fields['rate_diff'] = BaseFieldDefinition::create('integer')
      ->setLabel(t('Rate Difference'))
      ->setDescription(t('The rate difference of currency in BYN with previous day.'))
      ->setSettings(array(
        'default_value' => '',
        'max_length' => 255,
        'text_processing' => 0,
      ))
      ->setDisplayOptions('view', array(
        'label' => 'above',
        'type' => 'string',
        'weight' => -6,
      ))
      ->setDisplayOptions('form', array(
        'type' => 'string_textfield',
        'weight' => -6,
      ))
      ->setDisplayConfigurable('form', TRUE)
      ->setDisplayConfigurable('view', TRUE);

    return $fields;
  }

}
