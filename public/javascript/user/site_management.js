$(function()
{
	$('.site_view_container').hide();

	$('#site_alert');

	$('.remove_site_control').click(function(e)
	{
		e.preventDefault();
		$(this).closest('.list_site_item').addClass('active_remove');
		$('#remove_site_modal').modal('show');
	});

	$('#remove_site_confirm').click(function(e)
	{
		e.preventDefault();
		var container	=	$('.active_remove');
		var url			=	container.find('.remove_site_control').attr('href');
		var id			=	container.find('.site_view_container').attr('data-siteid');
		var data		=	{ 's_id' : id };

		$.ajax
		({
			url: url,
			method: 'POST',
			data: data,
			dataType: 'json',
			success: function(response)
			{
				showReturnMessage($('#site_alert'), response.status, 
						response.message, $('#site_alert_msg'));
			},

			error: function(xhr, response, error)	
			{
				console.log(xhr.responseText);
			}
		});
	});	

	$('#edit_site_control').click(function(e)
	{
		e.preventDefault();
		var url	=	$(this).attr('href');

		$.get(url, function(response)
		{
			$('.site_view_container').slideDown('fast');
			$('input[name="s_desc"]').val(response.description);
			$('input[name="s_title"]').val(response.title);
			$('input[name="s_add"]').val(response.address);
		});
	});
});
