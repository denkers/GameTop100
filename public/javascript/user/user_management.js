$(function()
{
	$('#login_form').submit(function(e)
	{
		e.preventDefault();
		var data	=	$(this).serialize();
		var url		=	$(this).attr('action');

		console.log(data);
		$.ajax
		({
			url: url,
			data: data,
			method: 'post',
			dataType: 'json',
			success: function(response)
			{
				showReturnMessage($('#login_alert'), response.status, 
					response.message, $('#login_alert_msg'));
			},

			error: function(xhr, response, error)
			{
				console.log(xhr.responseText);
			}
		});
	});

	$('#login_btn').click(function(e)
	{
		e.preventDefault();
		$('#login_form').submit();
	});

	$('#pass_field').focusout(function(e)
	{
		checkPasswordStrength();
	});

	$('#pass_match_field').focusout(function(e)
	{
		checkPasswordMatches();
	});

	$('#register_form').submit(function(e)
	{
		e.preventDefault();
		var url		=	$(this).attr('action');
		var data	=	$(this).serialize();

		$.ajax
		({
			url: url,
			data: data,
			method: 'POST',
			dataType: 'json',
			success: function(response)
			{
				showReturnMessage($('#register_alert'), response.status, response.message, $('#register_alert_msg'));
			},

			error: function(xhr, response, error)
			{
				console.log(xhr.responseText);
			}
		});
	});

	$('#register_submit_btn').click(function(e)
	{
		e.preventDefault();
		$('#register_form').submit();
	});

	$('#username_field').focusout(function(e)
	{
		var avail_addon		=	$('#user_avail_addon');
		var	url				=	avail_addon.attr('data-checkurl');
		var username_req	=	$(this).val();
		var data			=	'username_req=' + username_req;

		$.ajax
		({
			data: data,
			url: url,
			method: 'POST',
			dataType: 'json',
			success: function(response)
			{
				if(response.status)
				{
					avail_addon.css({'color': 'white', 'background-color': 'green'});
					avail_addon.text('Available');
				}

				else
				{
					avail_addon.css({'color': 'white', 'background-color': 'red'});
					avail_addon.text('Taken');
				}
			},
				
			fail: function(xhr, response, error)
			{
				console.log(xhr.responseText);
			}
		});
	});


	//min: 3 max: 16
	//weak: just alpha characters
	//moderate: alphanumeric characters
	//strong: capital alphanumeric characters

	function checkPasswordStrength()
	{
		var input			=	$('#pass_field');
		var str_indicator	=	$('#pass_str_ind');
		var	pass			=	input.val();


		var hasUppercase	=	pass.match(/[A-Z]/);
		var hasNumeric		=	pass.match(/[0-9]/);
		var hasAlpha		=	pass.match(/[a-z]/);

		if(pass.length > 5 && pass.length < 16)
		{
			if(hasAlpha && hasNumeric && hasUppercase) //strong
			{
				str_indicator.text('Strong');
				str_indicator.css({'background-color': '#4caf50', 'color': 'white', 'font-weight': 'bold'});
			}

			else if((hasAlpha || hasUppercase) && hasNumeric) //moderate
			{
				str_indicator.text('Moderate');
				str_indicator.css({'background-color': '#2196f3', 'color': 'white', 'font-weight': 'bold'});
			}

			else if((hasAlpha || hasUppercase) && !hasNumeric) //weak
			{
				str_indicator.text('Weak');
				str_indicator.css({'background-color': '#ff9800', 'color': 'white', 'font-weight': 'bold'});
			}
		}

		else
		{
			str_indicator.text('Invalid');
			str_indicator.css({'background-color': '#e51c23', 'color': 'white', 'font-weight': 'bold'});
		}
	}

	function checkPasswordMatches()
	{
		var inputFirst		=	$('#pass_field');
		var inputSec		=	$('#pass_match_field');
		var str_indicator	=	$('#pass_match_ind');
		var passFirst		=	inputFirst.val();
		var passSec			=	inputSec.val();


		if(passFirst == passSec && passFirst.length > 5)
		{
			str_indicator.text('Valid');
			str_indicator.css({'background-color': '#4caf50', 'color': 'white', 'font-weight': 'bold'});
		}
			
		else
		{
			str_indicator.text('Invalid');
			str_indicator.css({'background-color': '#e51c23', 'color': 'white', 'font-weight': 'bold'});
		}
	}

});
