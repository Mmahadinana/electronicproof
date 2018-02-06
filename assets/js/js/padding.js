<script type="text/javascript">
  $(document).ready(function ()
  {
    var navListItems = $('div.setup-panel div a'),
    allWells = $('.setup-content'),
    allNextBtn = $('.nextBtn');

    allWells.hide();

    navListItems.click(function (e) 
    {
      e.preventDefault();
      var $target = $($(this).attr('href')),
      $item = $(this);

      if (!$item.hasClass('disabled')) 
      {
        navListItems.removeClass('btn-primary').addClass('btn-default');
        $item.addClass('btn-primary');
        allWells.hide();
        $target.show();
        $target.find('input:eq(0)').focus();
      }
    });

    allNextBtn.click(function()
    {
      var curStep = $(this).closest(".setup-content"),
      curStepBtn = curStep.attr("id"),
      nextStepWizard = $('div.setup-panel div a[href="#' + curStepBtn + '"]').parent().next().children("a"),
      curInputs = curStep.find("input[type='text'],input[type='url']"),
      isValid = true;

      $(".form-group").removeClass("has-error");
      for(var i=0; i<curInputs.length; i++)
      {
        if (!curInputs[i].validity.valid)
        {
          isValid = false;
          $(curInputs[i]).closest(".form-group").addClass("has-error");
        }
      }

      if (isValid)
        nextStepWizard.removeAttr('disabled').trigger('click');
    });

    $('div.setup-panel div a.btn-primary').trigger('click');
  });

</script>


<script> 
  var errors = false;
    /**
     * checks if the input name has only letterrs
     * 
     */
     $('#name').on('input',function()
     {
        //the input that called the function
        var input = $(this);
       //gets the value of the input
       var current_name = input.val();
       //regex to only allow leters for the name
       var regex = /^[a-zA-Z\s]+$/;
       //check the parent of the input to change the class latter
       var parent = input.parent();
       //check if the input has only letters if has
       if (regex.test(current_name))
       {
        //removes the class has errors from the input parent
        parent.removeClass('has-error'); 
         //adds the class has success to the input parent
         parent.addClass('has-success');
         errors = false;  
       } 
       else {//if not
        var parent = input.parent();
         //removes the class has success from the input parent
         parent.removeClass('has-success');
         //adds the class has errors to the input parent
         parent.addClass('has-error');
         errors = true;
       }
     });
/**
 * checks if the email has the correct syntax eg: asdfdsf@fds.sdsd
 * 
 */
 $("#email").on('input',function () 
 {
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
       if (regex.test(current_email) && ($.inArray(current_email, email_registed))!=0)
       {
        //removes the class has errors from the input parent
        parent.removeClass('has-error');  
         //adds the class has success to the input parent
         parent.addClass('has-success');  
         errors = false;
       } 
       else {
        var parent = input.parent();
         //removes the class has success from the input parent
         parent.removeClass('has-success');
         //adds the class has errors to the input parent
         parent.addClass('has-error');
         errors = true;

       }
     });


</script>

<script>


  /************************ getting the district through the provinve id********************/
  function update_distric() 
  {
  //bring all the districts from php to javascript
  let district    = <?php echo json_encode($districts);?>;
  console.log(district);
//if in edit mode asssigns the model id if on insert assigns false
let id_district   = <?php echo $id_district ? $id_district : 'false' ?>; 
console.log(id_district );

  //select box from the ditrict
  let district_id =$("#district");
    //province id from the select box of the provinces
    let selected      = $("#province").val();

  //clear prev options
  district_id.empty();
//write new options
district_id.append($('<option>',
{ 
  value: 0,
  text : "select district" 
}));
$("#district select option[value='0']").attr("disabled","disabled");
$.each(district[selected], function (i, item) 
{
  district_id.append($('<option>', 
  { 
    value: item.id,
    text : item.name 

  }));

});
//select the option of the edit mode
if(id_district)
{
  $("#select_district select").val(id_district);
}
else{
  $("#select_district select").val(0);
}
  //dispaly the select box
  $("#select_district").attr('style','display:block');
}
$( document ).ready(function() 
{
  update_distric() ;
});


/*get municipali by distric id*/  
function update_manucipality()
{
  //bring all the districts from php to javascript
  let manucipality    = <?php echo json_encode($manucipalities);?>;
  let id_manucipality   = <?php echo $id_manucipality ? $id_manucipality : 'false' ?>; 
  
  
//select box from the ditrict
let manucipality_id =$("#manucipality");
    //province id from the select box of the provinces
    let selected      = $("#district").val();
    
  //clear prev options
  manucipality_id.empty();
  //write new options
  manucipality_id.append($('<option>', 
  { 
    value: 0,
    text : "select manucipality" 
  }));
  $("#manucipality select option[value='0']").attr("disabled","disabled");
  $.each(manucipality[selected], function (i, item)
  {

    manucipality_id.append($('<option>', 
    { 
      value: item.id,
      text : item.name 
    }));
  });
//select the option of the edit mode
if(id_manucipality)
{
  $("#select_manucipality select").val(id_manucipality);
}
else{
  $("#select_manucipality select").val(0);
}
  //dispaly the select box
  $("#select_manucipality").attr('style','display:block');
}
$( document ).ready(function()
{
  update_manucipality() ;

});

/**get town by municipality id**/

function update_town()
{
  //bring all the districts from php to javascript
  let town= <?php echo json_encode($towns);?>;
  let id_town= <?php echo $id_town ? $id_town : 'false'; ?>; 
  console.log(town);
  
//select box from the ditrict
let town_id =$("#town");
    //province id from the select box of the provinces
    let selected= $("#manucipality").val();
    
  //clear prev options
  town_id.empty();
//write new options
town_id.append($('<option>', 
{ 
  value: 0,
  text : "select town" 
}));
$("#town select option[value='0']").attr("disabled","disabled");
$.each(town[selected], function (i, item) 
{

  town_id.append($('<option>', 
  { 
    value: item.id,
    text : item.name 
  }));
});
if(id_town){
  $("#select_town select").val(id_town);
}
else{
  $("#select_town select").val(0);
}
  //dispaly the select box
  $("#select_town").attr('style','display:block');

}
$( document ).ready(function() 
{
  update_town();
});

/**get town by municipality id**/

function update_suburb()
{
  //bring all the districts from php to javascript
  let suburb= <?php echo json_encode($suburbs);?>;
  let id_suburb= <?php echo $id_suburb ? $id_suburb : 'false'; ?>; 
  console.log(suburb);
  
//select box from the ditrict
let suburb_id =$("#suburb");

    //province id from the select box of the provinces
    let selected= $("#town").val();
    
  //clear prev options
  suburb_id.empty();
//write new options
suburb_id.append($('<option>', 
{ 
  value: 0,
  text : "select suburb" 
}));
$("#suburb select option[value='0']").attr("disabled","disabled");
$.each(suburb[selected], function (i, item) 
{
  $("#zip_code_input").empty();
  $("#zip_code_input").append($('<input>', 
  { 

    placeholder: item.zip_code,

  }));
  item.zip_code;
  suburb_id.append($('<option>', { 
    value: item.id,
    text : item.name 
  }));
  
});
  //select the option of the edit mode
  if(id_suburb)
  {
    $("#select_suburb select").val(id_suburb);
  }
  else{
    $("#select_suburb select").val(0);
  }
  //dispaly the select box
//console.log(towninput);
$("#zip_code_input").attr('style','display:block');
$("#select_suburb").attr('style','display:block');

}
$( document ).ready(function() 
{
  update_suburb();
});


function update_address()
{
  //bring all the districts from php to javascript
  let address= <?php echo json_encode($address);?>;
  let id_address= <?php echo $id_address ? $id_address : 'false'; ?>; 

//select box from the ditrict
let address_id =$("#street_name");
    //province id from the select box of the provinces
    let selected= $("#suburb").val();

  //clear prev options
  address_id.empty();
//write new options
address_id.append($('<option>', 
{ 
  value: 0,
  text : "select street_name" 
}));
console.log(address);
$("#street_name select option[value='0']").attr("disabled","disabled");
$.each(address[selected], function (i, item) 
{
  address_id.append($('<option>', 
  { 
    value: item.id,
    text : item.street_name 
  }));


});
if(id_address)
{ 
  $("#select_address select").val(id_address);
}
else{

  $("#select_address select").val(0);
}
  //dispaly the select box
  $("#select_address").attr('style','display:block');
  $("#select_Number").attr('style','display:block');
}
$( document ).ready(function()
{
  update_address();
});


</script>






<!-- validatin for password-->
</script>
<script type="text/javascript">
  var password = document.getElementById("password")
  , confirm = document.getElementById("confirm");

  function validatePassword()
  {
    if(password.value != confirm.value) 
    {
      confirm.setCustomValidity("Passwords Don't Match");
    }
    else 
    {
      confirm.setCustomValidity('');
    }
  }

  password.onchange = validatePassword;
  confirm.onkeyup = validatePassword;
</script>

