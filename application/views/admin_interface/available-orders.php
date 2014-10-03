<!DOCTYPE html>
<html lang="en">
<?php $this->load->view("admin_interface/includes/head");?>
<body>
	<?php $this->load->view("admin_interface/includes/header");?>
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
							<th class="w200">Пользователь</th>
							<th class="w600">Содержание</th>
							<th class="w50">&nbsp;</th>
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
							<td>
								<div id="params<?=$i;?>" style="display:none" data-nid="<?=$orders[$i]['id'];?>"></div>
							<?php if(!$orders[$i]['closed']):?>
								<?=anchor('admin-panel/actions/orders/closed/id/'.$orders[$i]['id'],'<i class="icon-white icon-remove"></i>',array('class'=>'btn btn-info OrderClose','title'=>'Закрыть заявку'));?>
							<?php else:?>
								<?=anchor('','<i class="icon-white icon-ok"></i>',array('class'=>'btn btn-success none disabled','title'=>'Заявка закрыта'));?>
							<?php endif;?>
								<div style="height:3px;">&nbsp;</div>
								<a class="deleteOrder btn btn-danger" data-param="<?=$i;?>" data-toggle="modal" href="#deleteOrder" title="Удалить"><i class="icon-white icon-trash"></i></a>
							</td>
						</tr>
					<?php endfor; ?>
					</tbody>
				</table>
				<?php if($pages): ?>
					<?=$pages;?>
				<?php endif;?>
			</div>
		<?php $this->load->view("admin_interface/includes/rightbar");?>
		<?php $this->load->view("admin_interface/modal/delete-order");?>
		</div>
	</div>
	<?php $this->load->view("admin_interface/includes/scripts");?>
	<script type="text/javascript">
		$(document).ready(function(){
			var nID = 0;
			$(".OrderClose").click(function(){if(!confirm("Закрыть заявку")){return false;}})
			$(".deleteOrder").click(function(){var Param = $(this).attr('data-param'); nID = $("div[id = params"+Param+"]").attr("data-nid");});
			$("#DelOrder").click(function(){location.href='<?=$baseurl;?>admin-panel/actions/orders/delete/id/'+nID;});
		});
	</script>
</body>
</html>