	


$('#products_photo1 img').click(function()
		{
	$(".producttable").css("display","none");
		  $("#products_applicationhid img").animate({width:"700px"},1500);
		  $("#products_applicationhid img").animate({borderRadius:"30px"},500);
		  $("#products_closelink").animate({opacity:"100"});
		  $('#products_closelink').click(function()
			{
			  $(this).animate({opacity:"0"});
			  $("#products_applicationhid img").animate({borderRadius:"0px",width:"0px"},500,
				function(){
				$(".producttable").css("display","block");
				}
			  );
			  
			});

		
//			window.open($(this).attr("src"),'', 'width=800,height=60 0');
		}	


);
	
$('#products_mainphoto img').elevateZoom(
		{
			easing : true,zoomWindowOffety:-50
		}
		
);