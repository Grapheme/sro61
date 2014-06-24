<?=form_open_multipart($this->uri->uri_string(),array('id'=>'formAddAnswer'),array('uid'=>$this->user['uid'])); ?>
	<input type="hidden" id="qid" name="qid" value="" />
	<fieldset>
		<textarea class="valid-required" name="text" id="TextAnswer" placeholder="Введите текст ответа"></textarea>
		<span class="help-inline" style="display:none;">&nbsp;</span><br/>
	</fieldset>
	<div class="form-actions">
		<button class="success" type="submit" id="addanswer" name="asubmit" value="send">Ответить</button>
		<button class="" id="AbortAnswer" type="button">Отменить</button>
	</div>
<?= form_close(); ?>