  <?php
  defined('BASEPATH') OR exit('No direct script access allowed');
  ?>
  <div class="contact-section">
   <div class="container">
    <div class="col-md-5">
        <div class="form-area">  
            <form role="form">
                <br style="clear:both">
                <h3 style="margin-bottom: 25px; text-align: center;">Contact Us</h3>
                <div class="form-group">
                  <input type="text" class="form-control" id="name" name="name" placeholder="Name" required>
              </div>
              <div class="form-group">
                  <input type="text" class="form-control" id="email" name="email" placeholder="Email" required>
              </div>
              <div class="form-group">
                  <input type="text" class="form-control" id="mobile" name="mobile" placeholder="Phone Number" required>
              </div>
              
              <div class="form-group">
                <textarea class="form-control" type="textarea" id="message" placeholder="Message" maxlength="140" rows="7"></textarea>
                <span class="help-block"><p id="characterLeft" class="help-block ">You have reached the limit</p></span>                    
            </div>
            
            <button type="button" id="submit" name="submit" class="btn btn-primary pull-right">Send</button>
        </form>
    </div>
</div>
</div>
</div>
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
