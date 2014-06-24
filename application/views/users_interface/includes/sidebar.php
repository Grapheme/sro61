<div class="sidebar" id="sideLeft">
	<ul>
		<li><?=anchor('','Главная',array('title'=>'Главная'));?></li>
		<li><?=anchor('news','Новости',array('title'=>'Новости'));?></li>
		<li><?=anchor('documents-for-entry','Документы для вступления',array('title'=>'Документы для вступления'));?></li>
		<li><?=anchor('legislation','Законодательство',array('title'=>'Законодательство'));?></li>
		<li><?=anchor('education','Обучение',array('title'=>'Обучение'));?></li>
		<li><?=anchor('builders-and-designers','Строителям и проектировщикам',array('title'=>'Строителям и проектировщикам'));?></li>
		<li><?=anchor('equipment-rental','Аренда оборудования',array('title'=>'Аренда оборудования'));?></li>
		<li><?=anchor('media-about-us','СМИ О НАС',array('title'=>'СМИ О НАС'));?></li>
		<li><?=anchor('order-of-audit','Порядок проведения энергоаудита',array('title'=>'Проведение энергоаудита'));?></li>
		<li><?=anchor('expertise-energy-performance','Экспертиза энергопаспорта',array('title'=>'Экспертиза энергопаспорта'));?></li>
		<li><?=anchor('methodological-materials','Методические материалы',array('title'=>'Методические материалы'));?></li>
		<!-- <li><?=anchor('regional-representative','Региональные представительства',array('title'=>'Региональные представительства'));?></li>-->
		<li><?=anchor('standards-and-regulations','Стандарты и правила',array('title'=>'Стандарты и правила'));?></li>
		<li><a href="http://rosenergo.gov.ru/arm/sro/" title="АРМ Энергопаспорт (Минэнерго)" target="_blank">АРМ Энергопаспорт (Минэнерго)</a></li>
		<li><?=anchor('treatment-of-members','Обращения членов',array('title'=>'Обращения членов'));?></li>
		<li><?=anchor('energosmeta','Энергосмета',array('title'=>'Сметный расчет'));?></li>
		<li><?=anchor('contacts','Контакты',array('title'=>'Контакты'));?></li>
	</ul>
	<?php if(isset($news)):?>
	<div class="news_bar">
		<span class="news_hed h2"><?=anchor('news','Новости');?></span>
	<?php for($i=0;$i<count($news);$i++):?>
		<span class="news_date"><?=$news[$i]['date'];?></span>
		<?=anchor('news#'.$news[$i]['translit'],$news[$i]['title'],array('class'=>'a_news'));?>
	<?php endfor;?>
	</div>
	<?php endif;?>
	<a class="banner-link" href="http://pce34.ru" target="_blank" title="ООО Поволжский центр энергоэффективности">
		<img src="<?=$baseurl;?>img/partners_pce34.jpg" alt="ООО Поволжский центр энергоэффективности" width="220">
	</a>
	<br>
	<a class="banner-link" href="http://energy-sfedu.com" target="_blank" title="Южный Федеральный Университет">
		<img src="<?=$baseurl;?>img/partners_sfedu.jpg" alt="Южный Федеральный Университет" width="220">
	</a>
	<br>

	<!--
	<a class="banner-link" href="http://energoauditsro.ru/onlinecalculator" target="_blank"><img src="<?=$baseurl;?>images/calc31.jpg" width="220"></a><br>
	<a class="banner-link" href="http://energoauditsro.ru/?id=598" target="_blank"><img src="<?=$baseurl;?>images/popr.jpg" width="220"></a><br>
	-->
</div>