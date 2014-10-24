<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<?php $this->load->view("users_interface/includes/head");?>
<body>
	<div class="bg_hed_line"></div>
	<div id="wrapper">
	<?php $this->load->view("users_interface/includes/header");?>
		<div id="middle">
			<div id="container">
				<div id="content">
					<h1>Реестр членов саморегулируемой организаций в области энергетического обследования СРО НП «Энергоаудит»</h1>
					<table class="table table-bordered table-condensed table-hover table-striped">
						<thead>
							<tr>
								<th>№ в реестре</th>
								<th>Статус допуска</th>
								<th>Организационно-правовая форма и полное наименование организации</th>
								<th>Государственный регистрационный номер</th>
								<th>Идентификационный номер налогоплательщика</th>
								<th>Место нахождения</th>
								<th>Номер допуска</th>
							</tr>
						</thead>
						<tbody>
						<?php for($i=0;$i<count($register);$i++):?>
							<tr<?=($register[$i]['status'] == 'действует')?'':' class="not-active"'?>>
								<td><?=$register[$i]['id'];?></td>
								<td><?=$register[$i]['status'];?></td>
								<td><?=$register[$i]['organization'];?></td>
								<td><?=$register[$i]['grn'];?></td>
								<td><?=$register[$i]['inn'];?></td>
								<td><?=$register[$i]['address'];?></td>
								<td><?=$register[$i]['number'];?></td>
							</tr>
						<?php endfor;?>
						</tbody>
					</table>
				<?php if($pages): ?>
					<?=$pages;?>
				<?php endif;?>
				<div class="cf"> </div>
				</div>
			</div>
			<?php $this->load->view("users_interface/includes/sidebar");?>
		</div>
		<?php $this->load->view("users_interface/includes/footer");?>
	</div>
	<?php $this->load->view("users_interface/includes/scripts");?>
	<script type="text/javascript">
		$(document).ready(function(){
			$(".ShowFullText").click(function(){
				$(".FullText").hide();var news = $(this).attr("data-news");
				$(".ShowFullText").show();
				$(".FullText[data-news='news"+news+"']").show();$(this).hide();
			});
			
			$(".HideFullText").click(function(){$(".FullText").hide();$(".ShowFullText").show();});
		});
	</script>
</body>
</html>