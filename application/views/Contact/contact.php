 <?php
 defined('BASEPATH') OR exit('No direct script access allowed');
 ?>
 
 <div class="container">
   
  <section class="contact-section">
    <div class="contact">
     <div class="form-area">

      <h1>Contact Us</h1>

      <div class="row">
        <div class="col-md-8 col-md-offset-2">
         <?php 
         $options = array("class"=> "form-group","method"=>"POST");
         echo form_open("publiczone/contact",$options);

         if(isset($statusInsert)){
          echo alertMsg($statusInsert,'Message Sent','Message  Not Sent');
        }

        ?>

        <div class="form-group">
          <?php echo form_error('name') ? alertMsg(false,'',form_error('name')):'';?>
          <label for="name">Name</label>
          <input type="text" class="form-control" id="name"  pattern="[a-zA-Z][a-zA-Z ]{2,}"  name="name" placeholder="Palesa Motseare">
        </div>
        <div class="form-group">
          <?php echo form_error('phone') ? alertMsg(false,'',form_error('phone')):'';?>
          <label for="phone">Phone Number</label>
          <input type="text" class="form-control" id="phone"  name="phone" placeholder="0735517010">
        </div>
        <div class="form-group">
          <?php echo form_error('email') ? alertMsg(false,'',form_error('email')):'';?>
          <label for="email">Email</label>
          <input type="email" class="form-control" id="email"  name="email" placeholder="palesa.motseare@example.com">
        </div>
        <div class="form-group ">
          <?php echo form_error('message') ? alertMsg(false,'',form_error('message')):'';?>
          <label for="message">Your Message</label>
          <textarea  class="form-control" id="message" name="message" maxlength="500" placeholder="Description"></textarea>
          <span class="help-block"><p id="characterLeft" class="help-block ">You have reached the limit</p></span>
        </div>
        <div class="form-group">


        </div>
        <button type="submit" class="btn btn-default">Send</button>

      </form>
    </div>
  </div>
</div>
</div>
</section>

</div>


<script type="text/javascript">
	$(document).ready(function(){ 
    $('#characterLeft').text('500characters left');
    $('#message').keydown(function () {
      var max = 500;
      var len = $(this).val().length;
      if (len >= max) {
        $('#characterLeft').text('You have reached the limit');
        $('#characterLeft').addClass('red');
        $('#btnSubmit').addClass('disabled');            
      } 
      else {
        var ch = max - len;
        $('#characterLeft').text(ch + ' characters left');
        $('#btnSubmit').removeClass('disabled');
        $('#characterLeft').removeClass('red');            
      }
    });    
  });


/**
 * checks if the email has the correct syntax eg: asdfdsf@fds.sdsd
 * 
 */
 $("#email").on('input',function () {
        //the input that called the function
        var input =$(this);
       //the value of the email input
       var current_email = input.val();
       //the regex to check if the email is valid
       var regex = /^(([^<>()[\]\\.,;:\s@\"]+(\.[^<>()[\]\\.,;:\s@\"]+)*)|(\".+\"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/;
       
       var email_registed = ["mail@example.com"];
       //check the parent of the input to change the class latter
       var parent = input.parent();
       //checks if the email corresponds with the regex and diferent of email_registed
       if (regex.test(current_email) && ($.inArray(current_email, email_registed))!=0) {
        //removes the class has errors from the input parent
        parent.removeClass('has-error');  
         //adds the class has success to the input parent
         parent.addClass('has-success');  
         errors = false;
       } else {
         var parent = input.parent();
         //removes the class has success from the input parent
         parent.removeClass('has-success');
         //adds the class has errors to the input parent
         parent.addClass('has-error');
         errors = true;

       }
     });

</script>
