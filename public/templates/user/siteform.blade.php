<!-- ADD SITE STATUS ALERT -->
<uib-alert data-ng-show='addSiteResponse' close='addSiteResponse = null' type='<% addSiteResponse.status? "success" : "danger" %>'>
	<span class='<% registerResponse.status? "glyphicon glyphicon-ok-sign" : "glyphicon glyphicon-remove-sign" %>'></span> 
	<% addSiteResponse.message %>
</uib-alert> 


<div class='form-group site_add_inputs'>
	<div class='input-group'>
		<label>Site title</label>
		<input class='form-control' type='text' data-ng-model='siteSaveData.s_title' required />
	</div>

	<div class='input-group'>
		<label>Site description</label>
		<textarea class='form-control' required data-ng-model='siteSaveData.s_desc'></textarea>
	</div>

	<div class='input-group'>
		<label>Site URL</label>
		<input class='form-control' type='text' data-ng-model='siteSaveData.s_add' required />
	</div>

	<div class='input-group'>
		<label>Site tags</label>
		<input class='form-control' type='text' data-ng-model='siteSaveData.s_add' required />
	</div>

	<div class='input-group'>
		<label>Game</label>
		<select data-ng-model='siteSaveData.s_game' class='form-control'>
			<option data-ng-repeat='game in game_list' value='<% game.id %>'><% game.name %></option>
		</select>
	</div>
</div>

