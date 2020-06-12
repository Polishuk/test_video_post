jQuery(function($){
	$('#filter').change(function(){
		var filter = $('#filter');
		$.ajax({
			url:filter.attr('action'),
			data:filter.serialize(), 
			type:filter.attr('method'),
			beforeSend:function(xhr){
				filter.find('.loader').text('Обновление'); 
				filter.find('.loader').show();
			},
			success:function(data){
				filter.find('.loader').hide(); 
				$('#response').html(data);
			}
		});
		return false;
	});
});	