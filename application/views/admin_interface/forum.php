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
						<?=anchor($this->uri->uri_string(),"Форум");?>
					</li>
				</ul>
				<?php $this->load->view("alert_messages/alert-error");?>
				<?php $this->load->view("alert_messages/alert-success");?>
				
				<div class="accordion" id="accordion2">
				<?php for($i=0;$i<count($questions);$i++):?>
					<?php for($j=0,$kol=0;$j<count($answers);$j++):?>
						<?php if($questions[$i]['id'] == $answers[$j]['question']):?>
							<?php $kol++;?>
						<?php endif;?>
					<?php endfor;?>
					<div class="accordion-group">
						<div class="accordion-heading">
							<?=$questions[$i]['date'];?><br/>
							<?=$questions[$i]['name'];?> [<?=$questions[$i]['email'];?>]<br/>
							<span class="TextField QText" data-question="question<?=$questions[$i]['id'];?>" data-text="<?=$questions[$i]['id'];?>"><?=$questions[$i]['text'];?></span>
							<a href="" class="EditTextBtn editQuestion none" data-question="<?=$questions[$i]['id'];?>">ред.</a>
							<a href="" class="DeleteTextBtn deleteQuestion none" data-question="<?=$questions[$i]['id'];?>">удал.</a>
							<div class="">
							<?php if($kol):?>
								<a class="accordion-toggle" data-toggle="collapse" data-parent="#accordion2" href="#collapse<?=$i?>">
									Ответов: <?=$kol;?> шт.
								</a>
							<?php else:?>
								Нет ответов
							<?php endif;?>
							</div>
						</div>
						<div id="collapse<?=$i?>" class="accordion-body collapse">
							<div class="accordion-inner">
						<?php for($j=0;$j<count($answers);$j++):?>
							<?php if($questions[$i]['id'] == $answers[$j]['question']):?>
								<div class="">
									<span class="TextField AText" data-answer="answer<?=$answers[$j]['id'];?>" data-text="<?=$answers[$j]['id'];?>"><?=$answers[$j]['text'];?></span>
									<a href="" class="EditTextBtn editAnswer none" data-answer="<?=$answers[$j]['id'];?>">ред.</a>
									<a href="" class="DeleteTextBtn deleteAnswer none" data-answer="<?=$answers[$j]['id'];?>">удал.</a>
								</div>
								<div class="">
									<span class=""><?=$answers[$j]['date'];?></span><br/>
									<span class=""><?=$answers[$j]['name'];?></span><br/>
									<span class=""><?=$answers[$j]['email'];?></span>
								</div>
							<?php endif;?>
						<?php endfor;?>
							</div>
						</div>
					</div>
				<?php endfor;?>
				</div>
				<?php if($pages): ?>
					<?=$pages;?>
				<?php endif;?>
				<div class="" id="DivEditText" style="display:none;">
					<textarea class="valid-required" id="EditText" name="text"></textarea><br/>
					<a href="" class="saveEditText none">Сохранить.</a>
					<a href="" class="abortEditText none">Отменить.</a>
				</div>
			</div>
		<?php $this->load->view("admin_interface/includes/rightbar");?>
		</div>
	</div>
	<?php $this->load->view("admin_interface/includes/scripts");?>
	<script type="text/javascript">
		$(document).ready(function(){
			var record= 0; var table = '';
			$(".deleteQuestion").click(function(){
				if(!confirm("Удалить вопрос?")){
					return false;
				}else{
					record = $(this).attr("data-question");
					location.href='<?=$baseurl;?>admin-panel/actions/forum/delete-question/id/'+record;
				};
			});
			$(".deleteAnswer").click(function(){
				if(!confirm("Удалить ответ?")){
					return false;
				}else{
					record = $(this).attr("data-answer");
					location.href='<?=$baseurl;?>admin-panel/actions/forum/delete-answer/id/'+record;
				};
			});
			$(".editQuestion").click(function(){
				table = 'questions';
				$(".TextField").css('color','#333333').show();$(".EditTextBtn").show();$(".DeleteTextBtn").show();
				record = $(this).attr("data-question");
				var text = $(".QText[data-question='question"+record+"']").html();
				$("#EditText").val(text);
				$(this).hide();
				$(".QText[data-question='question"+record+"']").hide();
				$(".deleteQuestion[data-question="+record+"]").hide();
				$("#DivEditText").insertAfter($(this)).show();
			});
			$(".editAnswer").click(function(){
				table = 'answers';
				$(".TextField").css('color','#333333').show();$(".EditTextBtn").show();$(".DeleteTextBtn").show();
				record = $(this).attr("data-answer");
				var text = $(".AText[data-answer='answer"+record+"']").html();
				$("#EditText").val(text);
				$(this).hide();$(".AText[data-answer='answer"+record+"']").hide();
				$(".deleteAnswer[data-answer="+record+"]").hide();
				$("#DivEditText").insertAfter($(this)).show();
			});
			$(".abortEditText").click(function(){
				$(".TextField").show();$(".EditTextBtn").show();$(".DeleteTextBtn").show();$("#DivEditText").hide();
			});
			$(".saveEditText").click(function(){
				var text = $("#EditText").val();
				save_text(text,table,record);
			});
			
			function save_text(content,type,id){
				$.post("<?=$baseurl;?>admin-panel/actions/forum/save-text",{'text':content,'type':type,'id':id},function(data){
					if(data.status){
						if(type == 'questions'){$(".QText[data-text="+id+"]").html(content).css('color','#4B7CB7');
						}else{$(".AText[data-text="+id+"]").html(content).css('color','#4B7CB7');}
					}else{
						if(type == 'questions'){$(".QText[data-text="+id+"]").css('color','#ca3632');
						}else{$(".AText[data-text="+id+"]").css('color','#ca3632');}
					}
					$(".TextField").show();$(".EditTextBtn").show();$("#DivEditText").hide();$(".DeleteTextBtn").show();
				},"json");
			}
		});
	</script>
</body>
</html>