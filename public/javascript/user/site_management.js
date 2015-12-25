$(function()
{
	$('.site_view_container').hide();

	$('#remove_site_control').click(function(e)
	{
		e.preventDefault();
		$('#remove_site_modal').modal('show');
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
