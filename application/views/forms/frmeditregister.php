<?=form_open_multipart($this->uri->uri_string(),array('class'=>'form-horizontal')); ?>
	<legend>Форма добавления паспорта</legend>
	<fieldset>
		<div class="control-group">
			<label for="number" class="control-label">Номер энергопаспорта: </label>
			<div class="controls">
				<input type="text" class="span5 input-valid" name="number" value="<?=$passport['number'];?>">
				<span class="help-inline" style="display:none;">&nbsp;</span>
			</div>
		</div>
		<div class="control-group">
			<label for="expert" class="control-label">Экспертная орган.: </label>
			<div class="controls">
				<select class="span5" name="expert" id="SetExpert">
				<?php for($i=0;$i<count($expert);$i++):?>
					<option value="<?=$expert[$i]['id'];?>"><?=$expert[$i]['title'];?></option>
				<?php endfor;?>	
				</select>
			</div>
		</div>
		<div class="control-group">
			<label for="conclusion" class="control-label">Дата заключения: </label>
			<div class="controls">
				<input type="text" class="input-medium" name="conclusion" value="<?=$passport['conclusion'];?>">
			</div>
		</div>
		<div class="control-group">
			<label for="register" class="control-label">Дата регистрации: </label>
			<div class="controls">
				<input type="text" class="input-medium" name="register" value="<?=$passport['register'];?>">
			</div>
		</div>
		<div class="control-group">
			<label for="survey" class="control-label">Вид обследования: </label>
			<div class="controls">
				<input type="text" class="span5" name="survey" value="<?=$passport['survey'];?>">
			</div>
		</div>
		<div class="control-group">
			<label for="transfer" class="control-label">Дата передачи: </label>
			<div class="controls">
				<input type="text" class="input-medium" name="transfer" value="<?=$passport['transfer'];?>">
			</div>
		</div>
		<div class="control-group">
			<label for="inn" class="control-label">ИНН: </label>
			<div class="controls">
				<input type="text" class="input-medium" name="inn" value="<?=$passport['inn'];?>">
			</div>
			<div class="controls">
				<label class="checkbox"><input type="checkbox" value="1" id="double" name="double" <?=($passport['double'])?'checked="cheacked"':'';?> >По проектной документации</label>
			</div>
			<div class="controls">
				<label class="checkbox"><input type="checkbox" value="1" name="retested" <?=($passport['retested'])?'checked="cheacked"':'';?>><span class="label label-info">Повторное обследование</span></label>
			</div>
		</div>
		<div class="control-group">
			<label for="organization" class="control-label">Член СРО: </label>
			<div class="controls">
				<select class="span5" name="organization" id="SetOrganization">
				<?php for($i=0;$i<count($organization);$i++):?>
					<option value="<?=$organization[$i]['id'];?>"><?=$organization[$i]['title'];?></option>
				<?php endfor;?>
				</select>
			</div>
		</div>
		<div class="control-group">
			<label for="customer" class="control-label">Заказчик: </label>
			<div class="controls">
				<textarea rows="2" class="span5" name="customer"><?=$passport['customer'];?></textarea>
				<span class="help-inline" style="display:none;">&nbsp;</span>
			</div>
		</div>
		<div class="control-group">
			<label for="address" class="control-label">Юридический адрес: </label>
			<div class="controls">
				<textarea rows="2" class="span5" name="address"><?=$passport['address'];?></textarea>
				<span class="help-inline" style="display:none;">&nbsp;</span>
			</div>
		</div>
		<div class="control-group">
			<label for="solution" class="control-label">Решение Минэнерго: </label>
			<div class="controls">
				<textarea rows="2" class="span5" name="solution"><?=$passport['solution'];?></textarea>
				<span class="help-inline" style="display:none;">&nbsp;</span>
			</div>
		</div>
		<div class="control-group">
			<label for="availability" class="control-label">Наличие: </label>
			<div class="controls">
				<textarea rows="2" class="span5" name="availability"><?=$passport['availability'];?></textarea>
				<span class="help-inline" style="display:none;">&nbsp;</span>
			</div>
		</div>
		<div class="control-group">
			<label for="corrections" class="control-label">Направление в Минэнерго после исправления замечаний в случае обнаружения таковых: </label>
			<div class="controls">
				<textarea rows="4" class="span5" name="corrections"><?=$passport['corrections'];?></textarea>
				<span class="help-inline" style="display:none;">&nbsp;</span>
			</div>
		</div>
	</fieldset>
	<div class="form-actions">
		<button class="btn btn-success" type="submit" id="send" name="submit" value="send">Сохранить</button>
		<button class="btn btn-inverse backpath" type="button">Отменить</button>
	</div>
<?= form_close(); ?>