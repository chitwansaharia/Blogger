$(document).ready(function(){
$('.like-button').click(function(){
	id = $(this).attr('name');
	id1 = 'div#'+id;
	id = 'span.'+id;
	idval = $(id).text();
	
	
	 $.ajax({
      url: '/likes',
      type: "post",
      data: {'blogid':$(this).attr('name'),'button_name':$.trim($(id1).text()),'_token': $('meta[name=_token]').attr('content')},
      success: function(data){

       $(id).text(data);
      // $(this).prop('value','Liked');
      // alert($(this).attr('value'));
      	if($.trim($(id1).text())=='Like')
       $(id1).text('Liked');
   	else
   		$(id1).text('Like');
      

      }
    }); 
   
    

});
});
