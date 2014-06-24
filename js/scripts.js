/*  Author: Grapheme Group
 *  http://grapheme.ru/
 */
 
function isValidEmailAddress(emailAddress){
	var pattern = new RegExp(/^(("[\w-\s]+")|([\w-]+(?:\.[\w-]+)*)|("[\w-\s]+")([\w-]+(?:\.[\w-]+)*))(@((?:[\w-]+\.)*\w[\w-]{0,66})\.([a-z]{2,6}(?:\.[a-z]{2})?)$)|(@\[?((25[0-5]\.|2[0-4][0-9]\.|1[0-9]{2}\.|[0-9]{1,2}\.))((25[0-5]|2[0-4][0-9]|1[0-9]{2}|[0-9]{1,2})\.){2}(25[0-5]|2[0-4][0-9]|1[0-9]{2}|[0-9]{1,2})\]?$)/i);
	return pattern.test(emailAddress);
};

function isValidPhone(phoneNumber){
	var pattern = new RegExp(/^((8|\+7)[\- ]?)?(\(?\d{3}\)?[\- ]?)?[\d\- ]{7,10}$/i);
	return pattern.test(phoneNumber);
};

function myserialize(objects){
	var data = '';
	$(objects).each(function(i,element){
		if(data === ''){
			data = $(element).attr('name')+"="+$(element).val();
		}else{
			data = data+"&"+$(element).attr('name')+"="+$(element).val();
		}
	});
	return data;
};

function backpath(path){window.location=path;}

(function($){
	var baseurl = "http://sro61.ru/";
	$("#msgeclose").click(function(){$("#msgdealert").fadeOut(1000,function(){$(this).remove();});});
	$("#msgsclose").click(function(){$("#msgdsalert").fadeOut(1000,function(){$(this).remove();});});
	$(".digital").keypress(function(e){if(e.which!=8 && e.which!=46 && e.which!=0 && (e.which<48 || e.which>57)){return false;}});
	$(".negative").keypress(function(e){if(e.which!=8 && e.which!=46 && e.which!=0 && e.which!=45 && (e.which<48 || e.which>57)){return false;}});
	$(".none").click(function(event){event.preventDefault();});
	$("a.articles").click(function(events){events.preventDefault();$("div.articles-wrapper").toggle();$(this).hide();});
	
	$("#send").click(function(event){
		var err = false;$(".control-group").removeClass('error');$(".help-inline").hide();
		$(".input-valid").each(function(i,element){if($(this).val()==''){$(this).parents(".control-group").addClass('error');$(this).siblings(".help-inline").html("Поле не может быть пустым").show();err = true;}});if(err){event.preventDefault();}
	});
	
	$("#OrderSend").click(function(event){
		var err = false;
		event.preventDefault();
		$(".become-order fieldset").removeClass("validate");
		$(".become-order .valid-required").each(function(i,element){if($(this).val()==''){$(this).parents("fieldset").addClass('validate');err = true;}});
		if(!err && !isValidEmailAddress($(".become-order .valid-email").val())){$(".become-order .valid-email").parents("fieldset").addClass('validate');err = true;}
		if(!err && !isValidPhone($(".become-order .valid-phone").val())){$(".become-order .valid-phone").parents("fieldset").addClass('validate');err = true;}
		if(!err){var postdata = myserialize($(".become-order .FieldSend"));
			$.post(baseurl+"send-order",{'postdata':postdata},
			function(data){if(data.status){$(".become-order em").show();$(".become-order .submit").addClass("submitted");}else{$(".become-order em").html(data.message).show();}},"json");
		}
	});
	
	$("#EnterSend").click(function(event){
		var err = false;
		$(".become-enter em").hide();
		event.preventDefault();
		$(".become-enter fieldset").removeClass("validate");
		$(".become-enter .valid-required").each(function(i,element){if($(this).val()==''){$(this).parents("fieldset").addClass('validate');err = true;}});
		if(!err){
			var postdata = myserialize($(".become-enter .FieldSend"));
			$.post(baseurl+"login",{'postdata':postdata},function(data){if(data.status){$(".become-enter").remove();$("#action-enter").replaceWith(data.newlink);
			}else{$(".become-enter .FieldSend").parents("fieldset").addClass('validate');$(".become-enter em").html(data.message).show();}},"json");
		}
	});
	$("#action-order").click(function(e){
		$("div.popup:not(.become-order)").hide();
		$("div.become-order").toggle();
		$(".become-order fieldset").removeClass("validate");
	});
	$("#action-enter").click(function(e){
		$("div.popup:not(.become-enter)").hide();
		$("div.become-enter").toggle();
		$(".become-enter fieldset").removeClass("validate");
	});
	$("#ShowFormOrder").click(function(){
		var scrolling = $(this).attr("data-scroll");
		$(this).next('em').remove();
		$(this).hide();
		$("#DivOrder").show();
		$("html, body").animate({scrollTop:scrolling},"slow");
	});
	$("#AbortFormOrder").click(function(){
		$(".help-inline").hide();
		$("#DivOrder").hide();
		$("#ShowFormOrder").show();
		$("html, body").animate({scrollTop:'0'},"slow");
		
	});
	$("#addOderAudit").click(function(event){
		var err = false;
		event.preventDefault();
		$(".help-inline").hide();
		
		$("#formOrderAudit .valid-required").each(function(i,element){if($(this).val()==''){$(this).next(".help-inline").html("Поле не может быть пустым").show();err = true;}});
		if(!err && !isValidEmailAddress($("#formOrderAudit .valid-email").val())){$("#formOrderAudit .valid-email").next(".help-inline").html("Не верный Email").show();err = true;}
		if(!err && !isValidPhone($("#formOrderAudit .valid-phone").val())){$("#formOrderAudit .valid-phone").next(".help-inline").html("Не верный номер").show();err = true;}
		if(!err){
			var postdata = myserialize($("#formOrderAudit .FieldSend"));
			$.post(baseurl+"send-order-audit",{'postdata':postdata},
				function(data){
					if(data.status){
						$("#formOrderAudit .valid-required").val('');
						$("#ShowFormOrder").after('<em style="margin-left:10px;">'+data.message+'<em>')
						$("#DivOrder").hide();
						$("#ShowFormOrder").show();
						$("html, body").animate({scrollTop:'0'},"slow");
					}
				}
			,"json");
		}
	});
	
	$("#addEnergoPassport").click(function(event){
		var err = false;
		event.preventDefault();
		$(".help-inline").hide();
		$("#formEnergoPassport .valid-required").each(function(i,element){if($(this).val()==''){$(this).next().next(".help-inline").html("Поле не может быть пустым").show();err = true;}});
		if(!err){
			var postdata = myserialize($("#formEnergoPassport .FieldSend"));
			$.post(baseurl+"send-energy-passport",{'postdata':postdata},
				function(data){
					if(data.status){
						$("#formEnergoPassport .valid-required").val('');
						$("#ShowFormOrder").after('<em style="margin-left:10px;">'+data.message+'<em>')
						$("#DivOrder").hide();
						$("#ShowFormOrder").show();
						$("html, body").animate({scrollTop:'0'},"slow");
					}
				}
			,"json");
		}
	});
	$("#formEnergoPassport input[type='radio']:checked").addClass("FieldSend");
	$(".RType").click(function(){Set_FieldSend($(".RType"),this);});
	$(".RForma").click(function(){Set_FieldSend($(".RForma"),this);});
	$(".RProperties").click(function(){Set_FieldSend($(".RProperties"),this);});
	
	function Set_FieldSend(objects,the_this){
		$(objects).removeClass("FieldSend");
		$(the_this).addClass("FieldSend");
	}
	
})(window.jQuery);