$(document).ready(function() {
	$("#changepassform").submit(function(event){
		event.preventDefault();
		 
	if($("#NewPass").val()==$("#NewPass2").val())
	{	
		var form = $( this );
		var dt=$(this).serialize();
		var url =  form.attr( "action" );
		var posting = $.post( url, dt );
		 posting.done(function( data ) {
		alert(data);
		});
	}
	else
	{
		alert("کلمه عبور جدید با تکرار آن یکسان نیست!");
		return false;
	}
	
});
});

