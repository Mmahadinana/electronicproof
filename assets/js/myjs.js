
$(document).ready(function() {

	$('#newpassword').keyup('input',function() {
			//show input indication on failer and or success
			$('#results').html(checkStrength($('#newpassword').val()));
			if(checkStrength($('#newpassword').val())!='Strong')
			{	//show input error if password does no meet requirements
				$(this).parent().removeClass('has-success');
				$(this).parent().addClass('has-error');
			}
			else{
				//show input success if password meet requirements
				$(this).parent().removeClass('has-error');
				$(this).parent().addClass('has-success');
			}
		})
		// Confirm password to match newpassword
		$('#confirmpass').keyup('input',function() {
			var password = $("#newpassword").val();
			var confirmPassword = $("#confirmpass").val();
				//when passwords do not match
				if (password != confirmPassword){
					$("#CheckPasswordMatch").html("Passwords do not match!");
					$("#CheckPasswordMatch").removeClass("text-success");
					$("#CheckPasswordMatch").addClass("text-danger");
					$(this).parent().removeClass('has-success');
					$(this).parent().addClass('has-error');
				}
				else{
				//when passwords match
				$("#CheckPasswordMatch").html("Passwords match.");
				$("#CheckPasswordMatch").removeClass("text-danger");
				$("#CheckPasswordMatch").addClass("text-success");
				$(this).parent().removeClass('has-error');
				$(this).parent().addClass('has-success')
			}
		})
		//check password 
		function checkStrength(password) {
			//uoppercase and lowercase
			var regex_lowercase_uppercase=password.match(/([a-z].*[A-Z])|([A-Z].*[a-z])/);
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
			
			if (password.length > 5) strength += 1
			// If password contains both lower and uppercase characters, increase strength value.
		if (regex_lowercase_uppercase) strength += 1
			// If it has numbers and characters, increase strength value.
		if (regex_number) strength += 1
			// If it has one special character, increase strength value.
		if (regex_special) strength += 1
			
			// Calculated strength value, we can return messages
			// If value is less than 2
			if (strength < 2) {
				$('#results').removeClass();
				$('#results').addClass('weak text-danger h5');

				return 'Weak, password contain all(special character,number,uppercase and lowercase';

			} else if (strength == 2) {
				$('#results').removeClass();
				$('#results').addClass('good text-warning h5');

				return 'Good, password contain all(special character,number,uppercase and lowercase)';

			} else {
				$('#results').removeClass();
				$('#results').addClass('strong text-success h5');
				return 'Strong';
			}
		}
	});
//for manage propertis view page
//
/****************validation for Identity number*********************/




/*$('#identitynumber').keyup('input',function(){
var idNumber = $('#identitynumber').val();
var dateofbirth=$('#dateofbirth').val();
alert(dateofbirth);
        correct=true;
        // SA ID Number have to be 13 digits, so check the length
        if (idNumber.length != 13 || !isNumber(idNumber)) {
           // error.append('<p>input not a valid number</p>');
            $(this).parent().removeClass('has-success');
			$(this).parent().addClass('has-error');
			correct=false;
        }

        // get first 6 digits as a valid date
        var tempDate = new Date(idNumber.substring(0, 2), idNumber.substring(2, 4) - 1, idNumber.substring(4, 6));

        var id_date = tempDate.getDate();
        var id_month = tempDate.getMonth();
        var id_year = tempDate.getFullYear();

        var fullDate = id_date + "-" + id_month + 1 + "-" + id_year;

        if (!((tempDate.getYear() == idNumber.substring(0, 2)) && (id_month == idNumber.substring(2, 4) - 1) && (id_date == idNumber.substring(4, 6)))) {
            //error.append('<p> date part is not valid</p>');
            $(this).parent().removeClass('has-success');
			$(this).parent().addClass('has-error');
			correct=false;
        }

        // get the gender
        var genderCode = idNumber.substring(6, 10);
        var gender = parseInt(genderCode) < 5000 ? "Female" : "Male";

        // get country ID for citzenship
        var citzenship = parseInt(idNumber.substring(10, 11)) == 0 ? "Yes" : "No";

        // apply Luhn formula for check-digits
        var tempTotal = 0;
        var checkSum = 0;
        var multiplier = 1;
        for (var i = 0; i < 13; ++i) {
            tempTotal = parseInt(idNumber.charAt(i)) * multiplier;
            if (tempTotal > 9) {
                tempTotal = parseInt(tempTotal.toString().charAt(0)) + parseInt(tempTotal.toString().charAt(1));
            }
            checkSum = checkSum + tempTotal;
            multiplier = (multiplier % 2 == 0) ? 1 : 2;
        }
        if ((checkSum % 10) != 0) {
            //error.append('<p> check digit is not valid</p>');
            $(this).parent().removeClass('has-success');
			$(this).parent().addClass('has-error');
			correct=false;
        };


        // if no error found, hide the error message
        if (correct) {
            
            $(this).parent().removeClass('has-error');
			$(this).parent().addClass('has-success');

            // clear the result div
            //$('#result').empty();
            // and put together a result message
            //$('#result').append('<p>South African ID Number:   ' + idNumber + '</p><p>Birth Date:   ' + fullDate + '</p><p>Gender:  ' + gender + '</p><p>SA Citizen:  ' + citzenship + '</p>');
        }
        // otherwise, show the error
        else {
            $(this).parent().removeClass('has-error');
			$(this).parent().addClass('has-success');
        }

        return false;
    });

    function isNumber(n) {
        return !isNaN(parseFloat(n)) && isFinite(n);
    }*/

     /*$( function() {
    $( "#datepicker" ).datepicker({ minDate: -20, maxDate: "+1M +10D" });
} );*/
  //Display Only Date till today // 
  var dtToday = new Date();
  var month = dtToday.getMonth() + 1;     // getMonth() is zero-based
  var day = dtToday.getDate()-10;
  var year = dtToday.getFullYear();
  if(month < 10)
  	month = '0' + month.toString();
  if(day < 10)
  	day = '0' + day.toString();

  var maxDate = year + '-' + month + '-' + day;
  $('#dateofbirth').attr('max', maxDate);


  $(document).ready(function(){
  	$('#identitynumber').keyup('input',function(){
  		$('#id_results').html(checkIdentity($('#identitynumber').val()));
  		if(checkIdentity($('#identitynumber').val()) != 'Correct'){
  			$(this).parent().removeClass('has-success');
  			$(this).parent().addClass('has-error');
  		}else{
  			$(this).parent().removeClass('has-error');
  			$(this).parent().addClass('has-success');
  			$('#id_results').removeClass();
			$('#id_results').addClass('text-success');
  		}
  });	//var idNumber = $('#identitynumber').val();
  	function checkIdentity(idNumber){

  		var dateofbirt=new Date($('#dateofbirth').val());
  		var id_number= $('#identitynumber').val($('#identitynumber').val().replace(/[^\d].+/,''));


  		var id_month = dateofbirt.getMonth()+1;
  		var id_date = dateofbirt.getDate();       
  		var id_year = dateofbirt.getFullYear(); 


  		if(id_month < 10){
  			id_month = '0' + id_month.toString();
  		}
  		if(id_date < 10){
  			id_date = '0' + id_date.toString();
  		}

  		var dateofbirth=id_year.toString().substring(2,4) + id_month + id_date;
  		
  		if (idNumber.substring(0,6) != dateofbirth && idNumber.length == 13 && id_number) {

  			
  			('#id_results').addClass('text-danger');
  			return 'Identity Number and dateofbirth do not match';

  		}if (idNumber.length != 13 || !id_number) {

  			$('#id_results').addClass('text-danger');
  			return 'Identity Number is not correct';

  		}
  		if(idNumber.substring(0,6) == dateofbirth && idNumber.length == 13 && id_number){

			
			return 'Correct';
		}
	}
});
	$(document).ready(function(){
  	$('#phone').keyup('input',function(){
  		$('#phone_results').html(checkPhone($('#phone').val()));
  		if(checkPhone($('#phone').val()) != 'Correct'){
  			$(this).parent().removeClass('has-success');
  			$(this).parent().addClass('has-error');
  		}else{
  			$(this).parent().removeClass('has-error');
  			$(this).parent().addClass('has-success');
  			$('#phone_results').removeClass();
			$('#phone_results').addClass('text-success');
  		}
  });	//var idNumber = $('#identitynumber').val();
  	function checkPhone(phone){

  		//var dateofbirt=new Date($('#dateofbirth').val());
  		var phone_number= $('#phone').val($('#phone').val().replace(/[^\d].+/,''))
  		var phone1=[];
  		

  	for (var i = 0; i < phone.length; i++) {
  		phone1[i]=phone[i];
  	}
  	
		if (phone.length != 10) {

  			$('#phone_results').addClass('text-danger');
  			return 'Phone Number must have exactly 10 numbers';

  		}
  		if (!phone_number) {

  			$('#phone_results').addClass('text-danger');
  			return 'Phone Number must have only numbers';

  		}
  		if (phone1[0] != "0") {

  			$('#phone_results').addClass('text-danger');
  			return 'Phone Number must starts with zero(0)';

  		}
  		if(phone.length == 10 && phone_number){

			
			return 'Correct';
		}
	}



});