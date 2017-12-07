<?php
defined('BASEPATH') OR exit('No direct script access allowed');


?>
<body>
  <div class="starter-template">
  	
      <?php
 $this->load->view('template/header');
 //echo password_hash("user1", PASSWORD_BCRYPT);

 	 $this->load->view($pageToLoad);

 
 ?>
 

</div>
<?php
$this->load->view('template/footer'); 
?>

<script > 
// Login Form
$(function() {
    var button = $('#loginButton');
    var box = $('#loginBox');
    var form = $('#loginForm');
    button.removeAttr('href');
    button.mouseup(function(login) {
        box.toggle();
        button.toggleClass('active');
    });
    form.mouseup(function() { 
        return false;
    });
    $(this).mouseup(function(login) {
        if(!($(login.target).parent('#loginButton').length > 0)) {
            button.removeClass('active');
            box.hide();
        }
    });
});


//the script for the timeout of the page to login
/*
var idleTime = 0; // how long user is idle
var idleTimeout = 1000 * 60 * 20; // logout if user is idle for 20 mins
var pingFrequency = 1000 * 60; // ping every 60 seconds
var warningTime = 1000 * 60 * 2; // warning at 2 mins left
var warningVisible = false; // whether user has been warned
setInterval(SendPing, pingFrequency);
setInterval(IdleCounter, 1000); // fire every second
function IdleCounter() {
    idleTime += 1000; // update idleTime (possible logic flaws here; untested example)
    if (console) console.log("Idle time incremented. Now = " + idleTime.toString());
}

function SendPing() {
    if (idleTime < idleTimeout) {
        // keep pinging
        var pingUrl = "<?php //echo base_url()?>?idleTime=" + idleTime;
        $.ajax({
             url: pingUrl,                         
            success: function () {
                if (console) console.log("Ping response received");
            },
            error: function () {
                if (console) console.log("Ping response error");
            }
        });

        // if 2 mins left, could show a warning with "Keep me on" button
        if ((idleTime <= (idleTimeout - (idleTimeout - warningTime))) && !warningVisible) {
            ShowTimeoutWarning();
        }
    } else {
        // user idle too long, kick 'em out!
        if (console) console.log("Idle timeout reached, logging user out..");
        //alert("You will be logged off now dude");
        window.location.href = "<?php //echo base_url('publiczone/logout')?>"; // redirect to "bye" page that kills session
    }
}

function ShowTimeoutWarning() {
    // use jQuery UI dialog or something fun for the warning
    // when user clicks OK set warningVisible = false, and idleTime = 0
    if (console) console.log("User was warned of impending logoff");
}

function ResetIdleTime() {
    // user did something; reset idle counter
    idleTime = 0;
    if (console) console.log("Idle time reset to 0");
}
$(document) // various events that can reset idle time
.on("mousemove", ResetIdleTime)
    .on("click", ResetIdleTime)
    .on("keydown", ResetIdleTime)
    .children("body")
    .on("scroll", ResetIdleTime);*/
</script>

    
  </body>