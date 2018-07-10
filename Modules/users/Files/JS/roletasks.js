$(document).ready(function() {
	$("#roleid").change(function(){
		
		var form=$(this).closest("form");
		var url =  form.attr("action");
		var vroleid=$("#roleid").val();
		var posting = $.post( url, {action:"getroleprevilages_Click",roleid: vroleid});
		 posting.done(function( data ) {
			 //alert(data);
			 arr=data.split(",");
			 $(".checkbox").each(function () {
			        var value = $(this).val();
			        var i;
			        $(this).prop("checked",false);
			        for(i=0;i<arr.length;i++){
			        	//alert(arr[i]);
			        	if(arr[i].trim()==value.trim())
			        		{
			        			
			        			
			        			$(this).prop("checked",true);
			        		}
			    	   		
			        }
			    	   	
			        
			    });
		});
	});
});
