					$(document).ready(function(){
						var slidescount=$('.slideimagediv').length;
						var currentslide=0;
						var nextslide=1;
						var showingslide=false;
						function showNextSlide()
						{
							if(!showingslide)
							{
								nextslide=0;
								if(currentslide<slidescount)nextslide=currentslide+1;
								$("#islide"+nextslide).css("z-index","0");
								$("#islide"+nextslide).css("z-index","1");
								$("#islide"+nextslide).fadeIn(3000);
								$("#islide"+currentslide).fadeOut(3000);
								currentslide=nextslide;
							}
						}
						function hideAll()
						{
							var i;
							for(i=0;i<slidescount;i++)
							{
								$("#islide"+i).fadeOut(1);
							}
						}
						
						hideAll();
						showNextSlide();
						setInterval(function() {showNextSlide()}, 7000);
						
					});
					
					
					