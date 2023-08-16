<?php
/**
 * Template name: import from biogasworld
 *
 * @package BuddyBoss_Theme
 */

get_header();
global $wpdb;?>

<br><br><br>

<!--
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">

-->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js" integrity="sha384-IQsoLXl5PILFhosVNubq5LC7Qb9DXgDA9i+tQ8Zj3iwWAwPtgFTxbJ8NT4GN1R8p" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.min.js" integrity="sha384-cVKIPhGWiC2Al4u+LWgxfKTRIcfu0JTxR+EQDz/bgldoEyl4H0zUF0QKbrJ0EcQF" crossorigin="anonymous"></script>


<div id="primary" class="content-area">

    <main id="main" class="site-main">            
        
        <h1><?php echo $post->post_title; ?> </h1>   
        
        <?php 

            

            if ( isset($_POST['submit'] )) {
                if ($_POST['option'] === 'bids') {
                    require_once(get_template_directory().'/import-from-biogasworld/import-bids.php');
                }
                if ($_POST['option'] === 'events') {
                    require_once(get_template_directory().'/import-from-biogasworld/import-events.php');
                }
                if ($_POST['option'] === 'jobs') {
                    require_once(get_template_directory().'/import-from-biogasworld/import-jobs.php');
                }
                
            }


            //add_option( 'last_bids_import_date', date('Y-m-d H:i:s'), '', 'yes' );
            
        ?>
        <div class="row">

            
            

            <h5>Please select the section to import </h5>
            <form method="POST">
                
                <div class="mb-3">
                        <select class="form-select" aria-label="Default select example" name="option" id="option">
                            <option selected>Open this select menu</option>
                            <option value="bids">Bids</option>
                            <option value="events">Events</option>
                            <option value="jobs">Jobs</option>
                        </select>
                    
                    <button type="submit" name='submit' class="btn btn-primary" style="margin-top: 30px;">Submit</button>
                </div>
            </form>
        </div>

        <h4 id='last_update' style="color: red;"></h4>

        <script>
            jQuery(document).ready(function () {
                $('#option').change(function (e) { 
                    if ($(this).val()=='bids') {
                        $("#last_update").text('Last update on : <?= get_option('last_bids_import_date');?>');    
                    }
                    if ($(this).val()=='events') {
                        $("#last_update").text('Last update on : <?= get_option('last_events_import_date');?>');    
                    }
                    if ($(this).val()=='jobs') {
                        $("#last_update").text('Last update on : <?= get_option('last_career_jobs_import_date');?>');    
                    }
                    if($(this).val()=='careers'){
                        $("#last_update").text('');    
                    }
                    
                    
                });
            });
        </script>
        

        </div>
		</main><!-- #main -->
	</div><!-- #primary -->

   
<?php
get_footer();
?> 