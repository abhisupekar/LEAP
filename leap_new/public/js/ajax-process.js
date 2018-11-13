(function ($) {

$('#evl-ajax-process').on('click',function(event) {
 
		// Prevent the default browser click handler
		event.preventDefault();
		// 'this' won't point to the element when it's inside the ajax closures,
		// so we reference it using a variable.
		var element = this;

		$.ajaxSetup({
		        headers: {
		            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
		        }
		});

		// Send POST request
		$.ajax({
		    type: 'POST',
		    url: '/evaluation/ajax-process',
		    data: $('form').serialize(),
		    dataType: 'json',
		    success: function (data) {
              if (data.status) {
                $('#submission_status_id').val(data.submission_status_id);
                $('#DraftModal').modal('show');
              }else {
              	alert('Something went wrong while saving, Try again.');
              }
		    },
		    	error: function (xmlhttp) {
				alert('An HTTP error '+ xmlhttp.status +' occurred.\n'+ element.text);
		    }
		});
	});
}(jQuery));