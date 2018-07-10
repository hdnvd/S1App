
<script type="text/javascript">

$(document).ready(function() {
    $("#provinces").change(function(){
    	var citytitleslist=new Array();
    	var cityidslist=new Array();
    	<?php 
    	    for($i=0;$i<count($provinces);$i++)
    	    {
    	        $provinceID=$provinces[$i]['id'];
    	        echo "citytitleslist[$provinceID]=\"";
    	        for($j=0;$j<count($provinces[$i]['cities']);$j++)
    	        {
    	            if($j>0)
    	                echo ",";
    	            echo $provinces[$i]['cities'][$j]['title'];
    	        }
    	        echo "\";\n";
    	        echo "cityidslist[$provinceID]=\"";
    	        for($j=0;$j<count($provinces[$i]['cities']);$j++)
    	        {
    	        if($j>0)
    	            echo ",";
    	            echo $provinces[$i]['cities'][$j]['id'];
    	        }
    	        echo "\";\n";
    	    }

    	?>
        var form=$(this).closest("form");
        var url =  form.attr("action");
        var province=$("#provinces").val();
        var i=0;
        var titles=citytitleslist[province].split(",");
        var ids=cityidslist[province].split(",");
        $("#cities").empty(); // remove old options
        for(i=0;i<ids.length;i++)
        	$("#cities").append($("<option></option>")
        			   .attr("value", ids[i]).text(titles[i]));
    });
});
</script>

