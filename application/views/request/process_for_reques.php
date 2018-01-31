<?php
defined('BASEPATH') OR exit('No direct script access allowed');
//This page shows the list approved for the request//
?> 


<div class="container form-area">

  <div class="row steps-intent__container" data-reactid="118">
    <div class="col-md-4 col-sm-12 steps-intent__step" data-reactid="119">
      <div class="steps-intent__image-wrapper text-xs-center" data-reactid="120">
        <span class="steps-intent__arrow" data-reactid="121"></span>
        <img alt="" src="https://www.paypalobjects.com/digitalassets/c/website/marketing/emea/pt/pt/personal/buyonline_browser1.png" data-reactid="122">
      </div>
      <span class="steps-intent__circle text-xs-center" data-reactid="123"><font style="vertical-align: inherit;"><font style="vertical-align: inherit;">1</font></font>
      </span>
      <div class="steps-intent__content" data-reactid="124">
        <p class="steps-intent__text" data-reactid="125"><font style="vertical-align: inherit;"><font style="vertical-align: inherit;">Create an account quickly with only a few data.</font></font>
        </p>
      </div>
    </div>
    <div class="col-md-4 col-sm-12 steps-intent__step" data-reactid="126">
      <div class="steps-intent__image-wrapper text-xs-center" data-reactid="127">
        <span class="steps-intent__arrow" data-reactid="128"></span>
        <img alt="" src="https://www.paypalobjects.com/digitalassets/c/website/marketing/emea/pt/pt/personal/buyonline_browser2.png" data-reactid="129">
      </div>
      <span class="steps-intent__circle text-xs-center" data-reactid="130"><font style="vertical-align: inherit;"><font style="vertical-align: inherit;">2</font></font>
      </span>
      <div class="steps-intent__content" data-reactid="131">
        <p class="steps-intent__text" data-reactid="132"><font style="vertical-align: inherit;"><font style="vertical-align: inherit;">Associate your bank account, debit card, or credit card.</font></font>
        </p>
      </div>
    </div>
    <div class="col-md-4 col-sm-12 steps-intent__step" data-reactid="133">
      <div class="steps-intent__image-wrapper text-xs-center" data-reactid="134">
        <span class="steps-intent__arrow" data-reactid="135"></span>
        <img alt="" src="https://www.paypalobjects.com/digitalassets/c/website/marketing/emea/pt/pt/personal/buyonline_browser3.png" data-reactid="136">
      </div>
      <span class="steps-intent__circle text-xs-center" data-reactid="137"><font style="vertical-align: inherit;"><font style="vertical-align: inherit;">3</font></font>
      </span><div class="steps-intent__content" data-reactid="138"><p class="steps-intent__text" data-reactid="139"><font style="vertical-align: inherit;"><font style="vertical-align: inherit;">Use the data to sign in to PayPal and avoid entering your financial information over and over again.</font></font>
      </p>
    </div>
  </div>
</div>

</div>
<?php
public function valid_password($password = '')
  {
    $password = trim($password);
    $regex_lowercase = '/[a-z]/';
    $regex_uppercase = '/[A-Z]/';
    $regex_number = '/[0-9]/';
    $regex_special = '/[!@#$%^&*()\-_=+{};:,<.>§~]/';
    if (empty($password))
    {
      $this->form_validation->set_message('valid_password', 'The password field is required.');
      return FALSE;
    }
    if (preg_match_all($regex_lowercase, $password) < 1)
    {
      $this->form_validation->set_message('valid_password', 'The password field must be at least one lowercase letter.');
      return FALSE;
    }
    if (preg_match_all($regex_uppercase, $password) < 1)
    {
      $this->form_validation->set_message('valid_password', 'The password field must be at least one uppercase letter.');
      return FALSE;
    }
    if (preg_match_all($regex_number, $password) < 1)
    {
      $this->form_validation->set_message('valid_password', 'The password field must have at least one number.');
      return FALSE;
    }
    if (preg_match_all($regex_special, $password) < 1)
    {
      $this->form_validation->set_message('valid_password', 'The password field must have at least one special character.' . ' ' . htmlentities('!@#$%^&*()\-_=+{};:,<.>§~]['));
      return FALSE;
    }
    if (strlen($password) < 5)
    {
      $this->form_validation->set_message('valid_password', 'The password field must be at least 5 characters in length.');
      return FALSE;
    }
    if (strlen($password) > 32)
    {
      $this->form_validation->set_message('valid_password', 'The password field cannot exceed 32 characters in length.');
      return FALSE;
    }
    return TRUE;
  }
  
}