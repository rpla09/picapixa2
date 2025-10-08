<?php


namespace Drupal\urination\Plugin\Field\FieldWidget;

use Drupal\smart_date\Plugin\Field\FieldWidget\SmartDateInlineWidget;
use Drupal\Core\Field\FieldItemListInterface;
use Drupal\Core\Form\FormStateInterface;


/**
 * Plugin implementation of the 'urination_time_widget' widget.
 *
 * @FieldWidget(
 *   id = "urination_time_widget",
 *   label = @Translation("Urination Smart Date Widget"),
 *   field_types = {
 *     "smartdate"
 *   }
 * )
 */
class UrinationTimeWidget extends SmartDateInlineWidget {
//class SmartDateConditionalWidget extends SmartDateInlineRangeWidget {
/**
   * {@inheritdoc}
   */
  public function formElement(FieldItemListInterface $items, $delta, array $element, array &$form, FormStateInterface $form_state) {
   $element = parent::formElement($items, $delta, $element, $form, $form_state);

  // Aplica visibilidad condicional al campo end_value
  // $element['time_wrapper']['end_value']['#states'] = [
  //   'visible' => [
  //    // [':input[name="field_type"]' => ['value' => 'multiple']],
  // [':input[name="field_type[0][value]"]' => ['value' => 'multiple']],
  //   [':input[name="in_different_days[0][value]"]' => ['checked' => TRUE]],    ],
  // ];
$input = \Drupal::request()->request->all();

$field_type = $input['field_type'][0]['value'] ?? NULL;
$in_different_days = $input['field_in_different_days'][0]['value'] ?? NULL;

if ($field_type === 'multiple' && $in_different_days === '1') {
  $element['time_wrapper']['end_value']['#access'] = TRUE;
} else {
  $element['time_wrapper']['end_value']['#access'] = FALSE;
}

  return $element;
  }

}
