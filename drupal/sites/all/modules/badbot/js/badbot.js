(function($) {

Drupal.behaviors.badbot = {
  attach: function (context, settings) {
    if (Drupal.settings.badbot.forms.length) {
      $(Drupal.settings.badbot.forms).each(function(i, form_data) {

        var form = $('#' + form_data.form_id);
        if (form.length) {
          var generated = false;
          
          form.submit(function(e) {
            if (!generated) {
              e.preventDefault();
              
              generated = true;
              
              var field_data = $('#edit-' + form_data.field, form).attr('value');
            
              if(field_data && $('#edit-' + form_data.validation_field, form)) {
                $.get(Drupal.settings.badbot.base_path + '/badbot/token/' + field_data, function(return_data){
                  $('#edit-' + form_data.validation_field, form).attr('value', return_data);
                  
                  form.submit();
                });
              }
            }
          });
        }
      });
    }
  }  
};

})(jQuery);