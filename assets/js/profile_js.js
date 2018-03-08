
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

     /*if(!user_id1){
      user_id1 = $('.user_id').val();

     }*/

      //send data to the function deleteUserAddress in residents controller 
      $.post('deleteUserAddress',{property_id:property_id1,user_id:user_id1},function(data){

        //send a message on html userprofile
        $('#message').html(data);  
     
      }); 
      e.preventDefault();
  }); 
   $(document).on('click','.delete_owner',function(e){

     //hide the row that is deleted
      $(this).closest('tr').hide();
      //variables for store data that is send to the controller
      var property_id1 = $(this).data('propid');
      var user_id1 = $(this).data('userid');

     /*if(!user_id1){
      user_id1 = $('.user_id').val();

     }*/

      //send data to the function deleteUserAddress in residents controller 
      $.post('deleteOwner',{property_id:property_id1,user_id:user_id1},function(data){

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
/* $.ajax({
 
  url:"residents/notification_count",
  method:"POST",  
  dataType:"json",
  success:function(data)
 
  {
 console.log(data);
   $('.fa-layers-counter').html(data.countA_lis).css({'font-size':'10px','color':'red','margin':'-30px 0px 0px -10px'});
 
   /*if(data.unseen_notification > 0)
   {
    $('.count').html(data.unseen_notification);
   }
 
  }
 
 });*/
/**
 * admin and all the taps
 * @param  {String} e){                   e.preventDefault();                  window.location [description]
 * @return {[type]}      [description]

 $(document).on('click change','#admin_confirm',function(e){
      e.preventDefault();
      //get the confirmlist view
      //$('#ad_confirm').load('../request_proof/confirmList');
      window.location = '../request_proof/confirmList';
 });

 $(document).on('click change','#admin_approve',function(e){
  //ad_approve

      e.preventDefault();
      //get the confirmlist view
      //$('#ad_confirm').load('../request_proof/confirmList');
      window.location = '../request_proof/listOfApproval';
 })
  */
 
/**
 * [input filter suburb for newproperty view]
 * @param  {[type]} event)         
 * @param  {[type]} function(data)
 * @return {[type]}                  [description]
 */ 
//hide select suburb on page load

$('#select_ad').hide();

/*if ($('.add_input_search').text('')) {
  $('#select_ad').hide();
}
$(document).on('blur', '.add_input_search', function(event) {
console.log($(this).val());
    if (!$(this).val()) {
      $('#select_ad').hide();
     // $(this).closest('.list-group-item').addClass('active');
      //$('#print_address_list').hide();
      $('#select_ad_suburb').closest('.list-group-item').removeClass().addClass("list-group-item");
      //$('#select_ad').empty();
    }
  });*/

$(document).on('blur click', '.list-group a', function(event) {
     event.preventDefault();
  });
$(document).on('focus blur keyup', '.add_input_search', function(event) {
    event.preventDefault();

    //store the value of the input
    var input = $(this).val();
    var selectpr;
    
    if (!$(this).val()) {
      $('#select_ad').hide();
     // $(this).closest('.list-group-item').addClass('active');
      //$('#print_address_list').hide();
      $('#select_ad_suburb').closest('.list-group-item').removeClass().addClass("list-group-item");
      $('#select_ad_suburb').html('');
    }
    else{
  //show select suburb
    $('#print_address_list').hide();
   
    $('#province_search').hide();
    $.post('../searchAddress',{input_search:input},function(data){     
      $('#select_ad').show('slow');
      $('#select_ad_suburb').html(data).addClass('text-primary');
      $('#select_ad_suburb').closest('.list-group-item').addClass('active');  
      $('.add_input_search').closest('.list-group-item').removeClass('active').addClass("list-group-item-success");
    });
    }
    
  })
/**
 * [select search suburb where is address for newproperty view ]
 * @param  {[type]} event)           
 * @param  {[type]} function(data)
 * @return {[type]}                  [description]
 */
$(document).on('change', '#select_ad_suburb', function(event) {
$('#print_address_list').show('slow');
    var input=$(this).val();    
    $.post('../Addresslist',{select_ad_suburb:input},function(data){    
  
      $('#print_address_list').html(data);
      //$('#print_address_list').closest('.list-group-item').addClass('active');
      $('#print_address_list').addClass('active');
     
      $('#select_ad_suburb').closest('.list-group-item').removeClass('active').addClass("list-group-item-success");
      $('.add_input_search').closest('.list-group-item').addClass("list-group-item-warning");
      $('#print_address_list').html('<p class="list-group-item-text">'+data+'</p>').addClass('text-primary text-left');
 //$('#print_address_list').children('div');
 
       $('#print_address_list div').children('input').addClass('add_check');
  //console.log($('#print_address_list div'));;
    });
  });
$(document).on('click keyup change','.add_check',function(e){
  //undo the preventDefault
    e.stopPropagation();

    $(this).prop('checked', true);
    console.log($(this).attr('checked','checked').val());

})
/**
 * [select search province where is suburb for newproperty view ]
 * @param  {[type]} event-  
 * @param  {[type]} function(data)
 * @return {[type]}                  [description]
 */
$(document).on('change', '#province_search', function(event) {

  var input=$(this).val();  
  $.post('../AddresslistByProvince',{province_search:input},function(data){
 console.log(data);
 $('#print_address_list').html('<p class="list-group-item-text">'+data+'</p>').addClass('text-primary text-left');
 //$('#print_address_list').children('div');
 console.log($('#print_address_list div'));
 //console.log($('#print_address_list').children('div').addClass('add_check');
 
   /*$.each(data, function(newproperty, val) {
     
    console.log(val);

});*/
 
      //$('#print_address_list').html(data).addClass('text-primary text-left');
     /* var check_input=$('#print_address_list').find('input:checkbox');
  
$(document).on('change',check_input,function() {
   console.log($(check_input).val());
});*/
     
    });


  });

$(document).on('click', '#select_ad_button', function(event) {
  event.preventDefault();
var check_input=$('#print_address_list').find('input:checkbox');
var m=$('#print_address_list').find($('input[type="checkbox"]'));

console.log(m);
  var list=[];
  for (var i = 0; i < check_input.length; i++) 
    {
      if($(check_input[i]).prop('checked') ===true){
      console.log($(check_input).attr('name','add_check')) ;
    list[i]=$(check_input[i]).val();
     $.post('../newproperty',{add_check:list[i]},function(data){

     $('.message_property').html(data).addClass('text-primary text-left');
  });
  }
 
} 
  /*var check_input=$('#print_address_list').find('input:checkbox');
  find('input[type=checkbox],checked')
  //var checkval=check_input.attr('name',)
  console.log(check_input);
  console.log($('#print_address_list').find('input[type=checkbox],checked'));
  $.post('../newproperty',{province_search:input},function(data){

  });*/
});
});

