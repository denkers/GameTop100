<div class='modal-header'>
	<button class='close' data-ng-click='$root.closeModal()'>&times;</button>
	<h4 class='modal-title'>Site creation</h4>
</div>

<div class='modal-body'>
	<!-- ADD SITE STATUS ALERT -->
	<uib-alert data-ng-show='addSiteResponse' close='addSiteResponse = null' type='<% addSiteResponse.status? "success" : "danger" %>'>
		<span class='<% registerResponse.status? "glyphicon glyphicon-ok-sign" : "glyphicon glyphicon-remove-sign" %>'></span> 
		<% addSiteResponse.message %>
	</uib-alert> 

	<div class='form-group'>
		<div class='input-group'>
			<label>Site title</label>
			<input class='form-control' type='text' data-ng-model='siteSaveData.s_title' required />
		</div>

		<div class='input-group'>
			<label>Site description</label>
			<textarea class='form-control' required data-ng-model=siteSaveData.s_desc'></textarea>
		</div>

		<div class='input-group'>
			<label>Site URL</label>
			<input class='form-control' type='text' data-ng-model='siteSaveData.s_add' required />
		</div>

		<div class='input-group'>
			<label>Game</label>
			<select data-ng-model='siteSaveData.s_game' class='form-control'>
				<option data-ng-repeat='game in game_list' value='<% game.id %>'><% game.name %></option>
			</select>
		</div>
	</div>

	<button data-ng-click='$root.closeModal()' class='btn btn-default'>Cancel</button>
	<button data-ng-click='saveData()' class='btn btn-success'>Save</button>
</div>
