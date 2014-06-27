<!DOCTYPE html>
<html lang="en">
<?php $this->load->view('admin_interface/includes/head');?>
<body>
	<style type="text/css">
		body { padding: 0; margin: 0; }
		ol li { font-size: 22px; line-height: 1.2em; font-family: 'Times New Roman', Times, serif; }
		body { padding-left: 40px; }
		color: #000;
	</style>
	<div class="container-fluid" style="position: relative; ">
		<div class="row">
			<div class="span12">
				<div class="grif large">
					<p class="center title colored">
						<img src="<?=$baseurl;?>images/print-logo.png" alt="" width="220" style="margin-bottom: 6px;"/><br/>
						<span>Саморегулируемая организация</span><br/>
						<span>некоммерческое партнерство</span><br/>
						<span>«Энергоаудит»</span><br/>
						<span>344006, г. Ростов-на-Дону,</span><br/>
						<span> пр. Ворошиловский, 2/2, оф. 916</span><br/>
						<span>Телефон: (863) 296-20-92, Факс: (863) 236-53-53</span><br/>
						<span>e-mail: <?=safe_mailto('sro61@mail.ru','sro61@mail.ru');?>, www: <?=anchor('http://sro61.ru/','http://sro61.ru');?></span><br/>
						<span>Рег. № СРО-Э-101</span><br/><br/>
						<span>Исх. №_______ от __________________</span>
						
					</p>
				</div>
				<div class="span5" style="margin-left: 75px;">
					<p class="title smaller">
						<br/><br/><br/><br/>
						<br/><br/>
						<strong>Департаменту энергоэффективности</strong><br/>
						<strong>модернизации и развития ТЭК</strong><br/>
						<strong>Минэнерго России</strong><br/>
					</p>
				</div>
				<div class="clear"></div>
			</div>
	</div>
	<div class="row">
		<div class="span12">
				<p>&nbsp;</p>
				<p class="intend main">
					Саморегулируемая организация некоммерческое партнерство «Энергоаудит» (регистрационный номер 
					<nobr>СРО-Э-101</nobr> от <nobr>07 июля 2011 года</nobr>) 
					просит Вас принять для регистрации энергетический паспорт 
					<nobr>№ <?=$passport['number'];?></nobr>, составленный на организацию - <?=$passport['customer'];?> (ИНН <?=$passport['inn'];?>), 
					расположенную по адресу: <?=$passport['address'];?>, членом Партнерства - <?=$passport['member'];?>.
				</p>
				<p class="intend main">
					Основанием для проведения обязательного энергетического обследования является:<br/>
					<ol>
						<li>Федеральный Закон от 23 ноября 2009 года № 261-ФЗ;</li>
						<li>Постановление Правительства Российской Федерации от 25 января 2011 года № 19;</li>
						<li>Приказ Минэнерго России от 19 апреля 2010 года № 182.</li>
					</ol>
				</p>
				<p>&nbsp;</p>
				<table class="table no-border">
					<tr>
						<td style="padding-top: 16px;">
							<p class="intend main">Приложения:</p>			
						</td>
						<td>
							<p class="intend main">
								<ol>
									<li>Энергетический паспорт объекта на бумажном носителе.</li>
									<li>CD диск, содержащий электронные копии энергетических паспортов в формате PDF и XML.</li>
								</ol>
							</p>			
						</td>
					</tr>
				</table>
				<p>&nbsp;</p><p>&nbsp;</p>
				<p>&nbsp;</p><p>&nbsp;</p>
				<p>
					<table class="table no-border times">
						<tbody>
							<tr>
								<td width="78%">С уважением,<br/>Директор</td>
							<!--<td width="78%">С уважением,<br/>И.о. директора</td> -->
							<td width="22%" class="sign padding"><em>Л.К. Евкина</em></td>
							<!--<td width="22%" class="sign padding"><em>А.А. Абдулаева</em></td>-->
							</tr>
						</tbody>
					</table>
				</p>
			</div>
		</div>
	</div>
	<script type="text/javascript">
		window.onload = function(){
			setTimeout(function() { window.print(); }, 1000);
		};
	</script>
</body>
</html>
