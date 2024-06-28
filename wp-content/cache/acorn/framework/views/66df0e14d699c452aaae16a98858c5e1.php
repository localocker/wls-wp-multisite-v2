<?php
$company_name = get_field('company_name', 'option');
$company_address = get_field('company_address', 'option');
$company_phone = get_field('company_phone', 'option');

$banner_image = get_field('banner_image');
$checkout_subtitle_text = get_field('checkout_subtitle_text');
$insurance_policy_pdf_download = get_field('insurance_policy_pdf_download','option');
$protection_plan_summary_text_copy = get_field('protection_plan_summary_text_copy','option');
?>
<style>
  svg[data-lastpass-icon=true] {
    visibility: none;
  }

  div[data-lastpass-icon-root] {
    display: none !important;
  }

  /* Chrome, Safari, Edge, Opera */
  input::-webkit-outer-spin-button,
  input::-webkit-inner-spin-button {
    -webkit-appearance: none;
    margin: 0;
  }

  /* Firefox */
  input[type=number] {
    -moz-appearance: textfield;
  }


  .tooltip-inner {
    max-width: 400px;
    width: 400px;
    white-space: normal;
}

.payment-border-bottom {
  border-bottom: 4px solid black; /* Adjust the color as needed */
}

</style>

<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">


<div class="container padding-top-bottom-80">
  <div class="row">


    
    <div class="col-12 col-lg-4 col-xxl-3 unit-details">

      <div class="p-3 p-xl-4 border-radius-8px bordered-box mb-4 background-white unit-border-box">
        <h2 class="h4 mb-0 font-weight-700">
          Rental Information
        </h2>

        <div id="unit_container" class="">
        </div>
      </div>

    </div>
    


    
    <div class="checkout-form accordion col-12 col-lg-8 col-xxl-9" id="accordionCheckout">

      
      <div class="accordion-item blue">
        <h2 class="accordion-header">
          <button class="accordion-button" type="button" data-bs-toggle="collapse" data-bs-target="#collapseOne" aria-expanded="true" aria-controls="collapseOne">
            <span class="h3">
              Checkout
            </span>
          </button>
        </h2>

        <div id="collapseOne" class="accordion-collapse collapse show" data-bs-parent="#accordionCheckout">
          <div class="accordion-body p-3 p-sm-4">

            <?php if($checkout_subtitle_text): ?>
            <div class="pb-4">
              <?php echo $checkout_subtitle_text; ?>

            </div>
            <?php endif; ?>

            
            <form>
              <div class="row">

                
                <div class="col-12 col-md-6 mb-4">
                  <label for="First Name">First Name</label>
                  <input type="text" class="form-control" id="first_name" name="first_name" aria-describedby="FirstName" placeholder="First Name" />
                </div>

                <div class="col-12 col-md-6 mb-4">
                  <label for="Last Name">Last Name</label>
                  <input type="text" class="form-control" id="last_name" name="last_name" aria-describedby="LastName" placeholder="Last Name" />
                </div>

                <div class="col-12 col-md-6 mb-4">
                  <label for="Email Address">Email Address</label>
                  <input type="email" class="form-control" id="email" name="email" aria-describedby="Email" placeholder="Email Address" autoComplete="email" autocomplete="on" />
                </div>

                <div class="col-12 col-md-6 mb-4">
                  <label for="Phone Number">Phone Number</label>
                  <input type="tel" class="form-control" id="phone" name="phone" aria-describedby="Phone" placeholder="Phone Number" />
                </div>
                

                
                <div class="col-12">
                  <button type="button" class="button border-radius-4px" id="step1">
                    <span class="d-flex align-items-center">
                      Next
                      <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="white" class="bi bi-chevron-right border-radius-4px" viewBox="0 0 16 16">
                        <path fill-rule="evenodd" d="M4.646 1.646a.5.5 0 0 1 .708 0l6 6a.5.5 0 0 1 0 .708l-6 6a.5.5 0 0 1-.708-.708L10.293 8 4.646 2.354a.5.5 0 0 1 0-.708" />
                      </svg>
                    </span>
                  </button>
                </div>
                

              </div>
            </form>
            

          </div>
        </div>
      </div>
      


      
      <div class="accordion-item blue">
        <h2 class="accordion-header">
          <button class="accordion-button collapsed" id="collapseTwoToggle" type="button" data-bs-toggle="collapse" data-bs-target="#collapseTwo" aria-expanded="false" aria-controls="collapseTwo" disabled>
            <span class="h3">
              Unit Information
            </span>
          </button>
        </h2>

        <div id="collapseTwo" class="accordion-collapse collapse" data-bs-parent="#accordionCheckout">
          <div class="accordion-body p-3 p-sm-4">

            
            <form id='formStep2'>
              <div class="row">

                
                <input name="unit_id" id="unit_id" type="hidden" class="" aria-invalid="false" />

                

                <?php if($protection_plan_summary_text_copy): ?>
                    <span class="text-size-tiny-14 d-block pb-2">
                      <?php if($protection_plan_summary_text_copy): ?>
                      <?php echo $protection_plan_summary_text_copy; ?>

                      <?php endif; ?>
                    </span>
                    <?php endif; ?>

                    
                    <?php if($insurance_policy_pdf_download): ?>
                      <div class="pb-3 d-flex align-items-center w-full text-size-tiny-14 underline">
                        <a href="<?php echo $insurance_policy_pdf_download; ?>" title="Download Insurance Policy PDF" target="_blank">
                          <!-- <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-filetype-pdf me-1" viewBox="0 0 16 16">
                            <path fill-rule="evenodd" d="M14 4.5V14a2 2 0 0 1-2 2h-1v-1h1a1 1 0 0 0 1-1V4.5h-2A1.5 1.5 0 0 1 9.5 3V1H4a1 1 0 0 0-1 1v9H2V2a2 2 0 0 1 2-2h5.5zM1.6 11.85H0v3.999h.791v-1.342h.803q.43 0 .732-.173.305-.175.463-.474a1.4 1.4 0 0 0 .161-.677q0-.375-.158-.677a1.2 1.2 0 0 0-.46-.477q-.3-.18-.732-.179m.545 1.333a.8.8 0 0 1-.085.38.57.57 0 0 1-.238.241.8.8 0 0 1-.375.082H.788V12.48h.66q.327 0 .512.181.185.183.185.522m1.217-1.333v3.999h1.46q.602 0 .998-.237a1.45 1.45 0 0 0 .595-.689q.196-.45.196-1.084 0-.63-.196-1.075a1.43 1.43 0 0 0-.589-.68q-.396-.234-1.005-.234zm.791.645h.563q.371 0 .609.152a.9.9 0 0 1 .354.454q.118.302.118.753a2.3 2.3 0 0 1-.068.592 1.1 1.1 0 0 1-.196.422.8.8 0 0 1-.334.252 1.3 1.3 0 0 1-.483.082h-.563zm3.743 1.763v1.591h-.79V11.85h2.548v.653H7.896v1.117h1.606v.638z"/>
                          </svg> -->
                          View Coverage Details
                        </a>
                      </div>
                    <?php endif; ?>
                   

                <fieldset class="col-12 col-sm-6 mb-4">
                  <legend class="col-form-label col-12 pt-0" style="padding-bottom: 0.125em;">

                    <label for="Choose A Protection Plan">
                      Choose A Protection Plan
                    </label>

                  </legend>

                  <div class="border-light-gray background-lightest-gray border-radius-8px text-center text-size-small-16 py-2 pe-2 ps-3">
                    <div class="pt-1" id="insurance-options">
                    </div>
                  </div>
                </fieldset>
                

                
                <div class="col-12 col-sm-6 mb-4">
                  <!-- <label for="Expected Move In Date">
                    Expected Move In Date
                  </label> -->

                <label for="Expected Move In Date">
                    Move In Date
                  </label>

                  <?php
  $todayDate = date('Y-m-d'); // Format date to 'Y-m-d' for HTML5 date input
?>

                <div class="mb-4 pb-1">
                  <input id="desired_move_in_date"
                    type="date"
                    name="desired_move_in_date"
                    class="form-control"
                    style="max-width: 250px;"
                    autocomplete="off"
                    value="<?php echo e($todayDate); ?>"
                   />
                  <!-- <input type="hidden" name="desired_move_in_date" value="<?php echo e($todayDate); ?>" /> -->
                </div>

                  <label for="Move In Date">
                    How long do you plan to store?
                  </label>

                  <select class="form-control" id="expect_move_in" name="expect_move_in" style="max-width: 250px;">
                    <option value="none" selected disabled>Please Select</option>
                    <option value="1">1 Month or Less</option>
                    <option value="2">2 Months</option>
                    <option value="3">3 Months</option>
                    <option value="4">4-6 Months</option>
                    <option value="5">7-11 Months</option>
                    <option value="6">12+ Months</option>
                    <option value="7">Not Sure</option>
                  </select>
                </div>
                

                
                <div class="col-12">
                  <button type="button" class="button border-radius-4px" id="step2">
                    <span class="d-flex align-items-center">
                      Next
                      <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="white" class="bi bi-chevron-right border-radius-4px" viewBox="0 0 16 16">
                        <path fill-rule="evenodd" d="M4.646 1.646a.5.5 0 0 1 .708 0l6 6a.5.5 0 0 1 0 .708l-6 6a.5.5 0 0 1-.708-.708L10.293 8 4.646 2.354a.5.5 0 0 1 0-.708" />
                      </svg>
                    </span>
                  </button>
                </div>
                

              </div>
            </form>

          </div>
        </div>
      </div>
      


      
      <div class="accordion-item blue">
        <h2 class="accordion-header">
          <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapseThree" aria-expanded="false" id="collapseThreeToggle" aria-controls="collapseThree" disabled>
            <span class="h3">
              Your Information
            </span>
          </button>
        </h2>

        <div id="collapseThree" class="accordion-collapse collapse" data-bs-parent="#accordionCheckout">
          <div class="accordion-body p-3 p-sm-4">

            <form id="formStep3">
              <div class="row">

                
                <div class="col-12 mb-4">
                  <label for="Address">Address</label>
                  <input type="text" class="form-control" id="address1" name="address1" aria-describedby="Address" placeholder="9321 Main Street" />
                </div>

                <div class="col-12 mb-4">
                  <label for="Address2">Address 2</label>
                  <input type="text" class="form-control" id="address2" name="address2" aria-describedby="Address2" placeholder="Apartment, studio, floor, etc" />
                </div>

                <div class="col-12 col-md-6 col-xxl-5 mb-4">
                  <label for="City">City</label>
                  <input type="text" class="form-control" id="city" name="city" aria-describedby="City" placeholder="City" />
                </div>

                <div class="col-12 col-md-6 col-xxl-4 mb-4">
                  <label for="State">State</label>
                  <select class="form-control" id="state" name="state">
                    <option value="none" selected disabled>Select Your State</option>
                    <option value="AL">Alabama</option>
                    <option value="AK">Alaska</option>
                    <option value="AZ">Arizona</option>
                    <option value="AR">Arkansas</option>
                    <option value="CA">California</option>
                    <option value="CO">Colorado</option>
                    <option value="CT">Connecticut</option>
                    <option value="DE">Delaware</option>
                    <option value="DC">District Of Columbia</option>
                    <option value="FL">Florida</option>
                    <option value="GA">Georgia</option>
                    <option value="HI">Hawaii</option>
                    <option value="ID">Idaho</option>
                    <option value="IL">Illinois</option>
                    <option value="IN">Indiana</option>
                    <option value="IA">Iowa</option>
                    <option value="KS">Kansas</option>
                    <option value="KY">Kentucky</option>
                    <option value="LA">Louisiana</option>
                    <option value="ME">Maine</option>
                    <option value="MD">Maryland</option>
                    <option value="MA">Massachusetts</option>
                    <option value="MI">Michigan</option>
                    <option value="MN">Minnesota</option>
                    <option value="MS">Mississippi</option>
                    <option value="MO">Missouri</option>
                    <option value="MT">Montana</option>
                    <option value="NE">Nebraska</option>
                    <option value="NV">Nevada</option>
                    <option value="NH">New Hampshire</option>
                    <option value="NJ">New Jersey</option>
                    <option value="NM">New Mexico</option>
                    <option value="NY">New York</option>
                    <option value="NC">North Carolina</option>
                    <option value="ND">North Dakota</option>
                    <option value="OH">Ohio</option>
                    <option value="OK">Oklahoma</option>
                    <option value="OR">Oregon</option>
                    <option value="PA">Pennsylvania</option>
                    <option value="RI">Rhode Island</option>
                    <option value="SC">South Carolina</option>
                    <option value="SD">South Dakota</option>
                    <option value="TN">Tennessee</option>
                    <option value="TX">Texas</option>
                    <option value="UT">Utah</option>
                    <option value="VT">Vermont</option>
                    <option value="VA">Virginia</option>
                    <option value="WA">Washington</option>
                    <option value="WV">West Virginia</option>
                    <option value="WI">Wisconsin</option>
                    <option value="WY">Wyoming</option>
                  </select>
                </div>

                <div class="col-12 col-md-6 col-xl-6 col-xxl-3 mb-4 pb-2">
                  <label for="Zip">Zipcode</label>
                  <input type="text" class="form-control" id="postal" name="postal" aria-describedby="Postal" placeholder="Zipcode" />
                </div>
                


                
                <div class="col-12 mb-4">
                  <h5 class="lined-header">
                    Driver's License Info
                  </h5>
                </div>

                <div class="col-12 col-md-6 mb-4">
                  <label for="Driver's License Number">Driver's License Number</label>
                  <input type="text" class="form-control" id="drivers_license_number" name="drivers_license_number" aria-describedby="Driver's License Number" maxlength="15" autocomplete="off" />
                </div>

                <div class="col-12 col-md-6 col-xxl-3 mb-4">
                  <label for="Date Of Birth">Date Of Birth</label>
                  <input type="date" id="drivers_license_date_of_birth" name="drivers_license_date_of_birth" class="form-control max-width-250" autocomplete="off" data-lpignore="true" />
                </div>

                <div class="col-12 col-md-6 col-xxl-3 mb-4">
                  <label for="License Expiration">Expiration Date</label>
                  <input type="date" id="drivers_license_expiration" name="drivers_license_expiration" placeholder="mm/dd/yy" class="form-control max-width-250" data-lpignore="true" autocomplete="off" />
                </div>

                <div class="col-12 col-md-6 mb-4">
                  <label for="License State">State Of License</label>
                  <select class="form-control" id="drivers_license_state" name="drivers_license_state">
                    <option value="none" selected disabled>Select Your State</option>
                    <option value="AL">Alabama</option>
                    <option value="AK">Alaska</option>
                    <option value="AZ">Arizona</option>
                    <option value="AR">Arkansas</option>
                    <option value="CA">California</option>
                    <option value="CO">Colorado</option>
                    <option value="CT">Connecticut</option>
                    <option value="DE">Delaware</option>
                    <option value="DC">District Of Columbia</option>
                    <option value="FL">Florida</option>
                    <option value="GA">Georgia</option>
                    <option value="HI">Hawaii</option>
                    <option value="ID">Idaho</option>
                    <option value="IL">Illinois</option>
                    <option value="IN">Indiana</option>
                    <option value="IA">Iowa</option>
                    <option value="KS">Kansas</option>
                    <option value="KY">Kentucky</option>
                    <option value="LA">Louisiana</option>
                    <option value="ME">Maine</option>
                    <option value="MD">Maryland</option>
                    <option value="MA">Massachusetts</option>
                    <option value="MI">Michigan</option>
                    <option value="MN">Minnesota</option>
                    <option value="MS">Mississippi</option>
                    <option value="MO">Missouri</option>
                    <option value="MT">Montana</option>
                    <option value="NE">Nebraska</option>
                    <option value="NV">Nevada</option>
                    <option value="NH">New Hampshire</option>
                    <option value="NJ">New Jersey</option>
                    <option value="NM">New Mexico</option>
                    <option value="NY">New York</option>
                    <option value="NC">North Carolina</option>
                    <option value="ND">North Dakota</option>
                    <option value="OH">Ohio</option>
                    <option value="OK">Oklahoma</option>
                    <option value="OR">Oregon</option>
                    <option value="PA">Pennsylvania</option>
                    <option value="RI">Rhode Island</option>
                    <option value="SC">South Carolina</option>
                    <option value="SD">South Dakota</option>
                    <option value="TN">Tennessee</option>
                    <option value="TX">Texas</option>
                    <option value="UT">Utah</option>
                    <option value="VT">Vermont</option>
                    <option value="VA">Virginia</option>
                    <option value="WA">Washington</option>
                    <option value="WV">West Virginia</option>
                    <option value="WI">Wisconsin</option>
                    <option value="WY">Wyoming</option>
                  </select>
                </div>

                <div class="col-12 col-md-6 col-xxl-3 mb-4">
                  <label for="Are You Military" class="mb-2 w-100">Are You Military?</label>
                  <select class="form-control" id="military_options" name="military_options">
                    <option value="not" selected>I'm not military</option>
                    <option value="Air Force">Air Force</option>
                    <option value="Army">Army</option>
                    <option value="Coast Guard">Coast Guard</option>
                    <option value="Marines">Marines</option>
                    <option value="Navy">Navy</option>
                    <option value="National Guard">National Guard</option>
                    <option value="Space Force">Space Force</option>
                    <option value="Other">Other</option>
                  </select>
                </div>
                

                
                <div class="col-12">
                  <button type="button" class="button border-radius-4px" id="step3">
                    <span class="d-flex align-items-center">
                      Next
                      <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="white" class="bi bi-chevron-right border-radius-4px" viewBox="0 0 16 16">
                        <path fill-rule="evenodd" d="M4.646 1.646a.5.5 0 0 1 .708 0l6 6a.5.5 0 0 1 0 .708l-6 6a.5.5 0 0 1-.708-.708L10.293 8 4.646 2.354a.5.5 0 0 1 0-.708" />
                      </svg>
                    </span>
                  </button>
                </div>
                

              </div>
            </form>

          </div>
        </div>
      </div>
      


      
      <div class="accordion-item blue">
        <h2 class="accordion-header">
          <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapseFour" aria-expanded="false" aria-controls="collapseFour" id="collapseFourToggle" disabled>
            <span class="h3">
              Create Your Account
            </span>
          </button>
        </h2>

        <div id="collapseFour" class="accordion-collapse collapse" data-bs-parent="#accordionCheckout">
          <div class="accordion-body p-3 p-sm-4">

            <form id="formStep4">
              <div class="row">

                
                <div class="col-12 col-md-6 mb-4">
                  <label for="Email Address">Account Email</label>
                  <input type="email" class="form-control" id="account_email" name="email" aria-describedby="Email" placeholder="Email Address" autoComplete="email" autocomplete="on" />
                </div>

                <div class="col-12 col-md-6 mb-4">
                  <label for="Email Address">Desired Username</label>
                  <input type="text" class="form-control" id="user_name" name="user_name" aria-describedby="Username" placeholder="" autocomplete="username" />
                </div>

                <!-- <div class="col-12 col-md-6 mb-4">
                  <label for="Email Address">Password (Min 8 characters)</label>
                  <input type="password" class="form-control" minlength="8" id="password" name="password" aria-describedby="Password" autocomplete="current-password" placeholder="" />
                </div> -->
                <div class="col-12 col-md-6 mb-4 position-relative">
                  <label for="password">Password (Min 8 characters)</label>
                  <input type="password" class="form-control" minlength="8" id="password" name="password" aria-describedby="Password" autocomplete="current-password" placeholder="" />
                  <svg xmlns="http://www.w3.org/2000/svg" width="30" height="50" fill="currentColor" class="bi bi-eye" viewBox="0 0 16 16" style="position: absolute; top: 40%; right: 25px; cursor: pointer;" id="togglePassword">
                    <path d="M16 8s-3-5.5-8-5.5S0 8 0 8s3 5.5 8 5.5S16 8 16 8M1.173 8a13 13 0 0 1 1.66-2.043C4.12 4.668 5.88 3.5 8 3.5s3.879 1.168 5.168 2.457A13 13 0 0 1 14.828 8q-.086.13-.195.288c-.335.48-.83 1.12-1.465 1.755C11.879 11.332 10.119 12.5 8 12.5s-3.879-1.168-5.168-2.457A13 13 0 0 1 1.172 8z"></path>
                    <path d="M8 5.5a2.5 2.5 0 1 0 0 5 2.5 2.5 0 0 0 0-5M4.5 8a3.5 3.5 0 1 1 7 0 3.5 3.5 0 0 1-7 0"></path>
                  </svg>
                </div>

                <div class="col-12 col-md-6 mb-4">
                  <label for="gate_access_code">Gate Code (4 numbers)</label>
                  <input type="number" class="form-control" id="gate_access_code" name="gate_access_code" aria-describedby="Gate Access Code" placeholder="1234" maxlength="4" pattern="\d{4}" />
                </div>
                

                
                <div class="col-12">
                  <button type="button" class="button border-radius-4px" id="step4">
                    <span class="d-flex align-items-center">
                      Next
                      <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="white" class="bi bi-chevron-right border-radius-4px" viewBox="0 0 16 16">
                        <path fill-rule="evenodd" d="M4.646 1.646a.5.5 0 0 1 .708 0l6 6a.5.5 0 0 1 0 .708l-6 6a.5.5 0 0 1-.708-.708L10.293 8 4.646 2.354a.5.5 0 0 1 0-.708" />
                      </svg>
                    </span>
                  </button>
                </div>
                

              </div>
            </form>

          </div>
        </div>
      </div>
      


      
      <div class="accordion-item blue payment">
        <h2 class="accordion-header">
          <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapseFive" aria-expanded="false" aria-controls="collapseFive" id="collapseFiveToggle">
            <span class="h3">
              Payment
            </span>
          </button>
        </h2>

        <div id="collapseFive" class="accordion-collapse collapse" data-bs-parent="#accordionCheckout">
          <div class="accordion-body p-3 p-sm-4">

            <form id="formStep5">
              <div class="row">

                
                <div class="col-12 mb-4 pb-2">
                  <label for="Add Promo Code">
                    Add Promo Code
                  </label>

                  <fieldset name="DiscountPlan" class="row">
                    <div class="col-12 col-md-6 col-lg-8 mb-3 mb-md-0">
                      <input type="text" class="form-control" id="discount_code" name="discount_code" aria-describedby="Discount Code" placeholder="Enter Discount Code" />
                    </div>

                    <div class="col-12 col-md-6 col-lg-4">
                      <button type="button" class="button is-icon is-small is-black border-radius-4px h-100" id="applyDiscount">
                        Apply Discount

                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-percent" viewBox="0 0 16 16">
                          <path d="M13.442 2.558a.625.625 0 0 1 0 .884l-10 10a.625.625 0 1 1-.884-.884l10-10a.625.625 0 0 1 .884 0M4.5 6a1.5 1.5 0 1 1 0-3 1.5 1.5 0 0 1 0 3m0 1a2.5 2.5 0 1 0 0-5 2.5 2.5 0 0 0 0 5m7 6a1.5 1.5 0 1 1 0-3 1.5 1.5 0 0 1 0 3m0 1a2.5 2.5 0 1 0 0-5 2.5 2.5 0 0 0 0 5" />
                        </svg>
                      </button>
                    </div>
                  </fieldset>
                </div>

                <div class="col-12 mb-4 pb-3" id="updated_price">
                </div>
                

                
                <div class="col-12 mb-4">
                  <h5 class="lined-header">
                    Payment
                  </h5>
                </div>

                
                <div class="col-12 mb-2">
                  <ul class="nav nav-tabs" id="PaymentTab" role="tablist">
                    <li class="nav-item" role="presentation">
                      <button class="nav-link active font-weight-600" id="credit-card-tab" data-bs-toggle="tab" data-bs-target="#creditcardtab" type="button" role="tab" aria-controls="creditcardtab" aria-selected="true">
                        <div class="d-flex align-items-center gap-2">
                          <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-credit-card-2-front" viewBox="0 0 16 16">
                            <path d="M14 3a1 1 0 0 1 1 1v8a1 1 0 0 1-1 1H2a1 1 0 0 1-1-1V4a1 1 0 0 1 1-1zM2 2a2 2 0 0 0-2 2v8a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V4a2 2 0 0 0-2-2z" />
                            <path d="M2 5.5a.5.5 0 0 1 .5-.5h2a.5.5 0 0 1 .5.5v1a.5.5 0 0 1-.5.5h-2a.5.5 0 0 1-.5-.5zm0 3a.5.5 0 0 1 .5-.5h5a.5.5 0 0 1 0 1h-5a.5.5 0 0 1-.5-.5m0 2a.5.5 0 0 1 .5-.5h1a.5.5 0 0 1 0 1h-1a.5.5 0 0 1-.5-.5m3 0a.5.5 0 0 1 .5-.5h1a.5.5 0 0 1 0 1h-1a.5.5 0 0 1-.5-.5m3 0a.5.5 0 0 1 .5-.5h1a.5.5 0 0 1 0 1h-1a.5.5 0 0 1-.5-.5" />
                          </svg>
                          CREDIT CARD
                        </div>
                      </button>
                    </li>
                    <li class="nav-item" role="presentation">
                      <button class="nav-link font-weight-600" id="ach-tab" data-bs-toggle="tab" data-bs-target="#achtab" type="button" role="tab" aria-controls="achtab" aria-selected="false">
                        <div class="d-flex align-items-center gap-2">
                          <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-bank" viewBox="0 0 16 16">
                            <path d="m8 0 6.61 3h.89a.5.5 0 0 1 .5.5v2a.5.5 0 0 1-.5.5H15v7a.5.5 0 0 1 .485.38l.5 2a.498.498 0 0 1-.485.62H.5a.498.498 0 0 1-.485-.62l.5-2A.5.5 0 0 1 1 13V6H.5a.5.5 0 0 1-.5-.5v-2A.5.5 0 0 1 .5 3h.89zM3.777 3h8.447L8 1zM2 6v7h1V6zm2 0v7h2.5V6zm3.5 0v7h1V6zm2 0v7H12V6zM13 6v7h1V6zm2-1V4H1v1zm-.39 9H1.39l-.25 1h13.72z" />
                          </svg>
                          ACH <span class="d-none d-sm-inliine-block">PAYMENT</span>
                        </div>
                      </button>
                    </li>
                  </ul>

                  <div class="tab-content" id="PaymentTabContent">
                    
                    <div class="tab-pane fade show active p-3 p-lg-4 border-start border-end border-bottom background-white rounded-bottom" id="creditcardtab" role="tabpanel" aria-labelledby="credit-card-tab">
                      <div class="row">
                        
                        <div class="payment-options credit-card col-12">
                          <div class="row" id='credit-card-payment'>
                            <form id="formStep5Card">

                              <div class="col-12 col-md-6 mb-4">
                                <label for="Name On Card">Name On Card</label>
                                <input type="text" class="form-control" id="name_on_card" name="name_on_card" aria-describedby="NameOnCard" placeholder="Name On Card" />
                              </div>

                              <div class="col-12 col-md-6 mb-4">
                                <label for="CreditCardNumber">Credit Card Number</label>
                                <input type="text" class="form-control" id="card_number" name="card_number" aria-describedby="CreditCardNumber" placeholder="Credit Card Number" />
                              </div>

                              <div class="col-12 col-md-6 col-xl-4 mb-4">
                                <label for="Card Type">Card Type</label>
                                <select class="form-control" id="card_type" name="card_type">
                                  <option value="none" selected disabled>Select Type</option>
                                  <option value="mastercard">Mastercard</option>
                                  <option value="visa">Visa</option>
                                  <option value="americanexpress">American Express</option>
                                  <option value="discover">Discover</option>
                                </select>
                              </div>

                              <div class="col-6 col-xl-4 mb-4">
                                <label for="ExpirationDate">Expiration</label>
                                <input type="text" class="form-control" id="expiration_date" name="expiration_date" aria-describedby="ExpirationDate" placeholder="MM/YY" />
                              </div>

                              <div class="col-6 col-lg-4 mb-4">
                                <label for="CVCcode">CVC Code</label>
                                <input type="text" class="form-control" id="security_code" name="security_code" aria-describedby="Security Code" placeholder="ex. 918" />
                              </div>

                              <div class="col-12 mb-4">
                                <p class="text-size-tiny-14"> * By submitting this payment you are agreeing to enroll in auto-pay <p>
                              </div>

                              <div class="col-12 pb-1">
                                <button type="button" class="button border-radius-4px" id="submitButtonCard">
                                  Submit
                                </button>
                              </div>
                            </form>
                          </div>
                        </div>
                        

                      </div>
                    </div>
                    

                    
                    <div class="tab-pane fade p-3 p-lg-4 border-start border-end border-bottom background-white rounded-bottom" id="achtab" role="tabpanel" aria-labelledby="ach-tab">
                      <div class="row">
                        <form id="formStep5ACH">
                          
                          <div class="payment-options ach col-12">
                            <div class="row">

                              <div class="col-12 col-md-6 mb-4">
                                <label for="ACH First Name">First Name</label>
                                <input type="text" class="form-control" id="ach_first_name" name="ach_first_name" aria-describedby="ACH First Name" placeholder="ACH First Name" />
                              </div>

                              <div class="col-12 col-md-6 mb-4">
                                <label for="ACH Last Name">Last Name</label>
                                <input type="text" class="form-control" id="ach_last_name" name="ach_last_name" aria-describedby="ACH Last Name" placeholder="ACH Last Name" />
                              </div>

                              <div class="col-12 col-md-6 mb-4">
                                <label for="Bank Name">Bank Name</label>
                                <input type="text" class="form-control" id="ach_bank_name" name="ach_bank_name" aria-describedby="ACH Bank Name" placeholder="ACH Bank Name" />
                              </div>

                              <div class="col-12 col-md-6 mb-4">
                                <label for="Account Type">Account Type</label>
                                <select class="form-control" id="ach_account_type" name="ach_account_type">
                                  <option value="none" selected disabled>Choose Your Type</option>
                                  </option>
                                  <option value="CorpChecking">Business Checking</option>
                                  <option value="CorpSavings">Business Savings</option>
                                  <option value="Checking">Checking</option>
                                  <option value="Savings">Savings</option>
                                </select>
                              </div>

                              <div class="col-12 col-md-6 mb-4">
                                <label for="Account Number">Account Number</label>
                                <input type="text" class="form-control" id="ach_account_number" name="ach_account_number" aria-describedby="ACH Account Number" placeholder="ACH Account Number" />
                              </div>

                              <div class="col-12 col-md-6 mb-4">
                                <label for="Routing Number">Routing Number</label>
                                <input type="text" class="form-control" id="ach_routing_number" name="ach_routing_number" aria-describedby="ACH Routing Number" placeholder="ACH Routing Number" />
                              </div>

                              
                              <div class="col-12 mb-4">
                                <input type="checkbox" value="same_address" name="billing-address-checkbox" id="billing-address-checkbox" class="billing-address-checkbox me-1"> Is your billing address the same as your information above?
                              </div>

                              <div class="col-12 ach-different-billing-address" id="ach_alternate_address_form">
                                <div class="row">

                                  <div class="col-12 mb-4">
                                    <label for="Address ACH">Address</label>
                                    <input type="text" class="form-control" id="ach_address1" name="ach_address1" aria-describedby="Address ACH" placeholder="9321 Main Street" />
                                  </div>

                                  <div class="col-12 mb-4">
                                    <label for="Address2">Address 2</label>
                                    <input type="text" class="form-control" id="ach_address2" name="ach_address2" aria-describedby="Address2 ACH" placeholder="Apartment, studio, floor, etc" />
                                  </div>

                                  <div class="col-12 col-md-6 mb-4">
                                    <label for="City ACH">City</label>
                                    <input type="text" class="form-control" id="ach_city" name="ach_city" aria-describedby="City ACH" placeholder="City" />
                                  </div>

                                  <div class="col-12 col-md-6 mb-4">
                                    <label for="State ACH">State</label>
                                    <select class="form-control" id="ach_state" name="ach_state">
                                      <option value="none" selected disabled>Choose Your State</option>
                                      <option value="AL">Alabama</option>
                                      <option value="AK">Alaska</option>
                                      <option value="AZ">Arizona</option>
                                      <option value="AR">Arkansas</option>
                                      <option value="CA">California</option>
                                      <option value="CO">Colorado</option>
                                      <option value="CT">Connecticut</option>
                                      <option value="DE">Delaware</option>
                                      <option value="DC">District Of Columbia</option>
                                      <option value="FL">Florida</option>
                                      <option value="GA">Georgia</option>
                                      <option value="HI">Hawaii</option>
                                      <option value="ID">Idaho</option>
                                      <option value="IL">Illinois</option>
                                      <option value="IN">Indiana</option>
                                      <option value="IA">Iowa</option>
                                      <option value="KS">Kansas</option>
                                      <option value="KY">Kentucky</option>
                                      <option value="LA">Louisiana</option>
                                      <option value="ME">Maine</option>
                                      <option value="MD">Maryland</option>
                                      <option value="MA">Massachusetts</option>
                                      <option value="MI">Michigan</option>
                                      <option value="MN">Minnesota</option>
                                      <option value="MS">Mississippi</option>
                                      <option value="MO">Missouri</option>
                                      <option value="MT">Montana</option>
                                      <option value="NE">Nebraska</option>
                                      <option value="NV">Nevada</option>
                                      <option value="NH">New Hampshire</option>
                                      <option value="NJ">New Jersey</option>
                                      <option value="NM">New Mexico</option>
                                      <option value="NY">New York</option>
                                      <option value="NC">North Carolina</option>
                                      <option value="ND">North Dakota</option>
                                      <option value="OH">Ohio</option>
                                      <option value="OK">Oklahoma</option>
                                      <option value="OR">Oregon</option>
                                      <option value="PA">Pennsylvania</option>
                                      <option value="RI">Rhode Island</option>
                                      <option value="SC">South Carolina</option>
                                      <option value="SD">South Dakota</option>
                                      <option value="TN">Tennessee</option>
                                      <option value="TX">Texas</option>
                                      <option value="UT">Utah</option>
                                      <option value="VT">Vermont</option>
                                      <option value="VA">Virginia</option>
                                      <option value="WA">Washington</option>
                                      <option value="WV">West Virginia</option>
                                      <option value="WI">Wisconsin</option>
                                      <option value="WY">Wyoming</option>
                                    </select>
                                  </div>

                                  <div class="col-12 col-md-6 mb-4 pb-2">
                                    <label for="Zip ACH">Zipcode</label>
                                    <input type="text" class="form-control" id="ach_postal" name="ach_postal" aria-describedby="Postal ACH" placeholder="Zipcode" />
                                  </div>

                                  <div class="col-12 col-md-6 mb-4">
                                    <label for="Country ACH">Country</label>
                                    <select class="form-control" id="ach_country" name="ach_country">
                                      <option value="none" selected disabled>Choose Your Country</option>
                                      <option value="US">United States</option>
                                      <option value="CA">Canada</option>
                                    </select>
                                  </div>

                                </div>
                              </div>

                              <div class="col-12 mb-4">
                                <p class="text-size-tiny-14"> * By submitting this payment you are agreeing to enroll in auto-pay <p>
                              </div>

                              <div class="col-12 pb-1">
                                <button type="button" class="button border-radius-4px" id="submitButtonACH">
                                  Submit
                                </button>
                              </div>

                              <script>
                                $('.ach-different-billing-address').show();
                                $('.billing-address-checkbox').click(function() {
                                  if ($(this).is(':checked')) {
                                    $('.ach-different-billing-address').hide();
                                  } else {
                                    $('.ach-different-billing-address').show();
                                  }
                                });
                              </script>
                              

                            </div>
                          </div>
                          
                        </form>
                      </div>
                    </div>
                    
                  </div>
                </div>
                
                
              </div>
            </form>

          </div>
        </div>
      </div>
      

      
      <div class="accordion-item e-sign">
        <h2 class="accordion-header">
          <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapseSix" aria-expanded="false" aria-controls="collapseSix" id="collapseSixToggle" disabled>
            <span class="h3">
              E-Sign Documents
            </span>
          </button>
        </h2>

        <div id="collapseSix" class="accordion-collapse collapse" data-bs-parent="#accordionCheckout">
          <div class="accordion-body p-3 p-sm-4">

            <form>
              <div class="row">

                
                <div class="col-12 iframe-container" id="hellosign-container" style="display: none">
                  <iframe id="hellosign-embed" src="" width="100%" height="800"></iframe>
                </div>
                

              </div>
            </form>

          </div>
        </div>
      </div>
      

      
      <div id="responseComponent" class="mt-4"></div>
      

    </div>
    


  </div><!-- end row -->
</div><!-- end container -->


<script  src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>


<!-- <script src="https://cdn.jsdelivr.net/npm/pikaday/pikaday.js"></script>
<link rel="stylesheet" type="text/css" href="https://cdn.jsdelivr.net/npm/pikaday/css/pikaday.css"> -->

<!-- pikaday css override -->
<!-- <style>
.pika-button {
  color: #000000;
  background: #e5e5e5;
}

.is-disabled .pika-button,
.is-inrange .pika-button {
  background: #f1f1f1;
}
</style> -->


<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
<script src="https://ajax.googleapis.com/ajax/libs/jqueryui/1.12.1/jquery-ui.min.js"></script>
<link rel="stylesheet" href="https://ajax.googleapis.com/ajax/libs/jqueryui/1.12.1/themes/smoothness/jquery-ui.css">



<script type='text/javascript'>
  const BASE_URL_2 = '<?php echo get_site_url(); ?>';
  document.addEventListener("DOMContentLoaded", function() {
  // Fetch the maximum days in the future from the API
  fetch(`${BASE_URL_2}/wp-admin/admin-ajax.php?action=days_in_future_api`).then((res) => res.json()).then((data) => {
    const moveInDateInput = document.getElementById('desired_move_in_date');
    const maxDaysInFuture = data || 1;

    // Get today's date and format it
    const today = new Date();
    const formattedToday = today.toISOString().split('T')[0];

    // Calculate the maximum date and format it
    const maxDate = new Date();
    maxDate.setDate(today.getDate() + maxDaysInFuture);
    const formattedMaxDate = maxDate.toISOString().split('T')[0];

    // Set the min and max attributes
    moveInDateInput.min = formattedToday;
    moveInDateInput.max = formattedMaxDate;

    // Add event listener to store selected date in local storage
    moveInDateInput.addEventListener('change', function() {
      // Parse the selected date and adjust for timezone offset
      const selectedDate = new Date(this.value);
      const localDate = new Date(selectedDate.getTime() + selectedDate.getTimezoneOffset() * 60000);
      localDate.setHours(0, 0, 0, 0); // Normalize to start of the day

      const esignAccordion = document.querySelector('.accordion-item.e-sign');
      const paymentAccordion = document.querySelector('.accordion-item.payment');

      if (isFutureBooking) {
        esignAccordion.style.display = 'none';
        paymentAccordion.style.setProperty('border-bottom', '1px solid #b5b9be', 'important');
        paymentAccordion.style.setProperty('border-radius', '0 0 8px 8px', 'important');
        paymentAccordion.style.setProperty('overflow', 'hidden', 'important');
      } else {
        esignAccordion.style.display = 'block';
        paymentAccordion.style.removeProperty('border-bottom');
        paymentAccordion.style.removeProperty('border-radius');
        paymentAccordion.style.removeProperty('overflow');
      }
    });

    // Initial check to show or hide the e-sign documents accordion and add border to Payment
    const initialMoveInDate = moveInDateInput.value;
    const isFutureBooking = initialMoveInDate !== formattedToday;
    localStorage.setItem('isFutureBooking', isFutureBooking);
    const esignAccordion = document.querySelector('.accordion-item.e-sign');
    const paymentAccordion = document.querySelector('.accordion-item.payment');

    if (isFutureBooking) {
      esignAccordion.style.display = 'none';
      paymentAccordion.style.setProperty('border-bottom', '1px solid #b5b9be', 'important');
      paymentAccordion.style.setProperty('border-radius', '0 0 8px 8px', 'important');
      paymentAccordion.style.setProperty('overflow', 'hidden', 'important');
    } else {
      esignAccordion.style.display = 'block';
      paymentAccordion.style.removeProperty('border-bottom');
      paymentAccordion.style.removeProperty('border-radius');
      paymentAccordion.style.removeProperty('overflow');
    }
  });
});
</script>


<script>
  const baseUrl = '<?php echo get_site_url(); ?>';
  document.addEventListener("DOMContentLoaded", function() {
    var companyName = <?php echo json_encode(get_field('company_name', 'option')); ?>;
    const wlsScript = new WlsScript(document, baseUrl, companyName)
    wlsScript.init()
  });
</script>



<script type="text/javascript" src="https://cdn.jsdelivr.net/npm/toastify-js"></script>

<script>
  $('.accordion-collapse').on('shown.bs.collapse', function(e) {
    var $panel = $(this).closest('.accordion-item');
    $('html,body').animate({
      scrollTop: $panel.offset().top
    }, 500);
  });
</script>
<?php /**PATH /Users/bengross/Local Sites/white-label-storage-b2c/app/public/wp-content/themes/sage-10/resources/views/partials/checkout-full-form.blade.php ENDPATH**/ ?>