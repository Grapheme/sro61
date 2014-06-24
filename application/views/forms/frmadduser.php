<?=form_open_multipart($this->uri->uri_string(),array('class'=>'form-horizontal')); ?>
	<legend>Форма регистрации пользователя</legend>
	<fieldset>
		<div class="control-group">
			<label for="id" class="control-label">Номер:</label>
			<div class="controls">
				<input type="text" class="span1 digital input-valid" name="id" value="<?=set_value('id');?>">
				<span class="help-inline" style="display:none;">&nbsp;</span>
			</div>
		</div>
		<div class="control-group">
			<label for="expert" class="control-label">Класс организации: </label>
			<div class="controls">
				<select class="span3" name="class" id="set-organization-class">
					<option value="0">Экспертная организация</option>
					<option value="1" selected="selected" >Член СРО</option>
				</select>
			</div>
		</div>
		<div class="control-group">
			<label for="status" class="control-label">Статус:</label>
			<div class="controls">
				<input type="text" class="span3 input-valid" id="organization-status" name="status" value="<?=set_value('status');?>">
				<span class="help-inline" style="display:none;">&nbsp;</span>
			</div>
		</div>
		<div class="control-group">
			<label for="organization" class="control-label">Организация: </label>
			<div class="controls">
				<input type="text" class="span5 input-valid" name="organization" value="<?=set_value('organization');?>">
				<span class="help-inline" style="display:none;">&nbsp;</span>
			</div>
		</div>
		<div class="control-group">
			<label for="title" class="control-label">Короткое название: </label>
			<div class="controls">
				<input type="text" class="span3 input-valid" name="title" value="<?=set_value('title');?>">
				<span class="help-inline" style="display:none;">&nbsp;</span>
			</div>
		</div>
		<div class="control-group">
			<label for="grn " class="control-label">ГРН: </label>
			<div class="controls">
				<input type="text" class="span3 input-valid" name="grn" value="<?=set_value('grn');?>">
				<span class="help-inline" style="display:none;">&nbsp;</span>
			</div>
		</div>
		<div class="control-group">
			<label for="inn " class="control-label">ИНН: </label>
			<div class="controls">
				<input type="text" class="span3 input-valid" name="inn" value="<?=set_value('inn');?>">
				<span class="help-inline" style="display:none;">&nbsp;</span>
			</div>
		</div>
		<div class="control-group">
			<label for="number " class="control-label">Номер допуска: </label>
			<div class="controls">
				<input type="text" class="span3 input-valid" name="number" value="<?=set_value('number');?>">
				<span class="help-inline" style="display:none;">&nbsp;</span>
			</div>
		</div>
		<div class="control-group">
			<label for="address " class="control-label">Адрес: </label>
			<div class="controls">
				<textarea class="span5 input-valid" name="address"><?=set_value('address');?></textarea>
				<span class="help-inline" style="display:none;">&nbsp;</span>
			</div>
		</div>
		<div class="control-group">
			<label for="email" class="control-label">Email: </label>
			<div class="controls">
				<input type="text" class="span3 input-valid" name="email" value="<?=set_value('email');?>">
				<span class="help-inline" style="display:none;">&nbsp;</span>
			</div>
		</div>
		<div class="control-group">
			<label for="phones " class="control-label">Телефон: </label>
			<div class="controls">
				<input type="text" class="span3" name="phones" value="<?=set_value('phones');?>">
				<span class="help-inline" style="display:none;">&nbsp;</span>
			</div>
		</div>
		<div class="control-group">
			<label for="login " class="control-label">Логин: </label>
			<div class="controls">
				<input type="text" class="span3 input-valid " name="login" value="<?=set_value('login');?>">
				<span class="help-inline" style="display:none;">&nbsp;</span>
			</div>
		</div>
		<div class="control-group">
			<label for="content" class="control-label">Пароль: </label>
			<div class="controls">
				<input type="text" class="span3 input-valid" name="password" value="1123">
				<span class="help-inline" style="display:none;">&nbsp;</span>
			</div>
		</div>
	</fieldset>
	<div class="form-actions">
		<button class="btn btn-success" type="submit" id="send" name="submit" value="send">Добавить</button>
		<button class="btn btn-inverse backpath" type="button">Отменить</button>
	</div>
<?= form_close(); ?>