jQuery(document).ready(function() {

    jQuery('#form-users-add').validate({

        errorPlacement: function(error, element) {

            error.appendTo(element.parent());

            jQuery('#form-users-add label.error').css('margin-bottom', '-10px');

            jQuery('.input-append .add-on').css('border-radius', '0 4px 4px 0');

        }

    });

});