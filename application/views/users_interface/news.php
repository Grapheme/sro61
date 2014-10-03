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
					<h1>Новости</h1>
				<?php for($i=0;$i<count($allnews);$i++):?>
					<a name="<?=$allnews[$i]['translit'];?>"></a>
					<h2><?=$allnews[$i]['title'];?> <span class="news-date"><?=$allnews[$i]['date'];?></span></h2>
					<p><?=$allnews[$i]['small_text'];?></p>
					<?php if(strlen($allnews[$i]['text']) > 5):?>
						<a href="" class="ShowFullText none" data-news="<?=$allnews[$i]['id'];?>">Читать полностью</a>
						<div class="FullText" data-news="news<?=$allnews[$i]['id'];?>" style="display:none;">
							<p><?=$allnews[$i]['text'];?></p>
							<a href="" class="HideFullText none" data-news="<?=$allnews[$i]['id'];?>">Скрыть текст</a>
						</div>
					<?php endif; ?>
					<div class="sep"> </div>
				<?php endfor;?>
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