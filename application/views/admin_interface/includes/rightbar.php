<div class="span3">
	<div class="well sidebar-nav">
		<ul class="nav nav-pills nav-stacked">
			<li num="orders"><?=anchor('admin-panel/actions/orders','Доступные заявки');?></li>
			<li num="users"><?=anchor('admin-panel/actions/users','Пользователи');?></li>
			<li num="register"><?=anchor('admin-panel/actions/register','Реестр паспортов');?></li>
			<li num="return-register"><?=anchor('admin-panel/actions/return-register','Возврат паспортов');?></li>
			<li num="ep-register-me"><?=anchor('admin-panel/actions/ep-register-me','<nobr>ЭП зарегист. МЭ</nobr>');?></li>
			<li num="forum"><?=anchor('admin-panel/actions/forum','Форум');?></li>
			<li num="news"><?=anchor('admin-panel/actions/news','Новости');?></li>
			<li class="nav-header">Действия</li>
			<li><?=anchor('logoff','Завершить сеанс');?></li>
		</ul>
	</div>
</div>