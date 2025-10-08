(function ($, Drupal) {
  Drupal.behaviors.urinationSmartDate = {
    attach: function (context, settings) {
      function toggleEndValue() {
        const fieldType = $('input[name="field_type"]:checked', context).val();
        const fieldGrouped = $('input[name="field_grouped[value]"]', context).prop('checked');
        const inDifferentDays = $('input[name="field_in_different_days[value]"]', context).prop('checked');

        const $endWrapper = $('[data-drupal-selector*="edit-field-time-0-time-wrapper-end-value"]', context); // Contenedor de hora + fecha final
        const $endDateWrapper = $('[data-drupal-selector="edit-field-time-0-time-wrapper-end-value-date"]', context).closest('.js-form-item'); // Wrapper del input de fecha final
        const $separator = $('.smartdate--separator', context);

        // Reset, ocultar todo
        $endWrapper.hide();
        $separator.hide();
        $endDateWrapper.hide();

        if (fieldType === 'multiple' && fieldGrouped) {
          // Mostrar hora final
          $endWrapper.show();
          $separator.show();
          // Ocultar fecha final
          $endDateWrapper.hide();

          if (inDifferentDays) {
            // Mostrar fecha final
            $endDateWrapper.show();
          }
        }
      }

      // Ejecutar al cargar
      toggleEndValue();

      // Reaccionar a cambios
      $('input[name="field_type"]', context).on('change', toggleEndValue);
      $('input[name="field_grouped[value]"]', context).on('change', toggleEndValue);
      $('input[name="field_in_different_days[value]"]', context).on('change', toggleEndValue);
    }
  };
})(jQuery, Drupal);
