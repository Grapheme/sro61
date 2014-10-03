<?=form_open_multipart($this->uri->uri_string(),array('class'=>'form-horizontal')); ?>
	<legend>Форма редактирования новости</legend>
	<fieldset>
		<div class="control-group">
			<label for="title" class="control-label">Название: </label>
			<div class="controls">
				<input type="text" class="span6 input-valid" name="title" value="<?=$news['title'];?>">
				<span class="help-inline" style="display:none;">&nbsp;</span>
			</div>
		</div>
		<div class="control-group">
			<label for="small_title" class="control-label">Короткое название: </label>
			<div class="controls">
				<input type="text" class="span6 input-valid" name="small_title" value="<?=$news['small_title'];?>">
				<span class="help-inline" style="display:none;">&nbsp;</span>
			</div>
		</div>
		<div class="control-group">
			<label for="text" class="control-label">Содержание: </label>
			<div class="controls">
				<textarea rows="10" class="span6" name="text"><?=$news['text'];?></textarea>
				<span class="help-inline" style="display:none;">&nbsp;</span>
			</div>
		</div>
		<div class="control-group">
			<label for="small_text" class="control-label">Короткое содержание: </label>
			<div class="controls">
				<textarea rows="5" class="span6 input-valid" name="small_text"><?=$news['small_text'];?></textarea>
				<span class="help-inline" style="display:none;">&nbsp;</span>
			</div>
		</div>
		<div class="control-group">
			<label for="image" class="control-label">Изображение: </label>
			<div class="controls">
				<input type="file" class="input-file" name="image" size="50">
				<span class="help-inline" style="display:none;">&nbsp;</span>
				<p class="help-block">Поддерживаются форматы: JPG,PNG,GIF</p>
			</div>
		</div>
		<div class="control-group">
			<label for="showitem" class="control-label">&nbsp;</label>
			<div class="controls">
				<label class="checkbox">
					<input type="checkbox" value="1" id="noimage" name="noimage" <?=($news['noimage'])? 'checked="checked"' : '';?>>
					Не показывать изображение</label>
			</div>
		</div>
	</fieldset>
	<div class="form-actions">
		<button class="btn btn-success" type="submit" id="send" name="submit" value="send">Сохранить</button>
		<button class="btn btn-inverse backpath" type="button">Отменить</button>
	</div>
<?= form_close(); ?>