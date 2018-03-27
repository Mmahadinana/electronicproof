/**
 * [this js controlls the read notification and unread notification]
 * @param  {[type]} )
 * @return {[type]}     [description]
 */
$(document).ready(function(){


 $.ajax({
 
  url:"notification_count",
  method:"POST",  
  dataType:"json",
  success:function(data)
 
  {
 console.log(data);
   $('.fa-layers-counter').html(data.countA_lis).css({'font-size':'10px','color':'red','margin':'-30px 0px 0px -10px'});
 
   if(data.unseen_notification > 0)
   {
    $('.notify_badge').html(data.unseen_notification);
   }
 
  }
 
 });
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


});

