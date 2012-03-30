  $(document).ready(function(){
  	$("#customer").load('get_customer.php');  //load customer list from get_customer.php
    $("#viewpart").validate();  //attach validater to form
		$('#customer').click(function(){ ///load drawing list based on customer
		var custid=$('#Customer_ID').val();
		var url='get_drawing.php?custid='+custid;
  		$("#drawing").load(url)
  		});

		$('#drawing').click(function(){  //load operation list based on drawing
		var drawingid=$('#Drawing_ID').val();
		var url='get_operations.php?drawingid='+drawingid;
  		$("#operation").load(url)
		var purl='get_part_details.php?drawingid='+drawingid;
		$('#footer').load(purl);
		var pdrw='show_part_preview.php?drawingid='+drawingid;
		$('#pdrawing').load(pdrw);
  		});

		$('#operation').click(function(){  
		var opid=$('#Operation_ID').val();  //get selected opid
		var url='show_tool_list_and_details_for_op.php?opid='+opid;  //display already added tools for this operation
		var opimg='show_operation_image.php?opid='+opid;
		$('#opimage').load(opimg);
		$("#tlist").load(url)
		$('#toolinfo').empty();;
  		});
  		
$('#tinfo').live("click",function(){
	var toolid=$(this).val();
	var url='get_tool_info.php?toolid='+toolid;
$('#toolinfo').load(url);
	
	
	
});

  });
