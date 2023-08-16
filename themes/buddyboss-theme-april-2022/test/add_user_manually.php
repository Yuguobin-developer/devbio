<?php
/**
 * Template name: add user manually
 *
 * @package BuddyBoss_Theme
 */

get_header();
global $wpdb;
$pswd = wp_generate_password(16,1,1);?>

<?php 
  $tags = $wpdb->get_results("SELECT name FROM `wp_bp_xprofile_fields` WHERE `parent_id` = 21 ORDER BY `wp_bp_xprofile_fields`.`name` ASC");
?>


<!-- Style pour loadDiv -->
<style>
    .containerLoading{position:fixed;top:0;left:0;right:0;bottom:0;text-align:center;background:#eee}.containerLoading:before{content:"";height:100%;display:inline-block;vertical-align:middle}.containerLoading .spinner-frame{display:inline-block;vertical-align:middle;width:100px;height:100px;border-radius:50%;position:relative;overflow:hidden;border:5px solid #fff;padding:10px}.containerLoading .spinner-frame .spinner-cover{background:#fff;width:100%;height:100%;border-radius:50%;position:relative;z-index:2}.containerLoading .spinner-frame .spinner-bar{background:#29d;width:50%;height:50%;position:absolute;top:0;left:0;border-radius:100% 0 0 0;-webkit-animation:spinny 2s linear infinite;transform-origin:100% 100%}@-webkit-keyframes spinny{0%{transform:rotate(0);background:#063}50%{transform:rotate(180deg);background:#063}100%{transform:rotate(360deg);background:#063}}.loadDiv{display:none}*{box-sizing:border-box}.wrapper-1{width:100%;height:100vh;display:flex;flex-direction:column}.wrapper-2{padding:30px;text-align:center}h1{font-family:'Kaushan Script',cursive;font-size:4em;letter-spacing:3px;color:#063;margin:0;margin-bottom:20px}.wrapper-2 p{margin:0;font-size:1.3em;color:#aaa;font-family:'Source Sans Pro',sans-serif;letter-spacing:1px}.add-another{color:#fff;background:#063;border:none;padding:10px 50px;margin:30px 0;border-radius:30px;text-transform:capitalize}@media (min-width:360px){h1{font-size:4.5em}.go-home{margin-bottom:20px}}@media (min-width:600px){.content{max-width:1000px;margin:0 auto}.wrapper-1{height:initial;max-width:620px;margin:0 auto;margin-top:50px}.wrapper-1{display:none}}
</style>

<!-- Style pour containerLoading -->
<style>          
    .containerLoading{width:100%;height:150px;position:relative;background:#f2f2f2;display:none}.span-container{width:100px;height:100px;margin-left:50%;transform:translateX(-75%);position:absolute}span.anim{display:block;position:absolute;width:40%;height:40%;border-radius:50%;animation:speed 2s infinite ease-in-out}.first.anim{background:#006632;animation-delay:1.67s}.second.anim{background:#25945c;animation-delay:1.34s}.third.anim{background:#0f7c44;animation-delay:1s}.fourth.anim{background:#004c25;animation-delay:.66s}.fifth.anim{background:#002e17;animation-delay:.33s}.sixth.anim{background:#006632}@keyframes speed{0%{transform:translate(0,-75%);border-radius:50%}16%{transform:translate(125%,-150%);border-radius:50%}33%{transform:translate(250%,-75%);border-radius:50%}50%{transform:translate(250%,75%);border-radius:50%}67%{transform:translate(125%,150%);border-radius:50%}83%{transform:translate(0,75%);border-radius:50%}100%{transform:translate(0,-75%);border-radius:50%}}
</style>

<link href="https://fonts.googleapis.com/css?family=Kaushan+Script|Source+Sans+Pro" rel="stylesheet">

<div id="primary" class="content-area">

    <main id="main" class="site-main">            

        <h1><?php echo $post->post_title; ?> </h1>   

        <div class="loadDiv">
            <div class="containerLoading" > <!--There's the container that centers it-->
                <div class="spinner-frame"> <!--The background-->
                    <div class="spinner-cover"></div> <!--The Foreground-->
                    <div class="spinner-bar"></div> <!--and The Spinny thing-->
                </div>
            </div>  
        </div>

        

        <div class="containerLoading">
          <div class="span-container">
            <span class="first anim"></span>
            <span class="second anim"></span>
            <span class="third anim"></span>
            <span class="fourth anim"></span>
            <span class="fifth anim"></span>
            <span class="sixth anim"></span>
          </div>

        </div>

        <div class="form_wrapper">

            <div class="form_container">

                <div class="title_container">
                    <h2>Admin Register Members</h2>
                </div>


                <div class="row clearfix">

                    <div class="">

                        <form  method="post" id="submit-form" enctype="multipart/form-data" name="form" >

                            <div class="input_field"> 
                                <input type="email" name="email" placeholder="Email" required value="AAA@gmail.com"/>
                                <span class="error" id="error_email"></span>
                            </div>
                            <div class="input_field"> <span><i aria-hidden="true" class="fa fa-lock"></i></span>
                                <input type="text" name="password" placeholder="Password" required value="<?= $pswd; ?>" />
                            </div>
                           
                            <div class="row clearfix">
                                <div class="col_half">
                                    <div class="input_field"> <span><i aria-hidden="true" class="fa fa-user"></i></span>
                                        <input type="text" name="companyName" placeholder="Company Name" value="companyName"/>
                                        <span class="error" id="error_company"></span>
                                    </div>
                                </div>
                                <div class="col_half">
                                    <div class="input_field"> <span><i aria-hidden="true" class="fa fa-user" ></i></span>
                                        <input type="text" name="FName" placeholder="First Name"  value="FName"/>
                                    </div>
                                </div>
                                <div class="col_half">
                                    <div class="input_field"> <span><i aria-hidden="true" class="fa fa-user"></i></span>
                                        <input type="text" name="LName" placeholder="Last Name" required   value="LName"/>
                                    </div>
                                </div>
                            </div>
                           
                            <div class="input_field select_option">
                                <select required name="accountType">
                                    <option value="Standard Project Support">Standard Project Support</option>
                                    <option value="Associations">Associations</option>
                                    <option value="Business basic">Business basic</option>
                                    <option value="Business premium">Business premium</option>
                                    <option value="Business standard">Business standard</option>
                                    <option value="Individual plan basic">Individual plan basic</option>
                                    <option value="Individual plan free">Individual plan free</option>
                                    <option value="Plant owners – Free">Plant owners – Free</option>
                                    <option value="Plant owners – Project support">Plant owners – Project support</option>
                                </select>
                                <div class="select_arrow"></div>
                            </div>


                            <div class="input_field select_option">
                              <label for="start">Start date:</label>
                              <input type="date" name="endDate" min="<?= date('Y-m-d'); ?>"  value="<?= date('Y-m-d',strtotime(date("Y-m-d", mktime()) . " + 365 day")); ?>" >
                            </div>

                            <div class="row clearfix" style="margin-top:25px">

                              <h3 id='Tags'>Tags <span id='arrowDown'>  &#9660;</span> <span id='arrowUp'>  &#9650; </span></h3>
                              <div id="tagsdiv">
                                <table id="tagsTable">
                                  <thead><th></th></thead>
                                  <? foreach ($tags as $key => $value) : ?>
                                    <tr>
                                      <td>
                                        <div class="input_field">
                                          <input type="checkbox" name="tags[]" value="<?= $value->name ;?>" />
                                          <label for="scales"><?= $value->name ;?></label>
                                        </div>
                                      </td>
                                    </tr>
                                  <? endforeach; ?>
                                </table>
                              </div>
                            </div>
                            
                           
                            <input type="submit" class="button" value="Register" style="margin-left:50%;transform:translateX(-50%)">
                        </form>
                    </div>
                </div>
            </div>
        </div>


        <div class="wrapper-1">
            <div class="wrapper-2">

                <h1>It worked !</h1>
                <h3>User has been successfully added span</h3>
                <span id="successMessage"></span>
                <a href="https://www.biogascommunity.com/test-2/">
                    <button class="add-another">Add another</button>
                </a>
            </div>
            
        </div>

        



        <script src="https://cdn.datatables.net/1.11.5/js/jquery.dataTables.min.js"></script>

        <script>

          jQuery(document).ready(function() {
              $('#tagsTable').DataTable({
                "pageLength": 200
              });
          } );


          jQuery(function($) {

            jQuery(document).ready(function(){
              $( "#Tags" ).click(function() {
                $("#tagsdiv").toggle("slow");
                $("#arrowUp").toggle("fast");
                $("#arrowDown").toggle("fast");
              });              
            });

              jQuery("#submit-form").submit(function() {

                  event.preventDefault();
                  form_data = new FormData();
                  form_data.append('dataform', $(this).serialize());
                  form_data.append('action', 'add_user_community_action');
                  var files_errors = [];
                  var files_errors_image = [];
                  $(".text-danger").text('');

                  $.ajax({                     

                    url: " <?= admin_url( 'admin-ajax.php' ); ?>",
                    type: 'POST',
                    contentType: false,
                    processData: false,
                    data: form_data,
                    beforeSend: function() {
                        
                        //$(".loadDiv").show();
                        
                        $(".containerLoading").show();
                        
                        $(".form_wrapper").hide();
                        
                    },
                    success: function(response) {
                      
                        //$(".loadDiv").show();
                        //$(".loadDiv").hide("slow");
                        $(".containerLoading").hide("slow");


                      var data = JSON.parse(response);
                      
                      if (data.success) {
                        console.log(response);

                        $(".wrapper-1").show("slow");
                        
                    
                        $('#successMessage').html(          
                                '<p>You can edit profile (sub-accounts etc)  <a href="https://www.biogascommunity.com/wp-admin/user-edit.php?user_id='+data.userID+'&wp_http_referer=%2Fwp-admin%2Fusers.php%3Fdelete_count%3D1%26update%3Ddel" target="_blank">here</a></p>'+
                                '<p>You can edit extended profile (picture etc)  <a href="https://www.biogascommunity.com/wp-admin/users.php?page=bp-profile-edit&user_id='+data.userID+'&wp_http_referer=%2Fwp-admin%2Fusers.php%3Fdelete_count%3D1%26update%3Ddel" target="_blank">here</a></p>'+
                                '<p>You can edit the subscription <a href="https://www.biogascommunity.com/wp-admin/admin.php?page=memberpress-subscriptions&action=edit&id='+data.sub_id+'" target="_blank">here</a></p>'+
                                '<p>You can edit the Transcation <a href="https://www.biogascommunity.com/wp-admin/admin.php?page=memberpress-trans&action=edit&id='+data.txn_id+'" target="_blank">here</a></p>'
                            );

                      }else{
                        $(".form_wrapper").show("slow");
                        jQuery.each(data, function(i, val) {  
                          if (i != 'success') {
                            $('#'+i).html(val);        
                          }    
                          
                        });
                      }                      
                    }
                  });
              });
            });
        </script>



	</main><!-- #main -->
</div><!-- #primary -->


<style>
    #arrowUp,#arrowDown{font-size: small;}
            
    #arrowUp,div#tagsdiv{display: none;}

    div#tagsTable_info,div#tagsTable_paginate,div#tagsTable_length{display:none}
    
    td.sorting_1 {
      padding: 0px !important;
    }
    
    #tagsdiv{border: 1px solid #dedfe2;    padding: 20px;    border-radius: 15px;}

    #Tags:hover{color:#063;}

    #Tags{cursor: pointer;}

    input, select {
        margin: 15px 0px;
        width: 101%;
    }

    body {
      font-family: Verdana, Geneva, sans-serif;
      font-size: 14px;
      background: #f2f2f2;
    }
    .clearfix {
      &:after {
        content: "";
        display: block;
        clear: both;
        visibility: hidden;
        height: 0;
      }
    }
    .form_wrapper {
      background: #fff;
      width: 500px;
      max-width: 100%;
      box-sizing: border-box;
      padding: 25px;
      margin: 1% auto 0;
      position: relative;
      z-index: 1;
      border-top: 5px solid #063;
      -webkit-box-shadow: 0 0 3px rgba(0, 0, 0, 0.1);
      -moz-box-shadow: 0 0 3px rgba(0, 0, 0, 0.1);
      box-shadow: 0 0 3px rgba(0, 0, 0, 0.1);
      -webkit-transform-origin: 50% 0%;
      transform-origin: 50% 0%;
      -webkit-transform: scale3d(1, 1, 1);
      transform: scale3d(1, 1, 1);
      -webkit-transition: none;
      transition: none;
      -webkit-animation: expand 0.8s 0.6s ease-out forwards;
      animation: expand 0.8s 0.6s ease-out forwards;
      opacity: 0;
      h2 {
        font-size: 1.5em;
        line-height: 1.5em;
        margin: 0;
      }
      .title_container {
        text-align: center;
        padding-bottom: 15px;
      }
      h3 {
        font-size: 1.1em;
        font-weight: normal;
        line-height: 1.5em;
        margin: 0;
      }
      label {
        font-size: 12px;
      }
      .row {
        margin: 10px -15px;
        > div {
          padding: 0 15px;
          box-sizing: border-box;
        }
      }
      .col_half {
        width: 50%;
        float: left;
      }
      .input_field {
        position: relative;
        margin-bottom: 20px;
        -webkit-animation: bounce 0.6s ease-out;
        animation: bounce 0.6s ease-out;
        > span {
          position: absolute;
          left: 0;
          top: 0;
          color: #333;
          height: 100%;
          border-right: 1px solid $grey;
          text-align: center;
          width: 30px;
          > i {
            padding-top: 10px;
          }
        }
      }
      .textarea_field {
        > span {
          > i {
            padding-top: 10px;
          }
        }
      }
      input {
        &[type="text"],
        &[type="email"],
        &[type="password"] {
          width: 100%;
          padding: 8px 10px 9px 35px;
          height: 35px;
          border: 1px solid $grey;
          box-sizing: border-box;
          outline: none;
          -webkit-transition: all 0.3s ease-in-out;
          -moz-transition: all 0.3s ease-in-out;
          -ms-transition: all 0.3s ease-in-out;
          transition: all 0.3s ease-in-out;
        }
        &[type="text"]:hover,
        &[type="email"]:hover,
        &[type="password"]:hover {
          background: #fafafa;
        }
        &[type="text"]:focus,
        &[type="email"]:focus,
        &[type="password"]:focus {
          -webkit-box-shadow: 0 0 2px 1px rgba(255, 169, 0, 0.5);
          -moz-box-shadow: 0 0 2px 1px rgba(255, 169, 0, 0.5);
          box-shadow: 0 0 2px 1px rgba(255, 169, 0, 0.5);
          border: 1px solid $yellow;
          background: #fafafa;
        }
        &[type="submit"] {
          background: $yellow;
          height: 35px;
          line-height: 35px;
          width: 100%;
          border: none;
          outline: none;
          cursor: pointer;
          color: #fff;
          font-size: 1.1em;
          margin-bottom: 10px;
          -webkit-transition: all 0.3s ease-in-out;
          -moz-transition: all 0.3s ease-in-out;
          -ms-transition: all 0.3s ease-in-out;
          transition: all 0.3s ease-in-out;
          &:hover {
            background: darken($yellow, 7%);
          }
          &:focus {
            background: darken($yellow, 7%);
          }
        }
        &[type="checkbox"],
        &[type="radio"] {
          border: 0;
          clip: rect(0 0 0 0);
          height: 1px;
          margin: -1px;
          overflow: hidden;
          padding: 0;
          position: absolute;
          width: 1px;
        }
      }
    }
    .form_container {
      .row {
        .col_half.last {
          border-left: 1px solid $grey;
        }
      }
    }
    .checkbox_option {
      label {
        margin-right: 1em;
        position: relative;
        &:before {
          content: "";
          display: inline-block;
          width: 0.5em;
          height: 0.5em;
          margin-right: 0.5em;
          vertical-align: -2px;
          border: 2px solid $grey;
          padding: 0.12em;
          background-color: transparent;
          background-clip: content-box;
          transition: all 0.2s ease;
        }
        &:after {
          border-right: 2px solid black;
          border-top: 2px solid black;
          content: "";
          height: 20px;
          left: 2px;
          position: absolute;
          top: 7px;
          transform: scaleX(-1) rotate(135deg);
          transform-origin: left top;
          width: 7px;
          display: none;
        }
      }
      input {
        &:hover + label:before {
          border-color: $black;
        }
        &:checked + label {
          &:before {
            border-color: $black;
          }
          &:after {
            -moz-animation: check 0.8s ease 0s running;
            -webkit-animation: check 0.8s ease 0s running;
            animation: check 0.8s ease 0s running;
            display: block;
            width: 7px;
            height: 20px;
            border-color: $black;
          }
        }
      }
    }
    .radio_option {
      label {
        margin-right: 1em;
        &:before {
          content: "";
          display: inline-block;
          width: 0.5em;
          height: 0.5em;
          margin-right: 0.5em;
          border-radius: 100%;
          vertical-align: -3px;
          border: 2px solid $grey;
          padding: 0.15em;
          background-color: transparent;
          background-clip: content-box;
          transition: all 0.2s ease;
        }
      }
      input {
        &:hover + label:before {
          border-color: $black;
        }
        &:checked + label:before {
          background-color: $black;
          border-color: $black;
        }
      }
    }
    .select_option {
      position: relative;
      width: 100%;
      select {
        display: inline-block;
        width: 100%;
        height: 35px;
        padding: 0px 15px;
        cursor: pointer;
        color: #7b7b7b;
        border: 1px solid $grey;
        border-radius: 0;
        background: #fff;
        appearance: none;
        -webkit-appearance: none;
        -moz-appearance: none;
        transition: all 0.2s ease;
        &::-ms-expand {
          display: none;
        }
        &:hover,
        &:focus {
          color: $black;
          background: #fafafa;
          border-color: $black;
          outline: none;
        }
      }
    }
    .select_arrow {
      position: absolute;
      top: calc(50% - 4px);
      right: 15px;
      width: 0;
      height: 0;
      pointer-events: none;
      border-width: 8px 5px 0 5px;
      border-style: solid;
      border-color: #7b7b7b transparent transparent transparent;
    }

    .select_option select {
      &:hover + .select_arrow,
      &:focus + .select_arrow {
        border-top-color: $black;
      }
    }
    .credit {
      position: relative;
      z-index: 1;
      text-align: center;
      padding: 15px;
      color: $yellow;
      a {
        color: darken($yellow, 7%);
      }
    }

    @-webkit-keyframes check {
      0% {
        height: 0;
        width: 0;
      }
      25% {
        height: 0;
        width: 7px;
      }
      50% {
        height: 20px;
        width: 7px;
      }
    }

    @keyframes check {
      0% {
        height: 0;
        width: 0;
      }
      25% {
        height: 0;
        width: 7px;
      }
      50% {
        height: 20px;
        width: 7px;
      }
    }

    @-webkit-keyframes expand {
      0% {
        -webkit-transform: scale3d(1, 0, 1);
        opacity: 0;
      }
      25% {
        -webkit-transform: scale3d(1, 1.2, 1);
      }
      50% {
        -webkit-transform: scale3d(1, 0.85, 1);
      }
      75% {
        -webkit-transform: scale3d(1, 1.05, 1);
      }
      100% {
        -webkit-transform: scale3d(1, 1, 1);
        opacity: 1;
      }
    }

    @keyframes expand {
      0% {
        -webkit-transform: scale3d(1, 0, 1);
        transform: scale3d(1, 0, 1);
        opacity: 0;
      }
      25% {
        -webkit-transform: scale3d(1, 1.2, 1);
        transform: scale3d(1, 1.2, 1);
      }
      50% {
        -webkit-transform: scale3d(1, 0.85, 1);
        transform: scale3d(1, 0.85, 1);
      }
      75% {
        -webkit-transform: scale3d(1, 1.05, 1);
        transform: scale3d(1, 1.05, 1);
      }
      100% {
        -webkit-transform: scale3d(1, 1, 1);
        transform: scale3d(1, 1, 1);
        opacity: 1;
      }
    }

    @-webkit-keyframes bounce {
      0% {
        -webkit-transform: translate3d(0, -25px, 0);
        opacity: 0;
      }
      25% {
        -webkit-transform: translate3d(0, 10px, 0);
      }
      50% {
        -webkit-transform: translate3d(0, -6px, 0);
      }
      75% {
        -webkit-transform: translate3d(0, 2px, 0);
      }
      100% {
        -webkit-transform: translate3d(0, 0, 0);
        opacity: 1;
      }
    }

    @keyframes bounce {
      0% {
        -webkit-transform: translate3d(0, -25px, 0);
        transform: translate3d(0, -25px, 0);
        opacity: 0;
      }
      25% {
        -webkit-transform: translate3d(0, 10px, 0);
        transform: translate3d(0, 10px, 0);
      }
      50% {
        -webkit-transform: translate3d(0, -6px, 0);
        transform: translate3d(0, -6px, 0);
      }
      75% {
        -webkit-transform: translate3d(0, 2px, 0);
        transform: translate3d(0, 2px, 0);
      }
      100% {
        -webkit-transform: translate3d(0, 0, 0);
        transform: translate3d(0, 0, 0);
        opacity: 1;
      }
    }

    @media (max-width: 600px) {
      .form_wrapper {
        .col_half {
          width: 100%;
          float: none;
        }
      }
      .bottom_row {
        .col_half {
          width: 50%;
          float: left;
        }
      }
      .form_container {
        .row {
          .col_half.last {
            border-left: none;
          }
        }
      }
      .remember_me {
        padding-bottom: 20px;
      }
    }

</style>


<?php

get_footer();
?> 



