  $(document).ready(function(){
  	$("#toollist").load('get_tool_types.php');  //get list of tools with inserts from get_inserted_tools.php
   	$('#tdia').hide();
   	$('#tqty').hide();
   	$('#resharp').hide();
	$('#td').hide();
    $('#toolstore').validate();//attach validater to form
	$('#submit').attr('disabled',true);

	$('#toollist').click(function(){
	
	if($('#Tool_Type_ID').val()!='')
			{
			$('#tdia').show();
			}else
			{$('#tdia').hide();}

  		});

	$('#tdia').keyup(function(){
		var tdia=$('#tooldia').val();
		var ttype=$('#Tool_Type_ID').val();
		var url='get_tool_of_type_and_dia.php?ttype='+ttype+'&tdia='+tdia;
	
	if(	$('#tooldia').val()!=''){
		$('#tools').load(url);
			}
	});

	$('#tools').click(function(){
	if($('#Tool_ID_1').val()!='')
			{
			$('#tqty').show();
			var toolid=$('#Tool_ID_1').val();
			var url='show_tool_qty.php?toolid='+toolid;
			$('#footer').load(url);
			}else
			{$('#tqty').hide();}

  		});
	
	$('input.adddraw').click(function(){
		
		$('#resharp').show();
		$('#td').hide();
		$('#resh').attr("checked",false);
		$('#new').attr("checked",false);
	});


	$('input.resh').click(function(){
		$('#td').show();
		var action=$('input.adddraw:checked').val();
		var resh=$('input.resh:checked').val();
		$('#adddrw').val(action);
		$('#resha').val(resh);
		$('input.adddraw').attr('disabled',true);
		$('input.resh').attr('disabled',true);
		
	});



	$('#toolqty').keyup(function(){
		var qty=$(this).val();
		var action=$('input.adddraw:checked').val();
		var resh=$('input.resh:checked').val();
		var toolid=$('#Tool_ID_1').val();
console.log(action);
console.log(resh);
		if(action!="")
		{
		$.ajax({
      					data: $('#toolstore').serializeArray(),
      					type: "POST",
      					url: "get_tool_qty.php",
      					async: true,
      					success: function(html) {
					rdata=html.split("<|>");
					$('#qtyerror').html(rdata[0]);
					if(rdata[1]=="0")
					{
						$('#submit').attr('disabled',false);
					}else
					{
						$('#submit').attr('disabled',true);
					}
				
      							}
    							});
		}
		
		
	});


	$("#submit").click(function(event) {
	 if($("#toolstore").valid())
  	{
  		event.preventDefault();
		$.ajax({
      					data: $('#toolstore').serializeArray(),
      					type: "POST",
      					url: "update_tool_qty.php",
      					success: function(html) {
				document.getElementById("footer").innerHTML=html;
				$('#toolstore')[0].reset();
      							}
    							});
  	}
		});


	$('#resetf').click(function(){
	
	$('#toolstore')[0].reset();
	$('input.adddraw').attr('disabled',false);
	$('input.resh').attr('disabled',false);
	$('#td').hide();
	$('#resharp').hide();
	$('#submit').attr('disabled',true);					
	});



  });
