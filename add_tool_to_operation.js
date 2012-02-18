  $(document).ready(function(){
var tlist=new Array();
var toolno=0;
$('#added').hide();
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
			$('#tool').hide();
		}
		
  		});

		$('#tdia').blur(function(){  //load operation list based on drawing
		var ttype=$('#Tool_Type_ID').val();
		var tdia=$('#tdia').val();
		var url='get_tool_of_type_dia.php?ttype='+ttype+'&tdia='+tdia;
		$('#tool').show();
  		$("#tool").load(url)
  		$('#add').show();
  		});

	$('#add').click(function(){
		
		if($('#toolsoperation').valid())
		{
		var tid1=$('#Tool_ID_1').val();
		var tid2=$('#Tool_ID_2').val();
		var hid=$('#Holder_ID').val();
		var tdesc=$('#tdesc').val();
		var toh=$('#toh').val();
		var tlife=$('#tlife').val();
		if(tlife==""){tlife=0;}
		tlist[toolno]=[tid1,tid2,hid,tdesc,toh,tlife];
		var newtr="<tr><td>"+$('#Tool_ID_1 :selected').text()+"</td><td>"+$('#Tool_ID_2 :selected').text()+"</td><td>"+$('#Holder_ID :selected').text()+"</td><td>";
		newtr+=tdesc+"</td><td>"+toh+"</td><td>"+tlife+"</td></tr>";
		$('#tool').hide();
		$('#tooldia').hide();
		$('#added').append(newtr);
		$('#added').show();
			console.log(tlist[toolno]);
		toolno+=1;
		$('#add').hide();
		}
		
		
	});

	$("#submit").click(function(event) {

	 if($("#toolsoperation").valid())
  	{
  		$('#addedtools').val(tlist);
  		$('#nooftools').val(toolno);
  		event.preventDefault();
		$.ajax({
      					data: $('#toolsoperation').serializeArray(),
      					type: "POST",
      					url: "add_tools_to_operation.php",
      					success: function(html) {

				document.getElementById("footer").innerHTML=html;
				$('#toolsoperation')[0].reset();
				toolno=0;
				tlist=[];
      							}
    							});
  	}
		});
  });
