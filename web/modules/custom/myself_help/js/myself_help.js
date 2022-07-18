(function ($, Drupal) {
  Drupal.behaviors.myself_help = {
    attach: function (context, settings) {

    jQuery('.my-self-help-form .form-submit').addClass("disabled");
	jQuery(".my-self-help-form .form-item-terms-service-agreement .form-checkbox").click(function () {
	  var checkBox = document.getElementById("edit-terms-service-agreement");
	    if (checkBox.checked == true){
		  jQuery('.my-self-help-form .form-submit').removeClass("disabled");
		} else {
		  jQuery('.my-self-help-form .form-submit').addClass("disabled");
		}
	});

    }
  };
})(jQuery, Drupal);
