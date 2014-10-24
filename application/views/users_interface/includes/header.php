<div id="header">
	<div class="top">
		<ul class="globalnav">
			<li><?=anchor('','СРО НП «Энергоаудит»',array('class'=>'globalnav__active'));?></li>
			<li><?=anchor('documents','Документы');?></li>
			<li><?=anchor('register-members','Реестр членов');?></li>
			<li><?=anchor('register-passports','Реестр Энергопаспортов',array('title'=>'Обучение'));?></li>
			<li><?=anchor('forum','Вопрос &ndash; ответ',array('title'=>'Задайте вопрос энергоаудитору'));?></li>
		</ul>
		<ul class="assorted">
			<li><?=anchor('contacts','Посмотреть на карте');?></li>
			<li><a href="mailto:sro61@mail.ru"><img src="<?=$baseurl;?>images/mail.png" /></a></li>
			<?php if(!$this->loginstatus):?>
				<li><?=anchor('','Вход для членов СРО',array('id'=>'action-enter','class'=>'none globalnav__сolored'));?></li>
			<?php else:?>
				<?php if($this->user['admin']):?>
				<li><?=anchor('admin-panel/actions/orders','Личный кабинет',array('id'=>'action-cabinet','class'=>'globalnav__сolored'));?></li>
				<?php else:?>
				<li><?=anchor('cabinet/orders','Личный кабинет',array('id'=>'action-cabinet','class'=>'globalnav__сolored'));?></li>
				<?php endif;?>
			<?php endif;?>
		</ul>
	</div>
	<div class="header__flag"></div>
	<div class="logo">
		<?=anchor('','<img src="'.$baseurl.'images/logo.png" title="" alt="" width="220" style="padding-top:25px;" />');?>
	</div>
	<div class="hed_text_center">
		<div class="info_hed">
			<div class="column">
				<span class="h_6">Мы находимся по адресу:</span><br/>
				344006, г. Ростов-на-Дону, пр. Ворошиловский, 2/2, офис 916<br/><br/>
				<span class="h_6">Контактные телефоны:</span><br/>
				(863) 296-20-92, 8 (950) 862-63-02
			</div>
			<div class="column">
				<span class="h_6">Факс:</span><br/>
				(863) 236-53-53 <br/><br/>
				<span class="h_6">Электронная почта:</span><br/>
				<?=safe_mailto('sro61@mail.ru','sro61@mail.ru');?>
			</div>
			<div class="column">
				<ul class="actions">
					<li><?=anchor('','Оформить заявку <span class="small">на проведение энергоаудита</span>',array('id'=>'action-order','class'=>'none'));?></li>
				</ul>
			</div>
		</div>
	</div>
</div>
<div class="popup become-enter">
	<?=form_open('login',array('id'=>'form-enter','class'=>'popup-form')); ?>
		<em></em>
		<fieldset>
			<label for="feedback-name">Логин <span>*</span></label>
			<input type="text" class="valid-required FieldSend" name="login" id="feedback-login">
		</fieldset>
		<fieldset>
			<label for="feedback-mail">Пароль <span>*</span></label>
			<input type="password" class="valid-required FieldSend" name="password" id="feedback-password">
		</fieldset>
		<fieldset class="submit">
			<button type="submit" name="enter" value="send" id="EnterSend">Войти</button>
		</fieldset>
	<?= form_close(); ?>
</div>
<div class="popup become-order">
	<?=form_open('',array('id'=>'form-order','class'=>'popup-form')); ?>
		<fieldset>
			<label for="feedback-name">Ваше имя <span>*</span></label>
			<input type="text" class="valid-required FieldSend" name="name" id="feedback-name">
		</fieldset>
		<fieldset>
			<label for="feedback-mail">Эл. почта <span>*</span></label>
			<input type="text" class="valid-required valid-email FieldSend" name="email" id="feedback-mail">
		</fieldset>
		<fieldset>
			<label for="feedback-phone">Телефон <span>*</span></label>
			<input type="text" class="valid-required valid-phone FieldSend" name="phone" id="feedback-phone">
		</fieldset>
		<fieldset>
			<label for="feedback-phone">Адрес объекта <span>*</span></label>
			<input type="text" class="valid-required FieldSend" name="address" id="feedback-address">
		</fieldset>
		<fieldset>
			<label for="feedback-message">Ваше сообщение</label>
			<textarea class="FieldSend" name="message" id="feedback-message"></textarea>
		</fieldset>
		<fieldset class="submit">
			<button type="submit" name="order" value="send" id="OrderSend">Отправить</button>
			<em>Сообщение отправлено!</em>
		</fieldset>
	<?= form_close(); ?>
</div>