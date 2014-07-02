<!DOCTYPE html>
<html lang="en">
<?php $this->load->view('admin_interface/includes/head');?>
<body>
	<style type="text/css">
		@media print {
			body, p { color: #333; padding: 0; margin: 0; } 
			body { padding-left: 40px; }
		}
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
						<span>пр. Ворошиловский, 2/2, оф. 916</span><br/>
						<span>Телефон: (863) 296-20-92, Факс: (863) 236-53-53</span><br/>
						<span>e-mail: <?=safe_mailto('sro61@mail.ru','sro61@mail.ru');?>, www: <?=anchor('http://sro61.ru/','http://sro61.ru');?></span><br/>
						<span>Рег. № СРО-Э-101</span><br/><br/>
						<span>Исх. №_______ от __________________</span>
						
					</p>
				</div>
				<div class="span5" style="margin-left: 30px;">
					<p class="center title">
						<br/><br/><br/><br/><br/><br/><br/><br/><br/><br/>
						<strong><?=$passport['member'];?></strong>
						
					</p>
				</div>
				<div class="clear"></div>
			</div>
		</div>
		<div class="row">
			<div class="span12">
				<p>&nbsp;</p><p>&nbsp;</p>
				<p class="center title">
					<strong>УВЕДОМЛЕНИЕ</strong>
				</p>
				<p class="intend main">
					Настоящим подтверждаем принятие и регистрацию энергетического паспорта,  
					составленного по результатам энергетического обследования объекта: <?=$passport['customer'];?> 
					(ИНН <?=$passport['inn'];?>), расположенного по адресу: <?=$passport['address'];?>, 
					в соответствии с требованиями законодательства РФ, регистрационный № <?=$passport['number'];?>.
				</p>
				<p>&nbsp;</p><p>&nbsp;</p><p>&nbsp;</p>
				<p>&nbsp;</p><p>&nbsp;</p><p>&nbsp;</p>
				<p>&nbsp;</p>
				<p>
					<table class="table no-border times">
						<tbody>
							<tr>
								
<!--								<td width="80%">Директор</td>-->
<!--								<td width="20%" class="sign"><em>Л.К. Евкина</em></td>-->

								<td width="80%">И.о. директора</td>
								<td width="20%" class="sign"><em>А.А. Абдулаева</em></td>
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
