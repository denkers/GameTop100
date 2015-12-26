$(function()
{
	initTooltips();

	$('.site_comments_container').hide();

	$('#game_item_link').click(function(e)
	{
		e.preventDefault();
		var url	=	$(this).attr('href');


		$.ajax
		({		
			
		});	
	});

	$('.site_comments_group').click(function(e)
	{
		e.preventDefault();
		var comments_container	=	$(this).closest('.ranking_item').find('.site_comments_container');

		comments_container.slideToggle('fast');
	});
});
