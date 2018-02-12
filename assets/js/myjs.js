


$(document).ready(function() {
  $('select').on('change keyup',function(){

      $('.select').closest(".form-group").removeClass("has-error");
      $('.select').closest(".form-group").addClass("has-success");
      $('.select').text("");
      $('.select').addClass("text-success");
  });
  var errors = false;
    /**
     * checks if the input name has only letters
     * 
     */
  $('#name').on('input',function()
     {
      var max = 30;
      $('#name').attr('maxlength','30') ;
      //the input that called the function
      var input = $(this);
      //gets the value of the input
      var current_name = input.val();
      //regex to only allow leters for the name
      var regex = /^[a-zA-Z\s]+$/;
      //check the parent of the input to change the class latter
      var parent = input.parent();
      //check if the input has only letters if has
      if (regex.test(current_name) && current_name.length>2 && current_name.length<30)
       {        
        //removes the class has errors from the input parent
        parent.removeClass('has-error'); 
        //adds the class has success to the input parent
        parent.addClass('has-success');
        //Enable next button
         $('.nextBtn').removeClass('disabled');
        errors = false;  
       }
       else {
        var parent = input.parent();
         //removes the class has success from the input parent
         parent.removeClass('has-success');
         //adds the class has errors to the input parent
         parent.addClass('has-error');
         //disable next button
           $('.nextBtn').addClass('disabled');
         errors = true;
     }
 });

/**
 * checks if the email has the correct syntax eg: asdfdsf@fds.sdsd
 * 
 */

 $("input#email.form-control").on('input',function () 
 {
        //the input that called the function
        var input =$(this);
        input.attr('maxlength','30');
        //the value of the email input
        var current_email = input.val();
        //the regex to check if the email is valid
        var regex = /^(([^<>()[\]\\.,;:\s@\"]+(\.[^<>()[\]\\.,;:\s@\"]+)*)|(\".+\"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/;
         
        var email_registed = ["mail@example.com"];
        //check the parent of the input to change the class latter
        var parent = input.parent();
        //checks if the email corresponds with the regex and diferent of email_registed
       if (regex.test(current_email) && ($.inArray(current_email, email_registed))!=0)
       {
        //removes the class has errors from the input parent
        parent.removeClass('has-error');  
         //adds the class has success to the input parent
         parent.addClass('has-success'); 
         //Enable next button
         $('.nextBtn').removeClass('disabled');          
         errors = false;
     } 
     else {
      var parent = input.parent();
         //removes the class has success from the input parent
         parent.removeClass('has-success');
         //adds the class has errors to the input parent
         parent.addClass('has-error');
         //disable next button 
         $('.nextBtn').addClass('disabled');        
         errors = true;
     }
 });

	$('input#newpassword.form-control').keyup('input',function() {

			//show input indication on failer and or success
			$('#results').html(checkStrength($('#newpassword').val()));
			if(checkStrength($('#newpassword').val())!='Strong')
			{	//show input error if password does no meet requirements
				$(this).parent().removeClass('has-success');
				$(this).parent().addClass('has-error');
        //disable next button
        $('.nextBtn').addClass('disabled'); 
			}
			else{
				//show input success if password meet requirements
				$(this).parent().removeClass('has-error');
				$(this).parent().addClass('has-success');
        //Enable next button
       $('.nextBtn').removeClass('disabled');
			}
		})
		// Confirm password to match newpassword
		$('input#confirmpass.form-control').keyup('input',function() {
      $(this).attr('maxlength','25');
			var password = $("#newpassword").val();
			var confirmPassword = $("#confirmpass").val();
				//when passwords do not match
				if (password != confirmPassword){
					$("#CheckPasswordMatch").html("Passwords do not match!");
					$("#CheckPasswordMatch").removeClass("text-success");
					$("#CheckPasswordMatch").addClass("text-danger");
					$(this).parent().removeClass('has-success');
					$(this).parent().addClass('has-error');
          //disable next button
          $('.nextBtn').addClass('disabled'); 

				}
				else{
				//when passwords match
				$("#CheckPasswordMatch").html("Passwords match.");
				$("#CheckPasswordMatch").removeClass("text-danger");
				$("#CheckPasswordMatch").addClass("text-success");
				$(this).parent().removeClass('has-error');
				$(this).parent().addClass('has-success');
         $('.nextBtn').removeClass('disabled');
			}
		})
		//check password 
		function checkStrength(password) {
      var inputlength='25';
     $("#newpassword").attr('maxlength','25');
			//lowercase
			var regex_lowercase=password.match(/([a-z])/);
      //uppercase
      var regex_uppercase=password.match(/([A-Z])/);
			//letters and numbers			
			var regex_number=password.match(/([a-zA-Z])/) && password.match(/([0-9])/);
			//special charactors
			var regex_special=password.match(/([!,%,&,@,#,$,^,*,?,_,~])/);
			//initialize strength to zero
			var strength = 0;
			//check length
		  if (password.length < 5) {
        $('#results').removeClass();
        $('#results').addClass('short text-danger h5');
        return 'Too short'
      }
      if (password.length > inputlength) {
				$('#results').removeClass();
				$('#results').addClass('short text-danger h5');
				return 'Too long'
			}			
			
			// If password contains lower case
    if (!regex_lowercase) {
        $('#results').removeClass();
        $('#results').addClass('good text-warning h5');
        return 'Password is missing lowercase)';
    }
    // If password contains uppercase characters
		if (!regex_uppercase) {
       $('#results').removeClass();
       $('#results').addClass('good text-warning h5');

        return 'Password is missing uppercase ';
    }
			// If it has numbers 
		if (!regex_number){
        $('#results').removeClass();
        $('#results').addClass('good text-warning h5');
        return 'Password is missing number';
    }
			// If it has one special character 
		if (!regex_special){
        $('#results').removeClass();
        $('#results').addClass('good text-warning h5');
       return 'Password is missing special character';
    } 	
			// The password met all requirements
			 else {
				$('#results').removeClass();
				$('#results').addClass('strong text-success h5');
				return 'Strong';
			}
		}


  //*************************************************Validation for date of birth //
  
    var dtToday = new Date();
    var month = dtToday.getMonth() +1;     // getMonth() is zero-based
    var day = dtToday.getDate() - 2;
    var year = dtToday.getFullYear();
    if(month < 10)
      month = '0' + month.toString();
    if(day < 10)
      day = '0' + day.toString();
    var maxDate = year + '-' + month + '-' + day;
    $('#dateofbirth').attr('max', maxDate);
 

/************ validadtion for the Identity Number in South Africa  ***********/
 
    var genderCode;
    var gender;

  	$('#identitynumber').keyup('input',function(){
  		$('#id_results').html(checkIdentity($('#identitynumber').val()));
        
  		if(checkIdentity($('#identitynumber').val()) != 'Correct'){

        $(this).parent().removeClass('has-success');
        $(this).parent().addClass('has-error');
        //disable next button
        $('.nextBtn').addClass('disabled'); 
        
      }else{
        $(this).parent().removeClass('has-error');
        $(this).parent().addClass('has-success');
        //Enable next button
        $('.nextBtn').removeClass('disabled');
        $('#id_results').removeClass();
      $('#id_results').addClass('text-success');
        
      }
  });	
   /* function identityValidation(){
      
    }*/
  	// check if the identity number meets all the requirement
  	function checkIdentity(idNumber){
      $('#identitynumber').attr('maxlength','13');
  		var dateofbirt=new Date($('#dateofbirth').val());
      //identitynumber have only numbers
  		var id_number= $('#identitynumber').val($('#identitynumber').val().replace(/[^\d].+/,''));
      var citzenship;
      var citzen=['0','1'];
      var sa_number=['8'];
      var num;

      //jQuery.inArray( citzenship, citzen ) );
  		//exracting the date into months, day and year
  		var id_month = dateofbirt.getMonth()+1;
  		var id_date = dateofbirt.getDate();       
  		var id_year = dateofbirt.getFullYear(); 
  //concadinate the birthdate to compare it with first six numbers of ID, wich represent date of birth 
  		if(id_month < 10){
  			id_month = '0' + id_month.toString();
  		}
  		if(id_date < 10){
  			id_date = '0' + id_date.toString();
  		}
      //get date of birth in a string
      var dateofbirth=id_year.toString().substring(2,4) + id_month + id_date;
      if (idNumber.length ==13) {
        //get the number in position 11 for citizenship
        citzenship=idNumber.substring(10, 11);
        //south african number   
         
        num=idNumber.substring(11, 12);
          
   
      }     
       //check the length and if it is only number
      if (idNumber.length != 13) {

        $('#id_results').removeClass('text-success');
        $('#id_results').addClass('text-danger');
        return 'Identity Number have 13 characters';
      } 
        //check number at position 11 is 0 or 1
      if (idNumber.length ==13 && ( citzen[0] != citzenship && citzen[1] != citzenship)) {

          $('#id_results').addClass('text-danger');
          return 'Invalid identity number, Citizenship is 0 or 1';
      }
       //check if it is valid south african number
      if (idNumber.length ==13 && (sa_number.indexOf(num) == -1)) { 
       $('#id_results').addClass('text-danger');      
        return 'Number at positon 12 should be 8';
      }
  		 //check if it is only number
      if (!id_number) {

      
        $('#id_results').addClass('text-danger');
        return 'Identity Number contain only numbers';
      }

  		//check with date of birth
  		if (idNumber.substring(0,6) != dateofbirth) {       
          
        $('#id_results').addClass('text-danger');
        return 'Identity Number and dateofbirth do not match';
      }
      if (idNumber.substring(0,6) != dateofbirth) {  			
        
        $('#id_results').addClass('text-danger');
  			return 'Identity Number and dateofbirth do not match';
  		}      
      //all is checked an correct 
      if(idNumber.substring(0,6) == dateofbirth && idNumber.length == 13 && id_number){  
        //gender indicator number
        genderCode = idNumber.substring(6, 10); 

        //assign value to the number
        gender = parseInt(genderCode) < 5000 ? "2" : "1"; 
        //check gender field value
        checkGender();
        return 'Correct';
    }
  } 

  //***************************************Gender validation 
$('#gender input').on('change keyup paste',function(){
  //call check gender function
  checkGender();   
  });

//******************************************check gender and macth it to the one in Identitynumber 
function checkGender(){
  //store the value of radio button checked
  var checkgender=$('input:radio[name="gender"]:checked').val();
  //compare the value with the gender indicator in IdentityNumber field
  if (checkgender!=gender) {
        $('#gender input').parent().removeClass('has-success');
        $('#gender input').parent().addClass('has-error');
        //disable next button
        $('.nextBtn').addClass('disabled');
       }else{
        $('#gender input').parent().removeClass('has-error');
        $('#gender input').parent().addClass('has-success');
        
        //disable next button
        $('.nextBtn').removeClass('disabled');
       } 
}

  /***********************************************Validation for phone number*********/
	
  $('#phone').keyup('input',function(){
      $(this).attr('maxlength','10');
  		$('#phone_results').html(checkPhone($('#phone').val()));
  		if(checkPhone($('#phone').val()) != 'Correct'){
  			$(this).parent().removeClass('has-success');
  			$(this).parent().addClass('has-error');
        //disable next button
        $('.nextBtn').addClass('disabled'); 
  		}else{
  			$(this).parent().removeClass('has-error');
  			$(this).parent().addClass('has-success');
        //Enable next button
        $('.nextBtn').removeClass('disabled');
  			$('#phone_results').removeClass();
			$('#phone_results').addClass('text-success');
  		}
  });
//check phone numbers validation
function checkPhone(phone){

  		//var dateofbirt=new Date($('#dateofbirth').val());
  		var phone_number= $('#phone').val($('#phone').val().replace(/[^\d].+/,''))
  		//variable to check that the phone starts with 0
  		var phone1=[];  		

    	for (var i = 0; i < phone.length; i++) {
    		//saving all the characters of phone as array in check variable
    		phone1[i]=phone[i];
    	}
    	//test the length
  		if (phone.length != 10) {

  			$('#phone_results').addClass('text-danger');
  			return 'Phone Number must have exactly 10 numbers';

  		}
  		//check is it is a number
  		if (!phone_number) {

  			$('#phone_results').addClass('text-danger');
  			return 'Phone Number must have only numbers';
  		}
  		//check if it starts with zero
  		if (phone1[0] != "0") {

  			$('#phone_results').addClass('text-danger');
  			return 'Phone Number must starts with zero(0)';
  		}
  		//everything is ok submit
  		if(phone.length == 10 && phone_number){
			
			return 'Correct';
		}
	}
});