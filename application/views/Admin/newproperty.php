<?php
defined('BASEPATH') OR exit('No direct script access allowed');

?>


<div class="container form-area">
  <?php
$action="#";

  echo form_open($action,array('class'=>'form-horizontal'));?>

  <div class="resetTopPad text-center">
    <h1 >Add New Property </h1>  
    <div class="message_property ">

    </div>
    <div class="list-group">
      <a href="#" class="list-group-item active">
        <h4 class="list-group-item-heading">Type Suburb Name to Search for Address</h4>
        <p class="list-group-item-text"> 
          <label class="">          
            <input type="text" name="input_search" placeholder="search" class="add_input_search text-left ">          
          </label>
        </p>
      </a>
      <a href="#" class="list-group-item">
        <h4 class="list-group-item-heading"></h4>
        <p class="list-group-item-text" >
          <div class="row select_ad" id="select_ad">     
            <div class="col-lg-12">
              <label class="">Choose Suburb
                <select class="form-control" name="select_ad_suburb" id="select_ad_suburb"></select>
              </label>   
            </div>
          </div>
          </p>
        </a>
        <a href="#" class="list-group-item" id="print_address_list">
          <!--div class="col-lg-12" id="print_address_list"></div>
           </div>
          <h4 class="list-group-item-heading"></h4>
          <p class="list-group-item-text">
            <div class="row print_address_list">
             
         </p-->
       </a>
    </div>
    <!--div class="list-group ">
     A property can only be added on the address that already exist in the Database
     <ol class="list-group text-primary text-left">
         <li class="list-group-item list-group-item-info">Search Suburb</li>
         <li class="list-group-item list-group-item-info">Select address</li>
         <li class="list-group-item list-group-item-info">check the address door number to you wish to add</li>
         <li class="list-group-item list-group-item-info">Send information to submit it</li>
     </ol>
    </div-->

    <div class=" form-group ">
      <div class="row">
        <!--div class="col-lg-5 col-sm-6">
          <label class="">Choose province for Address search
            <select class="form-control" id="province_search" name="province_search">              
              <option value= 0></option>
              <?php 
                foreach ($addresslist as $value) {?>
                  <option value=  <?php echo $value->province_id;?>><?php echo $value->province;?></option>
                  <?php
                }
              ?>                    

            </select>
        </label>
      </div-->
      <!--div class="col-lg-6 ">
        <search input value by filterring using jquery>
        <label class="">Type Suburb Name to Search for Address          
            <input type="text" name="input_search" placeholder="search" class="add_input_search text-left ">          
        </label-->
       <!--<label class="control-label">Type Suburb Name to Search for Address <input type="text" name="input_search" placeholder="search" id="add_input" class="add_input"></label>
        append the suburb options from jquery suburb which user will search adsress by its value>           
      </div-->
    </div> 
    <div class="col-sm-12">
              <?php  echo form_error('select_ad_suburb') ? alertMsg(false,'',form_error('select_ad_suburb')):'';?>
              </div>
    </div>
    <div class="col-sm-12">
              <?php  echo form_error('add_check') ? alertMsg(false,'',form_error('add_check')):'';?>
              </div>
    
    <!--div class="row select_ad" id="select_ad">     
      <div class="col-lg-4 text-left">
        <label class="">Choose Suburb
          <select class="form-control" name="select_ad_suburb" id="select_ad_suburb"></select>
        </label>   
      </div> 
      <div class="col-sm-12">
              <?php // echo form_error('select_ad_suburb') ? alertMsg(false,'',form_error('select_ad_suburb')):'';?>
              </div>
    </div-->
    <!--output of the address to add the property>
    

    <div class="row print_address_list">
         <div class="col-lg-12" id="print_address_list"></div>
    </div-->
  </div>
 
    <div class=" col-lg-2 ">
      <input type="hidden" id="referrer" name="referrer" value="<?php //echo $referrer; ?>">
    </div>
    <div class="col-lg-3">
      <button class="btn btn-lg btn-primary form-control" id="select_ad_button" >Send</button>     
    </div>
    <div class="col-lg-3">
      <a class="btn btn-lg btn-warning form-control" type="text">Back</a>
    </div>

  </form><!-- /form -->



</div>
<script >
  
</script>