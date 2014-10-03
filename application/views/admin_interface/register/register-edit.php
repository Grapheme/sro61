<!DOCTYPE html>
<html lang="en">
<?php $this->load->view("admin_interface/includes/head");?>
<body>
	<?php $this->load->view("admin_interface/includes/header");?>
	<div class="container">
		<div class="row">
			<div class="span9">
				<ul class="breadcrumb">
					<li>
						<?=anchor('',"Реестр паспортов",array('class'=>'none backpath'));?><span class="divider">/</span>
					</li>
					<li class="active">
						Редактирование
					</li>
				</ul>
				<?php $this->load->view("alert_messages/alert-error");?>
				<?php $this->load->view("alert_messages/alert-success");?>
				<?php $this->load->view("forms/frmeditregister");?>
			</div>
		<?php $this->load->view("admin_interface/includes/rightbar");?>
		</div>
	</div>
	<?php $this->load->view("admin_interface/includes/scripts");?>
	<script type="text/javascript">
		$(document).ready(function(){
			$("#SetOrganization").val(<?=$passport['organization']?>);
			$("#SetExpert").val(<?=$passport['expert']?>);
		});
	</script>
</body>
</html>