<!DOCTYPE html>
<html lang="en">
<?php $this->load->view("admin_interface/includes/head");?>
<body>
	<?php $this->load->view("admin_interface/includes/header");?>
	<div class="container">
		<div class="row">
			<div class="span9">
				<ul class="breadcrumb" style="height:30px;">
					<li class="active">
						<?=anchor($this->uri->uri_string(),"Новости");?>
					</li>
					<li style="float:right;">
						<?=anchor('admin-panel/actions/news/add','<nobr><i class="icon-plus icon-white"></i> Добавить</nobr>',array('class'=>'btn btn-info'));?>
					</li>
				</ul>
				<?php $this->load->view("alert_messages/alert-error");?>
				<?php $this->load->view("alert_messages/alert-success");?>
				<table class="table table-striped table-bordered">
					<thead>
						<tr>
							<th class="w85">Дата</th>
							<th class="w600">Содержание</th>
							<th class="w50">&nbsp;</th>
						</tr>
					</thead>
					<tbody>
					<?php for($i=0;$i<count($news);$i++):?>
						<tr class="align-center">
							<td><nobr><?=$news[$i]['date'];?></nobr></td>
							<td>
								<p>
									<strong><?=$news[$i]['small_title'];?></strong> <br />
									<?=$news[$i]['small_text'];?>
								</p>
							</td>
							<td>
								<div id="params<?=$i;?>" style="display:none" data-nid="<?=$news[$i]['id'];?>"></div>
								<?=anchor('admin-panel/actions/news/edit/id/'.$news[$i]['id'],'<i class="icon-pencil"></i>',array('title'=>'Редактировать', 'class'=>'btn'));?>
								<div style="height:3px;">&nbsp;</div>
								<a class="deleteNews btn" data-param="<?=$i;?>" data-toggle="modal" href="#deleteNews" title="Удалить"><i class="icon-trash"></i></a>
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
		<?php $this->load->view("admin_interface/modal/delete-news");?>
		</div>
	</div>
	<?php $this->load->view("admin_interface/includes/scripts");?>
	<script type="text/javascript">
		$(document).ready(function(){
			var nID = 0;
			$(".deleteNews").click(function(){var Param = $(this).attr('data-param'); nID = $("div[id = params"+Param+"]").attr("data-nid");});
			$("#DelNews").click(function(){location.href='<?=$baseurl;?>admin-panel/actions/news/delete/id/'+nID;});
		});
	</script>
</body>
</html>
