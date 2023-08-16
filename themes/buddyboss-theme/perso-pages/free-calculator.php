<?php
/**
 * Template name: free calculator
 *
 * @package BuddyBoss_Theme
 */

get_header();
global $wpdb;?>

<br><br><br>

<!--
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
-->
<link href="https://cdn.jsdelivr.net/npm/bootstrap-4-grid@3.4.0/css/grid.min.css" rel="stylesheet" >
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js" integrity="sha384-IQsoLXl5PILFhosVNubq5LC7Qb9DXgDA9i+tQ8Zj3iwWAwPtgFTxbJ8NT4GN1R8p" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.min.js" integrity="sha384-cVKIPhGWiC2Al4u+LWgxfKTRIcfu0JTxR+EQDz/bgldoEyl4H0zUF0QKbrJ0EcQF" crossorigin="anonymous"></script>


<div id="primary" class="content-area">

    <main id="main" class="site-main">            
        
        <h1><?php echo $post->post_title; ?> </h1>           
      
        <div class="row">
            <div class='col-sm-12'>
                <p style='font-size: 15px'>Free anaerobic digestion calculator! You will get information on biogas production, biogas utilization, potential revenue and cost, preliminary mass balance, GHG reduction and more.</p>
                <br>
                <p style='font-size: 15px'>Minimal tonnage for accurancy is over 30 000 wet tons per year</p>
            </div>
        </div>
        <div id='Calculations' class='form'>
            <h3 style="padding-top:25px">Feedstocks</h3>
            <?php for ($i= 1; $i <= 3 ; $i++) { ?>
            <div class='row'>
                <div class='col-sm-4 Colone'>
                    <label>Feedstock <?php echo $i; ?> <?php if ($i == 1) {echo "*";}  ?> </label>
                    <select name="Feedstock_<?php echo $i; ?>" id="Feedstock_<?php echo $i; ?>"  data-feedstockid="<?php echo $i; ?>"  <?php if ($i == 1) {echo "required";}  ?> class='Feedstocks form-control'  style='width: 100%'  >
                        <option value="" selected="selected"> </option>
                        <option value="Chicken_broiler">Chicken broiler</option>
                        <option value="Chicken_layer">Chicken layer</option>
                        <option value="Cow_manure">Cow manure</option>
                        <option value="Cow_slurry">Cow slurry (dairy)</option>
                        <option value="Fat_oils">Fat, oils and grease (FOG)</option>
                        <option value="Garden_waste">Garden waste</option>
                        <option value="Oat_Hulls">Oat Hulls</option>
                        <option value="Organic_waste_ICI">Organic waste from ICI</option>
                        <option value="Pig_manure">Pig manure</option>
                        <option value="Cheese_whey">Cheese whey</option>
                        <option value="SSO_DRY_25">Residential source sorted organic (SSO) - DRY (25%TS)</option>
                        <option value="SSO_DRY_35">Residential source sorted organic (SSO) - DRY (35%TS)</option>
                        <option value="SSO_WET">Residential source sorted organic (SSO) - WET</option>
                        <option value="Unsorted_Waste">Unsorted Waste</option>
                        <option value="Vegetable_waste">Vegetable waste</option>
                        <option value="WWTP_5">WWTP sludge (5%TS)</option>
                        <option value="WWTP_30">WWTP sludge (30%TS)</option>
                    </select>
                </div>
                <div class='col-sm-2 Colone'>
                    <label>Tons/yr <?php if ($i == 1) {echo "*";}  ?></label>
                    <input type="text" name="Quantity_<?php echo $i; ?>" id="Quantity_<?php echo $i; ?>" <?php if ($i == 1) {echo "required";}  ?>  style='width: 100%' value="0" class="form-control" min="0">
                </div>
                <div class='col-sm-2'>
                    <label>%TS</label>
                    <input type='number' readonly id="TS_<?php echo $i; ?>" class='Private form-control' value='0' >
                </div>
                <div class='col-sm-2 Colone'>
                    <label>%VS</label>
                    <input type='number' readonly id="VS_<?php echo $i; ?>" class='Private form-control' value='0'>
                </div>
                <div class='col-sm-2 Colone'>
                    <label>BMP</label>
                    <input type='number' readonly id="BMP_<?php echo $i; ?>" class='Private form-control' value='0'>
                </div>
            </div>
            <?php } ?>
            <h3 style="padding-top:25px">BIOGAS PLANT OPTIONS</h3>
            <div class="row">
                <div class='col-sm-4 Colone'>
                    <p>Plant Type *</p>
                    <select name="Plant_Type" id="Plant_Type" required  style='width: 100%'   class="form-control">
                        <option value="" class=""></option>
                        <option value="Industrial" class="">Industrial</option>
                        <option value="Agricultural" class="">Agricultural</option>
                        <option value="Municipal" selected="selected" class="">Municipal</option>
                    </select>
                </div>
                <div class='col-sm-4 Colone'>
                    <p>Biogas Usage *</p>
                    <select name="Biogas_Usage" id="Biogas_Usage" required  style='width: 100%'   class="form-control">
                        <option value="CHP (combined heat and power)" selected="selected" class="">CHP (combined heat and power)</option>
                        <option value="Heat (boiler)" class="">Heat (boiler)</option>
                        <option value="Biomethane to grid" class="">Biomethane to grid</option>
                    </select>
                </div>
                <div class='col-sm-4 Colone'>
                    <p>Digestate usage *</p>
                    <select name="Digestate_Usage" id="Digestate_Usage" required  style='width: 100%'   class="form-control">
                        <option value="" class="">  </option>
                        <option value="Compost" class="">Compost</option>
                        <option value="Drying" class="">Drying</option>
                        <option value="Dehydrating" class="">Dehydrating</option>
                        <option value="Directly to land" selected="selected" class="">Directly to land</option>
                    </select>
                </div>
                <div class='col-sm-4 Colone'>
                    <p>Digester Type *</p>
                    <select name="Digester_Type" id="Digester_Type" required  style='width: 100%'  class="form-control">
                        <option value="1" selected="selected" class="">Wet</option>
                        <option value="0.8" class="">Dry</option>
                    </select>
                </div>
                <div class='col-sm-4 Colone'>
                    <p>%Contaminants *</p>
                    <input type="number" name="Contaminants" id="Contaminants" required value="5"  style='width: 100%' class="form-control" min='0'>
                </div>
            </div>
            <h3 style="padding-top:25px">BIOGAS PLANT OPTIONS</h3>
            <div class='row'>
                <div class='col-sm-4 Colone'>
                    <p>Diesel cost ($/L)</p>
                    <input type="number" name="Diesel_Cost" id="Diesel_Cost" required value="1.2" class="form-control" min="0" step="0.1">
                </div>
                <div class='col-sm-4 Colone'>
                    <p>Electricity cost - $/kWh(e)</p>
                    <input type="number" name="Electricity_Cost" id="Electricity_Cost" required value="0.07" class="form-control" min="0" step="0.1">
                </div>
                <div class='col-sm-4 Colone'>
                    <p>Natural gas cost - $/GJ</p>
                    <input type="number" name="Natural_Gas_Cost" id="Natural_Gas_Cost" required value="5" class="form-control" min="0" step="0.1">
                </div>
            </div>
            <h3 style="padding-top:25px">CONTACT INFORMATION</h3>
            <div class='row'>
                <div class='col-sm-4 Colone'>
                    <p>Last Name *</p>
                    <input name="Last_Name" id='Last_Name' required style='width: 100%' class="form-control">
                </div>
                <div class='col-sm-4 Colone'>
                    <p>First Name *</p>
                    <input name="First_Name" id='First_Name' required style='width: 100%' class="form-control">
                </div>
                <div class='col-sm-4 Colone'>
                    <p>City *</p>
                    <input name="City" id='City' required style='width: 100%' class="form-control">
                </div>
                <div class='col-sm-6 Colone'>
                    <p>Country *</p>
                    <input name="Location" id='Location' required style='width: 100%' class="form-control">
                </div>
                <div class='col-sm-6 Colone'>
                    <p>Project Name *</p>
                    <input name="Project_Name" id='Project_Name' required style='width: 100%' class="form-control">
                </div>
                <div class='col-sm-6 Colone'>
                    <p>Email*</p>
                    <input type='email' name="Email" id='Email' required style='width: 100%' class="form-control">
                </div>
                <div class='col-sm-6 Colone'>
                    <p>Phone Number</p>
                    <input name="Phone" id='Phone'  style='width: 100%' class="form-control">
                </div>
            </div>
            <div class='row'>
                <div class='col-sm-12 Colone'>
                    <p style='margin-bottom: 25px;'>Usage terms and conditions *</p>
                    <p style='margin: 20px 0px;'>By selecting the check box, you confirm that you have read and fully agree with the Terms and Conditions Agreement found below</p>
                    <textarea style="min-width: 100%;max-width: 100%;min-height: 150px;" class="form-control" name="" id="" rows="1" readonly="readonly" data-frmval="This biogas web calculator and its results CANNOT be used for commercial use without explicit written consent from BiogasWorld Media Inc. If BiogasWorld Media Inc. discovers that you have used this calculator or results for your own profit, you are concious that we may  take legal actions against you. ---- LIMITATION ON LIABILITY--- The client AGREE THAT IN NO EVENT SHALL BiogasWorld Media inc. BE LIABLE TO the client OR ANY THIRD PARTY FOR ANY DIRECT OR INDIRECT DAMAGE WHATSOEVER INCLUDING, WITHOUT LIMITATION, DAMAGES OF A CONSEQUENTIAL, INCIDENTAL, PUNITIVE OR SPECIAL NATURE, LOSS OF BUSINESS, GOODWILL, PROFITS OR DATA, THAT MAY ARISE WITH RESPECT TO THE USE OF THIS BIOGAS WEB CACULATOR OR ITS RESULTS WHETHER ARISING OUT OF NEGLIGENCE, TORT, BREACH OF CONTRACT OR OTHER LEGAL THEORY, EVEN IF BiogasWorld Media inc. HAD BEEN INFORMED OF THE POSSIBILITY OF SUCH DAMAGES" style='width: 100%;min-height: 100px'>This biogas web calculator and its results CANNOT be used for commercial use without explicit written consent from BiogasWorld Media Inc. If BiogasWorld Media Inc. discovers that you have used this calculator or results for your own profit, you are concious that we may  take legal actions against you. ---- LIMITATION ON LIABILITY--- The client AGREE THAT IN NO EVENT SHALL BiogasWorld Media inc. BE LIABLE TO the client OR ANY THIRD PARTY FOR ANY DIRECT OR INDIRECT DAMAGE WHATSOEVER INCLUDING, WITHOUT LIMITATION, DAMAGES OF A CONSEQUENTIAL, INCIDENTAL, PUNITIVE OR SPECIAL NATURE, LOSS OF BUSINESS, GOODWILL, PROFITS OR DATA, THAT MAY ARISE WITH RESPECT TO THE USE OF THIS BIOGAS WEB CACULATOR OR ITS RESULTS WHETHER ARISING OUT OF NEGLIGENCE, TORT, BREACH OF CONTRACT OR OTHER LEGAL THEORY, EVEN IF BiogasWorld Media inc. HAD BEEN INFORMED OF THE POSSIBILITY OF SUCH DAMAGES</textarea>
                    <label  ><input type="checkbox" id='Agreement' style='margin-top: 25px;'>I agree to Terms and Conditions</label>
                </div>
            </div>
            <div class='row'>
                <div class='col-sm-12 Colone'>
                    <p style='margin-bottom: 25px;'>Communication conditions *</p>
                    <textarea style="min-width: 100%;max-width: 100%;min-height: 150px;    margin-bottom: 15px;" class="form-control" name="" id="" rows="1" readonly="readonly" data-frmval="BiogasWorld is committed to protecting and respecting your privacy, and we’ll only use your personal information to administer your account and to provide the products and services you requested from us. From time to time, we would like to contact you about our products and services, as well as other content that may be of interest to you. If you consent to us contacting you for this purpose, please tick below:" style='width: 100%;min-height: 100px'>BiogasWorld is committed to protecting and respecting your privacy, and we’ll only use your personal information to administer your account and to provide the products and services you requested from us. From time to time, we would like to contact you about our products and services, as well as other content that may be of interest to you. If you consent to us contacting you for this purpose, please tick below.</textarea>
                    <label ><input type="checkbox" id='Agreement_Communication'>I agree to receive communications from BiogasWorld</label>
                </div>
            </div>
            <div class='row'>
                <div class='col-sm-12 Colone'>
                    <button id="Confirm" class="bouttonbgw">Calculate</button>
                </div>
            </div>
        </div>
        <div class='row'>
            <div class='col-sm-12'>
                <div id='Rslt'></div>
            </div>
        </div>
        
	</main><!-- #main -->

</div><!-- #primary -->

   
<?php get_footer(); ?> 


<style type="text/css">header{height:fit-content!important}@media only screen and (max-width:600px){.content{width:100%}[class*=col-sm-]{width:100%!important}}input{width:100%}.content{width:calc(100% - 350px)}.form-control:focus{color:#495057;background-color:#fff;border-color:#80bdff;outline:0;box-shadow:0 0 0 .2rem rgba(0,123,255,.25)}.form-control{display:block;width:100%;height:calc(1.5em + .75rem + 2px);padding:.375rem .75rem;font-size:1rem;font-weight:400;line-height:1.5;color:#495057;background-color:#fff;background-clip:padding-box;border:1px solid #ced4da;border-radius:.25rem;transition:border-color .15s ease-in-out,box-shadow .15s ease-in-out}.Private{border:none;background-color:#ececef}.Private:focus{border-color:#ced4da!important;box-shadow:none!important;background-color:#ececef!important}.row{display:-ms-flexbox;display:flex;-ms-flex-wrap:wrap;flex-wrap:wrap;margin-right:-15px;margin-left:-15px}.Colone{margin-bottom:25px}.bouttonbgw{background:#00d37d;color:#fff!important;border:none;padding:10px 30px;border-radius:25px;margin-left:50%;transform:translateX(-50%);margin-top:25px}.bouttonbgw:hover{background:#000daa;cursor:pointer}.linkbgw{background:#00d37d;color:#fff!important;border:none;padding:10px 30px;border-radius:25px;margin-top:25px}.linkbgw:hover{background:#000daa;cursor:pointer}div#Rslt{font-size:15px}.Chiffre{color:#000daa}</style>
