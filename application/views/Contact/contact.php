  <?php
  defined('BASEPATH') OR exit('No direct script access allowed');
  ?>
   <div class="contact-section">
            <div class="contact">

      
              <p>Contact Us</p>
              <p>Feel free to ask questions/comments by filling the contact form.</p>
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
                      <input type="text" class="form-control" id="name"  name="name" placeholder="Palesa Motseare">
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
                     <span id="chars">500</span>
                    </div>
                    <button type="submit" class="btn btn-default">Send Message</button>
          
                   </form>
                </div>
              </div>
            </div>
          
        </div>
      </section>
     
     
<script type="text/javascript">
	$(document).ready(function(){ 
        $('#characterLeft').text('500 characters left');
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
</script>
