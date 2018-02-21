
$(document).ready(function(){

  /**
   * [userprofile query for delete address]
   * @param  {[type]} e){                                                            $(this).closest('tr').hide();      var property_id1 [description]
   * @param  {[type]} function(data){                  $('#message').html(data);                                                         });             e.preventDefault();  } [description]
   * @return {[type]}                  [description]
   */
    $(document).on('click','.deleteAddress',function(e){

    //hide the row that is deleted
      $(this).closest('tr').hide();
      //variables for store data that is send to the controller
      var property_id1 = $(this).data('propid');
      var user_id1 = $('.user_id').data('userid');
      
      //send data to the function deleteUserAddress in residents controller 
      $.post('deleteUserAddress',{property_id:property_id1,user_id:user_id1},function(data){
        //send a message on html userprofile
        $('#message').html(data);  
     
      });
      e.preventDefault();
  });


  /**
   * [query for changing the primary address]
   * @param  {[type]} e){                                console.log('here');                                var     ad                 [description]
   * @param  {[type]} function(data){                                                      $( "#man_address" ).load( "manage_address");                                $('#message').html(data);                         });           } [description]
   * @return {[type]}                  [description]
   */
    $(document).on('change','.primaryRadio',function(e){
     
      //storing the address checked
      var ad=$(this).val();   
    
      //send data to the function updateUserAddress in residents controller 
      $.post('updateUserAddress',{primary_ad:ad},function(data){
    
     //reload the div (manage_address) tab
      $( "#man_address" ).load( "manage_address");   
      //send a message on html userprofile  
      $('#message').html(data);
     
        
      });
     
    });
  
  })