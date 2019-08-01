 // jQuery plugin to prevent double submission of forms
 $.fn.preventDoubleSubmission = function () {
            $(this).on('submit', function (e) {

                var $form = $(this);
  	        $(this).find(':submit').attr('disabled','disabled');
  	        $(this).find(':submit').attr('value','Please wait..');


                if ($form.data('submitted') === true) {
                    // Previously submitted - don't submit again
                    alert('The form has already been submitted. Please wait.');
		            $(':submit', $form).prop('disabled',true)
                    e.preventDefault();
                } else {
                    // Mark it so that the next submit can be ignored
                    // ADDED requirement that form be valid
                    if($form.valid()) {
                        $form.data('submitted', true);
                    }
                }
            });

            // Keep chainability
            return this;
 };




$(document).ready(function () {

    // Get the curr val
    $('#store-form').preventDoubleSubmission();

    var  checkbox = $('#showRenewal'),
        chAuthFromBlock = $('#RenewalAuthFrom'),
        chRenewalBlock = $('#showRenewalsInputs');

    chRenewalBlock.hide();
    chAuthFromBlock.show();

    checkbox.on('click', function() {
        if($(this).is(':checked')) {
          chRenewalBlock.show();
          chAuthFromBlock.hide();
        } else {
          chRenewalBlock.hide();
          chAuthFromBlock.show();
        }
    })
});
