$(document).ready(function () {
	$.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });

	$('.delete-supply').click(function () {
		var id = $(this).data('id');
		$(this).html('<img src="/img/ajax-loader.gif">');
		$.ajax({
		    url: '/supply/'+id,
		    data: { _method : 'DELETE' },
		    type: 'POST',
		    success: function(result) {
		        location.reload();
		    }
		});
	});

	$('.delete-order').click(function () {
		var id = $(this).data('id');
		$(this).html('<img src="/img/ajax-loader.gif">');
		$.ajax({
		    url: '/order/'+id,
		    data: { _method : 'DELETE' },
		    type: 'POST',
		    success: function(result) {
		        location.reload();
		    }
		});
	});

	$('#start_loading').click(function () {
		var formData = new FormData($('form')[0]);
		$('#order_file').parent().html('<img id="order_file" src="/img/ajax-loader.gif">');
		$.ajax({
	        url: '/import/order',
	        type: 'POST',
	        success: function () {
	        	location.reload();
	        },
	        error: function () {
	        	$('#order_file').parent().html('При загрузке файла произошла ошибка.');
	        },
	        data: formData,

	        cache: false,
	        contentType: false,
	        processData: false
	    });
	});
});