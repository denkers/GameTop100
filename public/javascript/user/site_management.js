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

		$('.site_view_container').slideDown('fast');
	});
});
