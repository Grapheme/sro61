<?=form_open_multipart($this->uri->uri_string(),array('class'=>'form-horizontal')); ?>
	<legend>Профиль пользователя</legend>
	<fieldset>
		<div class="control-group">
			<label for="id" class="control-label">Номер:</label>
			<div class="controls">
				<input type="text" class="span1" name="orgid" value="<?=$user['org_id'];?>">
			</div>
		</div>
		<div class="control-group">
			<label for="organization " class="control-label">Организация: </label>
			<div class="controls">
				<input type="text" class="span5 input-valid" name="organization" value="<?=$user['organization'];?>">
				<span class="help-inline" style="display:none;">&nbsp;</span>
			</div>
		</div>
		<div class="control-group">
			<label for="title" class="control-label">Короткое название: </label>
			<div class="controls">
				<input type="text" class="span3 input-valid" name="title" value="<?=$user['title'];?>">
				<span class="help-inline" style="display:none;">&nbsp;</span>
			</div>
		</div>
		<div class="control-group">
			<label for="status" class="control-label">Статус:</label>
			<div class="controls">
				<input type="text" class="span3 input-valid" name="status" value="<?=$user['status'];?>">
				<span class="help-inline" style="display:none;">&nbsp;</span>
			</div>
		</div>
		<div class="control-group">
			<label for="grn " class="control-label">ГРН: </label>
			<div class="controls">
				<input type="text" class="span5 input-valid" name="grn" value="<?=$user['grn'];?>">
				<span class="help-inline" style="display:none;">&nbsp;</span>
			</div>
		</div>
		<div class="control-group">
			<label for="inn " class="control-label">ИНН: </label>
			<div class="controls">
				<input type="text" class="span5 input-valid" name="inn" value="<?=$user['inn'];?>">
				<span class="help-inline" style="display:none;">&nbsp;</span>
			</div>
		</div>
		<div class="control-group">
			<label for="number " class="control-label">Номер допуска: </label>
			<div class="controls">
				<input type="text" class="span5 input-valid" name="number" value="<?=$user['number'];?>">
				<span class="help-inline" style="display:none;">&nbsp;</span>
			</div>
		</div>
		<div class="control-group">
			<label for="address " class="control-label">Адрес: </label>
			<div class="controls">
				<input type="text" class="span5 input-valid" name="address" value="<?=$user['address'];?>">
				<span class="help-inline" style="display:none;">&nbsp;</span>
			</div>
		</div>
		<div class="control-group">
			<label for="email" class="control-label">Email: </label>
			<div class="controls">
				<input type="text" class="span5 input-valid" name="email" value="<?=$user['email'];?>">
				<span class="help-inline" style="display:none;">&nbsp;</span>
			</div>
		</div>
		<div class="control-group">
			<label for="phones " class="control-label">Телефон: </label>
			<div class="controls">
				<input type="text" class="span5" name="phones" value="<?=$user['phones'];?>">
				<span class="help-inline" style="display:none;">&nbsp;</span>
			</div>
		</div>
		<div class="control-group">
			<label for="login " class="control-label">Логин: </label>
			<div class="controls">
				<input type="text" class="span5 input-valid" name="login" value="<?=$user['login'];?>">
				<span class="help-inline" style="display:none;">&nbsp;</span>
			</div>
		</div>
		<div class="control-group">
			<label for="content" class="control-label">Пароль: </label>
			<div class="controls">
				<input type="text" class="span5 input-valid" name="password" value="<?=$user['pass'];?>">
				<span class="help-inline" style="display:none;">&nbsp;</span>
			</div>
		</div>
		<hr />
		<div class="control-group">
			<label for="content" class="control-label">Следующий номер реестра: </label>
			<div class="controls">
				<input type="text" class="span5 input-valid" name="document" value="<?=$user['document'];?>">
				<span class="help-inline" style="display:none;">&nbsp;</span>
			</div>
		</div>
	</fieldset>
	<div class="form-actions">
		<button class="btn btn-success" type="submit" id="send" name="submit" value="send">Сохранить</button>
		<button class="btn btn-inverse backpath" type="button">Отменить</button>
	</div>
<?= form_close(); ?>