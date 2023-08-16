<?php
/**
 * Template name: industry library add form
 *
 * @package BuddyBoss_Theme
 */

get_header();
global $wpdb;?>

<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-grid-only@1.0.0/bootstrap.css">

<style>
    .inpuuts{
        width:100%;
    }
    .col-lg-6{
        padding:10px;
        height:125px;
    }

</style>

<div id="primary" class="content-area">

    <main id="main" class="site-main">            
        
        <h1 style="text-transform: uppercase;"><?php echo $post->post_title; ?> </h1>   

        <?php   

         

        ?>
        <div class="row loading" style="display:none">
            <div class="col-lg-12" style="height:100%;display: flex;justify-content: center;align-items: center;">
                <img src="https://www.biogascommunity.com/wp-content/uploads/2021/10/rotateLogo.gif" alt="" style="">
            </div>
        </div>
        
        <div class="row">
            <div class="col-lg-12">
                <h1 id="msg"></h1>
            </div>
        </div>
        <form action="#" method="post" enctype="multipart/form-data" name="form" id="submit-form" novalidate >
        
            <div class="row">  
                <div class="col-lg-12">
                    <h4> </h4>
                </div>
            </div>

            <div class="row">

                <div class="col-lg-6">
                    <p for="report_title">Report Title</p>
                    <input type="text" name="report_title" id='report_title'  class="form-control inpuuts" required="Report Title required" />
                    <span class='error' id='report_title_error'></span>
                </div> 

                <div class="col-lg-6">
                    <p for="author_name">Author Name</p>
                    <input type="text" name="author_name" id='author_name'  class="form-control inpuuts" required="Author Name required" />
                    <span class='error' id='author_name_error'></span>
                </div> 

                <div class="col-lg-6">
                    <p for="year">Year</p>
                    <input type="text" name="year"  id="year" class="form-control inpuuts" required="Year required" />
                    <span class='error' id='year_error'></span>
                </div> 

                <div class="col-lg-6">
                    <p for="year">Country</p>
                    <select class="form-control inpuuts" name="country" id='country' required="Country required" >
                        <?php include get_template_directory().'/inc/countriesList.php'; ?>
                    </select>
                    <span class='error' id='country_error'></span>                    
                </div>


                <div class='col-sm-12'>
                  <p for="tags">Tags</p>
                  <input type="text" name="tags[]" id='tags_1' class='List_input'>
                  <span id='Add_Tag'> + Add another tag</span>
                </div>               


            </div>

            <div class="row">
                <div class="col-lg-6" >
                    <p for="year">Does the file have a URL (No need to upload ?)</p>
                    <select class="form-control inpuuts" name="Uploading" id='Uploading' required="Uploading required" >
                        <option value="YES">YES</option>       
                        <option value="NO">NO</option>                                         
                    </select>               
                    <span class='error' id='Uploading_error'></span>     
                </div>

                <div class="col-lg-6 file_url" style='display:block' >
                    <p for="file_url" >File URL</p>
                    <input type="text" name="file_url" id="file_url"  class="form-control inpuuts" />
                    <span class='error' id='file_url_error'></span>     
                </div>

                <div class="col-lg-6 file"  style='display:none'>
                    <p  for="file" class="control-label">Upload documentation</p>
                    <input name="file"  type="file" id="file"  class="inputfile" required  > 
                    <span class='error' id='file_error'></span>     
                </div>

                <div class="col-lg-12">                             
                    <div class="droite" style=" text-align:left;">
                        <input type="submit" name = 'submit'  id = 'submit' value="ADD BID" class="bouttonbgw "/>
                    </div>                  
                </div>


                
            </div>

        </form>


        <script type="text/javascript">

            jQuery(document).ready(function () {

                var Resp_Count = 1;
                                
                jQuery( "#Add_Tag" ).click(function() {                    
                    jQuery( " <input type='text' name='tags[]' id='tags_"+(Resp_Count+1)+"' class='List_input'>" ).insertAfter( "#tags_"+Resp_Count );
                    Resp_Count = Resp_Count + 1;
                    console.log(Resp_Count);
                });
                
            });

			jQuery(function($) {

                

                $("#Uploading").change(function (e) {  

                    if ($(this).val()=="NO") {
                        $("#file").prop('required',true);
                        $("#file_url").prop('required',false);
                        $('.file').show();
                        $('.file_url').hide(); 
                    } else {
                        $("#file").prop('required',false);
                        $("#file_url").prop('required',true);
                        $('.file').hide();
                        $('.file_url').show(); 
                    }                  
                
                    

                });



              
				jQuery("#submit-form").submit(function() {

                    event.preventDefault();
                  
                    $('.error').html('');
                  
    		        
			        form_data = new FormData();
			        form_data.append('dataform', $(this).serialize());
    		        form_data.append('action', 'upload_new_library_file');

                    if ($('#file').prop('files')[0]) {
                        form_data.append('dataform', $('#file').prop('files')[0]);    
                    }                        

                    console.log(form_data);
					$.ajax({
					    
                        url: "<?= admin_url( 'admin-ajax.php' );?>",
					    type: 'POST',
					    contentType: false,
					    processData: false,
					    data: form_data,
					    
                        beforeSend: function() {
                            $(".loading").toggle();
                            $("#submit-form").toggle();    
                            $("#msg").html(''); 
                        },
						
                        
                        success: function(response) {
                            
                            response = response.replace('0', '');
                            console.log(response);
                            

                            var data = JSON.parse(response);
                            
							if (data.success) {
                                $(".loading").toggle();
                                $("#msg").text(data.message);
                                $('#msg').css({'color':'#00d37d'});
                                $("#submit-form").toggle();

                                $("form#submit-form :input").each(function(){
                                    $(this).val(''); 
                                });
                                
						    } else {

                                if (data.inputs_errors) {
                                    $.each(data.ids, function (ind, val) {  
                                        if($(this).prop('id')!='submit'){
                                            $("#"+ind).html(val);
                                        }                                       
                                        
                                    });
                                }
                                $(".loading").toggle();
                                $("#msg").text(data.message);
                                $('#msg').css({'color':'red'});
                                $("#submit-form").toggle();
							}
                            
						}

					});
										
				});

			});
						
					
		</script>
                    
                
		</main><!-- #main -->
	</div><!-- #primary -->

   
<?php
get_footer();
?> 
