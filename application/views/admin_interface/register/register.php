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
						<?=anchor($this->uri->uri_string(),"Реестр паспортов");?>
					</li>
					<li style="float:right;">
						<?=anchor('admin-panel/actions/register/add','<nobr><i class="icon-plus icon-white"></i> Добавить</nobr>',array('class'=>'btn btn-info'));?>
					<?php if($this->session->userdata('query_string')):?>
						<?=anchor('admin-panel/actions/register/all-list','<i class="icon-list-alt icon-white"></i> Весь список',array('class'=>'btn btn-info'))?>
					<?php else:?>
						<a class="btn btn-info" data-toggle="modal" href="#getDocument" id="getDoc"><i class="icon-download-alt icon-white"></i> Экспорт в CSV</a>
					<?php endif;?>
						<a class="btn btn-primary FormSearch"><i class="icon-search icon-white"></i> Поиск паспорта</a>
					</li>
				</ul>
				<?php $this->load->view("alert_messages/alert-error");?>
				<?php $this->load->view("alert_messages/alert-success");?>
				<div style="display: none;" id="divFormSearch">
				<?=form_open($this->uri->uri_string(),array('class'=>'form-inline')); ?>
					<h4>Поиск энергопаспортов</h4>
					<div style="margin:5px 0;">
						<span class="badge">1</span>&nbsp;<input type="text" class="span3 search-query digital" id="srInn" name="srinn" value="" autocomplete="off" placeholder="Поиск по ИНН">
					</div>
					<div class="clear"></div>
					<div style="margin:5px 0;">
						<input type="hidden" id="sroid" name="sroid" value="">
						<span class="badge badge-warning">2</span>&nbsp;<input type="text" class="span8 search-query SrName" data-hidden="sroid" data-field="organization" name="srorgvalue" value="" autocomplete="off" placeholder="Поиск по членам СРО (от 3-х символов)">
						<div class="suggestionsBox" id="DivSuggestorganization" style="display: none;"> <img src="<?=$baseurl;?>images/arrow.png" style="position: relative; top: -15px; left: 50px;" alt="upArrow" />
							<div class="suggestionList" id="suggestorganization"> &nbsp; </div>
						</div>
					</div>
					<div class="clear"></div>
					<div style="margin:5px 0;">
						<input type="hidden" id="srcid" name="srcid" value="">
						<span class="badge badge-success">3</span>&nbsp;<input type="text" class="span8 search-query SrName" data-hidden="srcid" data-field="customer" name="srcusvalue" value="" autocomplete="off" placeholder="Поиск по заказчикам (от 3-х символов)">
						<div class="suggestionsBox" id="DivSuggestcustomer" style="display: none;"> <img src="<?=$baseurl;?>images/arrow.png" style="position: relative; top: -15px; left: 50px;" alt="upArrow" />
							<div class="suggestionList" id="suggestcustomer"> &nbsp; </div>
						</div>
					</div>
					<div class="clear"></div>
					<label class="checkbox" style="margin-left:35px;">
						<input type="checkbox" id="chExpert" name="expert" value="1" checked="checked">Наличие экспертной оценки
					</label>
					<div class="clear"></div>
					<div style="margin-top:15px;">
						<span class="label label-info">
							Заполните необходимые поля и нажмите "Поиск". Если в списке нет нужного варианта - измените условие поиска.
							<!--Номера 1..3 - порядок приоритета для поиска.-->
						</span><br/>
					</div>
					<div class="clear"></div>
					<div class="form-actions">
						<button type="submit" class="btn btn-info" id="seacrh" name="scsubmit" value="seacrh">&nbsp;&nbsp;Поиск&nbsp;&nbsp;</button>
						<button class="btn FormSearch">Отмена</button>
					</div>
					<?= form_close(); ?>
				</div>
				<table class="table table-striped table-bordered">
					<thead>
						<tr>
							<th class="w100">Номер</th>
							<th class="w85">Дата закл.<br/>регистр.</th>
							<th class="w300">Заказчик</th>
							<th class="w85">&nbsp;</th>
						</tr>
					</thead>
					<tbody>
					<?php for($i=0;$i<count($register);$i++):?>
						<tr class="align-center">
							<td><nobr><?=$register[$i]['number'];?></nobr></td>
							<td><?=$register[$i]['conclusion'];?><br/><?=$register[$i]['register'];?></nobr></td>
							<td><?=$register[$i]['customer'];?></td>
							<td>
								<div id="params<?=$i;?>" style="display:none" data-rid="<?=$register[$i]['id'];?>"></div>
								<?=anchor('admin-panel/actions/register/edit/id/'.$register[$i]['id'],'<i class="icon-white icon-pencil"></i>',array('class'=>'btn btn-info','title'=>'Редактировать'));?>
								<a class="deleteRegister btn btn-danger" data-param="<?=$i;?>" data-toggle="modal" href="#deleteRegister" title="Удалить"><i class="icon-white icon-trash"></i></a>
								<div style="height:3px;">&nbsp;</div>
								<?=anchor('admin-panel/actions/register/print/id/'.$register[$i]['id'].'/covering-letter','<i class="icon-print"></i>',array('class'=>'printRegister btn','target'=>'_blank','title'=>'Печать сопроводительного листа'));?>
								<?=anchor('admin-panel/actions/register/print/id/'.$register[$i]['id'].'/sample-notice','<i class="icon-print"></i>',array('class'=>'printRegister btn','target'=>'_blank','title'=>'Печать уведомления'));?>
								<?=anchor('admin-panel/actions/register/print/id/'.$register[$i]['id'].'/covering-letter-pdf','<i class="icon-download-alt"></i>',array('class'=>'printRegister btn','title'=>'Загрузить сопроводительное письмо'));?>
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
		<?php $this->load->view("admin_interface/modal/delete-register");?>
		<?php $this->load->view('admin_interface/modal/import-csv');?>
		</div>
	</div>
	<?php $this->load->view("admin_interface/includes/scripts");?>
	<script type="text/javascript">
		$(document).ready(function(){
			var rID = 0;
			$(".deleteRegister").click(function(){var Param = $(this).attr('data-param'); rID = $("div[id = params"+Param+"]").attr("data-rid");});
			$("#DelRegister").click(function(){location.href='<?=$baseurl;?>admin-panel/actions/register/delete/id/'+rID;});
			
			function suggest(textObj,hidObj,suggest){
				
				var inputString = $(textObj).val();
				if(inputString.length < 3){
					$(".suggestionsBox").fadeOut();
				}else{
					$(textObj).addClass('load');
					$.post("<?=$baseurl;?>admin-panel/actions/register/search",{squery: ""+inputString+"",searchfield: ""+suggest+""},
						function(data){
							if(data.status){
								$("#DivSuggest"+suggest).fadeIn();
								$("#suggest"+suggest).html(data.retvalue);
								$(".resli").live('click',function(){fill(hidObj,textObj,$(this).html(),$(this).attr("data-resid"));});
							}else{
								$('.suggestionsBox').fadeOut();
							};
							$(textObj).removeClass('load');
					},"json");
				}
			};
			
			function fill(hidObj,textObj,html,valueid){
				$(textObj).val(html);$(hidObj).val(valueid);
				setTimeout("$('.suggestionsBox').fadeOut();$('.resli').die('click');$('.suggestionList').html('');", 600);
			};
			$("#download").click(function(event){window.open("<?=$baseurl;?>admin-panel/actions/register/import-csv");event.preventDefault();});
			$(".SrName").keyup(function(){
				var hidObj = $("#"+$(this).attr('data-hidden'));
				$(hidObj).val('');
				suggest($(this),hidObj,$(this).attr('data-field'));
			});
			$(".SrName").focusout(function(){setTimeout("$('.suggestionsBox').fadeOut();",600);});
			
			
			$(".FormSearch").click(function(){$("#divFormSearch").toggle(); return false;});
		});
	</script>
</body>
</html>