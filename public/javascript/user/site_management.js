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

				if(response.status)
				{
					container.fadeOut('fast', function()
					{
						container.remove();
					});
				}
			},

			error: function(xhr, response, error)	
			{
				console.log(xhr.responseText);
			},

			complete: function(response)
			{
				$('#remove_site_modal').modal('hide');
			}
		});
	});	

	$('.edit_site_control').click(function(e)
	{
		e.preventDefault();
		var url			=	$(this).attr('href');
		var container	=	$(this).closest('.list_site_item').find('.site_view_container');	

		$.getJSON(url, function(response)
		{
			container.slideDown('fast');
			container.find('textarea[name="s_desc"]').text(response.description);
			container.find('input[name="s_title"]').val(response.title);
			container.find('input[name="s_add"]').val(response.address);
		});
	});

	$('.cancel_site_btn').click(function(e)
	{
		e.preventDefault();
		var container	=	$(this).closest('.site_view_container');
		container.slideUp('fast');
	});
});
