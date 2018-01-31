<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?>


<div class="row setup-content" >
      <div class="col-xs-6 col-md-offset-4">
        <div class="col-md-12">
          <h3 >Owners Information</h3>
          <div class="form-group">
            <label class="control-label" for="title_deed">Title Deed</label>
            <div class="input-group"> <span class="input-group-addon"><span class="fa fa-address-card-o"></span></span>
              <input type="text" class="form-control" name="title_deed" value="<?php echo isset($user_id)? $title_deedEdit: set_value('title_deed')?>"   id="title_deed" placeholder="title deed" required>
            </div>
            <p><?php echo form_error('title_deed') ? alertMsg(false,'title_deed',form_error('title_deed')) : ''; ?></p>
          </div>
          <div class="form-group">
            <label class="control-label" for="registration_number">Registration Number</label>
            <div class="input-group"> <span class="input-group-addon"><span class="fa fa-registered"></span></span>
              <input type="text" class="form-control" name="registration_number" value="<?php echo isset($user_id)? $registration_numberEdit: set_value('registration_number')?>"   id="registration_number" placeholder="registreation no." required>
            </div>
            <p><?php echo form_error('registration_number') ? alertMsg(false,'registration_number',form_error('registration_number')) : ''; ?></p>
          </div>
          <div class="form-group">
            <label class="control-label" for="purchase_price">Purchase Price</label>
            <div class="input-group"> <span class="input-group-addon"><span class="fa fa-money"></span></span>
              <input type="text" class="form-control" name="purchase_price" value="<?php echo isset($user_id)? $purchase_priceEdit: set_value('purchase_price')?>"   id="purchase_price" placeholder="purchase price" required>
            </div>
            <p><?php echo form_error('purchase_price') ? alertMsg(false,'purchase_price',form_error('purchase_price')) : ''; ?></p>
          </div>


          <div class="form-group">
              <label class="control-label" for="purchase_date">Purchase Date</label>
              <div class="input-group"> <span class="input-group-addon"><span class="fa fa-id-card-o"></span></span>
                <input type="date" class="form-control" name="purchase_date"  id="purchase_date" value="<?php echo isset($user_id)? $purchase_dateEdit: set_value('purchase_date')?>"  placeholder="purchase_date" required>
              </div>
              <p><?php echo form_error('purchase_date') ? alertMsg(false,'purchase_date',form_error('purchase_date')) : ''; ?></p>

            </div>
            <div class="form-group">
            <label class="control-label" for="house_type">House Type</label>
            <div class="input-group"> <span class="input-group-addon"><span class="fa fa-calendar"></span></span>
              <input type="text" class="form-control" name="house_type" value="<?php echo isset($user_id)? $house_typeEdit: set_value('house_type')?>"   id="house_type" placeholder="house_type" required>
            </div>
            <p><?php echo form_error('house_type') ? alertMsg(false,'house_type',form_error('house_type')) : ''; ?></p>
          </div>
          
          
          <button class="btn btn-primary nextBtn btn-m pull-right" id="address" name="address">Next</button>

        </div>
      </div>
    </div>