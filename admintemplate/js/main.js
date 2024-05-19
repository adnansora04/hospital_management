
(function ($) {
  // USE STRICT
  "use strict";
$(document).ready(function() {
	$("#other").hide();
	$("#otherlbl").hide();
	if ($("#oc").attr('value')=='Other'){
  $("#other").show();
  $("#otherlbl").show();
  
  }
	
});
})(jQuery);

  