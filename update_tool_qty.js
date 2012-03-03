  $(document).ready(function(){
  	$("#toollist").load('get_tool_types.php');  //get list of tools with inserts from get_inserted_tools.php
   	$('#tdia').hide();
   	$('#tqty').hide();
    $("#toolstore").validate();//attach validater to form
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
	
	$('#toolqty').keyup(function(){
		var qty=$(this).val();
		var action=$('#addraw:checked').val();
		var toolid=$('#Tool_ID_1').val();
		if(action=="withdraw")
		{
		$.ajax({
      					data: $('#toolstore').serializeArray(),
      					type: "POST",
      					url: "get_tool_qty.php",
      					async: true,
      					success: function(html) {
				if(html!=1)
				{
					$('#qtyerror').text("Please enter Correct Quantity for WithDrawing");
				}				
      							}
    							});
			
			
			
		}else{
					$('#qtyerror').text("Please Enter New Tool Quantity");
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
  });
