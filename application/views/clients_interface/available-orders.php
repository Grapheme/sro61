<!DOCTYPE html>
<html lang="en">
<?php $this->load->view("clients_interface/includes/head");?>
<body>
	<?php $this->load->view("clients_interface/includes/header");?>
	<div class="container">
		<div class="row">
			<div class="span9">
				<ul class="breadcrumb">
					<li class="active">
						<?=anchor($this->uri->uri_string(),"Доступные заявки");?>
					</li>
				</ul>
				<?php $this->load->view("alert_messages/alert-error");?>
				<?php $this->load->view("alert_messages/alert-success");?>
				<table class="table table-striped table-bordered">
					<thead>
						<tr>
							<th class="w200"><center>Пользователь</center></th>
							<th class="w600"><center>Содержание</center></th>
						</tr>
					</thead>
					<tbody>
					<?php for($i=0;$i<count($orders);$i++):?>
						<tr class="align-center">
							<td>
								<nobr>Заявка от: <?=$orders[$i]['name'];?><br/></nobr>
								<nobr>Email: <?=$orders[$i]['email'];?><br/></nobr>
								<nobr>Телефон: <?=$orders[$i]['phones'];?></nobr>
							</td>
							<td>
								[<?=$orders[$i]['date'];?>]<br/>
								Адрес: <strong><?=$orders[$i]['address'];?></strong><br/>
								Сообщение: <?=$orders[$i]['text'];?>
							</td>
						</tr>
					<?php endfor; ?>
					</tbody>
				</table>
				<?php if($pages): ?>
					<?=$pages;?>
				<?php endif;?>
			</div>
		<?php $this->load->view("clients_interface/includes/rightbar");?>
		</div>
	</div>
	<?php $this->load->view("clients_interface/includes/scripts");?>
</body>
</html>