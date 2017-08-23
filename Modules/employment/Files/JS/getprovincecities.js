$(document).ready(function() {
	$("#provinces").change(function(){
		
		var form=$(this).closest("form");
		var url =  form.attr("action");
		var province=$("#provinces").val();
		var cities=$("#cities");
			 var titles=citytitleslist[province].split(",");
			 var ids=cityidslist[province].split(",");
			        for(i=0;i<cityidslist.length;i++)
			        	$("#cities").options[$("#cities").options.length]=new Option(titles[i],ids[i]);
	});
});
