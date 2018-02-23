
$(document).ready(function(){

  /**
   * [userprofile query for delete address]
   * @param  {[type]} e){                                                           
   * @return {[type]}                  [description]
   */
    $(document).on('click','.deleteAddress',function(e){

     //hide the row that is deleted
      $(this).closest('tr').hide();
      //variables for store data that is send to the controller
      var property_id1 = $(this).data('propid');
      var user_id1 = $(this).data('userid');
     
      //send data to the function deleteUserAddress in residents controller 
      $.post('deleteUserAddress',{property_id:property_id1,user_id:user_id1},function(data){
        //send a message on html userprofile
        $('#message').html(data);  
     
      });
      e.preventDefault();
  });


  /**
   * [query for changing the primary address]
   * @param  {[type]} e){                               
   * @param  {[type]} function(data){                                                 
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


//*******************************list of residents view*************************/

/**
 * [showing the input search]
 * @param  {[type]} event){                   event.preventDefault();              [description]
 * @return {[type]}          [description]
 */
    $(document).on('click','#add1',function(event){
      event.preventDefault();
      $('#add').show();
       
    });
    var useremail=$('.useremail');
    //hide the div
    $('#hide_owner').hide();
       
/**
 * [get all the user by filtering]
 * @param  {[type]} )[description]
 * @param  {[type]} dataType:                 [description]
 * @param  {[type]} success:function(userval) [description]
 * @param  {[type]} error:                    [description]
 * @return {[type]}                           [description]
 */
  $(document).on('keyup','#mysearch',function(){
       //store the valeus of search
       var data = $(this).val();

       if(data !=''){
         $.ajax({
         // url: "getOwner",
         url: "getUser",
         method: "POST",
         data: {'mysearch': data },
         dataType: "json",   
         success:function(userval)
         {
          //useremail=ownerval;
         console.log(userval);
            //show the div  
            $('#hide_owner').show();
            //append data in the div
            // $('#hide_owner').html(userval['mail'],userval['userid']);      
            $('#hide_user').html(userval);      
              
         },
          error: function(){
                       alert('has error');
                     }
        });
      }
  });
  /**
   * [add the address of the user selected]
   * @param  {[type]} e){                             e.preventDefault();     [description]
   * @param  {[type]} function(data)   [description]
   * @return {[type]}                  [description]
   */
  $(document).on('change','#hide_user',function(e){
   
    //saving the values of address id and user id
     var ad_id=$('#primary_ad').val();
     var aduser_id=$(this).val();
  //send data in addUserAddress fuction 
   $.post('addUserAddress',{primary_ad:ad_id,userid:aduser_id},function(data){ 

      //reload the div (manage_address) tab       
      $( "#man_address" ).load( "manage_address");   
      //send a message on html userprofile
      $('#message').html(data);        
      });

    e.preventDefault();
    });
  
  
  })