  $(document).ready(function(){
var tlist=new Array();
var toolno=0;

  	$("#customer").load('get_customer.php');  //load customer list from get_customer.php
    $("#toolsoperation").validate();  //attach validater to form
	$('#tooldia').hide();
	$('#add').hide();
		$('#customer').click(function(){ ///load drawing list based on customer
		var custid=$('#Customer_ID').val();
		var url='get_drawing.php?custid='+custid;
  		$("#drawing").load(url)
  		});

		$('#drawing').click(function(){  //load operation list based on drawing
		var drawingid=$('#Drawing_ID').val();
		var url='get_operations.php?drawingid='+drawingid;
  		$("#operation").load(url)
  		});

		$('#operation').click(function(){  
		var opid=$('#Operation_ID').val();  //get selected opid
		if(opid!="")
		{  //if an operation is selected show tool types and text field to enter diameter
			$('#tooltype').load('get_tool_types.php');
		}else 
		{  //if no operations are selected hide tool type and dia text field
			$('#tooltype').empty();
		}
		
		var url='show_tool_list_for_op.php?opid='+opid;  //display already added tools for this operation
  		$("#footer").load(url)
  		});

		$('#tooltype').click(function(){  //load operation list based on drawing
		var ttype=$('#Tool_Type_ID').val();
		if(ttype!="")
		{
			$('#tooldia').show();
		}else
		{
			$('#tooldia').hide();
			$('#tool').empty();
		}
		
  		});

		$('#tdia').blur(function(){  //load operation list based on drawing
		var ttype=$('#Tool_Type_ID').val();
		var tdia=$('#tdia').val();
		var url='get_tool_of_type_dia.php?ttype='+ttype+'&tdia='+tdia;
  		$("#tool").load(url)
  		$('#add').show();
  		});

	$('#add').click(function(){
		
		if($('#toolsoperation').valid())
		{
		var tid=$('#Tool_ID').val();
		var hid=$('#Holder_ID').val();
		var tdesc=$('#tdesc').val();
		var toh=$('#toh').val();
		tlist[toolno]=(tid,hid,tdesc,toh);
		$('#tool').empty();
			console.log("tlist["+toolno+"]="+tlist);
		toolno+=1;
		}
		
		
	});

	$("#submit").click(function(event) {

	 if($("#toolsoperation").valid())
  	{
  		event.preventDefault();
		$.ajax({
      					data: $('#toolsoperation').serializeArray(),
      					type: "POST",
      					url: "add_tools_to_operation.php",
      					success: function(html) {

				document.getElementById("footer").innerHTML=html;
				$('#toolsoperation')[0].reset();
      							}
    							});
  	}
		});
  });
