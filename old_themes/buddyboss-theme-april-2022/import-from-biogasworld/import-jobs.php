<h3 id="titre" style="text-transform: uppercase;"></h3>
<ul>
<?php       

        $url = "https://biogasworld.com/wp-json/v1/careers";
        global $wpdb;

        //call api
        $json = file_get_contents($url);
        $json = json_decode($json);
    
        $date_args = array(
            'post_type'   =>  'career_jobs',
            'posts_per_page' => -1,                
            'post_status' => 'publish'               
        );
    
        $query = new WP_Query( $date_args );                 
        $query = $query->posts;
    
        $i = 0 ;
        $compteur_ajoutes=0;
    
        foreach ($query as $key => $value) {
            $old_jobs[$value->ID]['title'] = $value->post_title;
            $old_jobs[$value->ID]['closing'] = get_field("Closing_Date", $value->ID);                
        }            

        $jobs = $wpdb->get_results( 
            $wpdb->prepare("SELECT ID FROM `wp_posts` WHERE `post_type` = '%s' AND `post_status`='%s'", 'career_jobs','publish') 
        );

        foreach ($jobs as $value) {
            $all_existing_BGW_Ids[] = intval( $value->ID ); 
        }

        foreach ($all_existing_BGW_Ids as $value) {

            $aa = $wpdb->get_results( 
                $wpdb->prepare("SELECT `meta_value` FROM `wp_postmeta` WHERE `post_id` = %d AND `meta_key` LIKE '%s'", $value,'biogasworld_id') 
            );
    
            if ( count($aa) > 0 ) {
                
                if ( strlen($aa[0]->meta_value > 0 ) ) {
                    $Old_BGW_Ids[] = intval($aa[0]->meta_value);
                }   
            }
        }            


        $i = 0;

        echo '<ul>';

        foreach ($json->result as $new_job) {
            
         
            
            foreach ($old_jobs as $key => $old_job) {

                if ( preg_replace("/\s+/", "", $new_job->Job_Title) == preg_replace("/\s+/", "", $old_job['title']) && preg_replace("/\s+/", "", $new_job->Closing_Date) == preg_replace("/\s+/", "", $old_job['closing']) ) {
                    $duplicate_check = 1;                        
                    break;
                }else{
                    $duplicate_check = 0;                        
                }               
            }

            if($duplicate_check==1){

                $exclude_bids[] = $new_event->id;

            }
            else{ 

                if ( !in_array($new_job->ID ,$Old_BGW_Ids) ) {
                    
                    $compteur_ajoutes++;

                    $post_data = array(
                        'post_title'    => $new_job->Job_Title,
                        'post_type'     => 'career_jobs',
                        'post_status'   => 'publish'
                    );    

                    $post_id = wp_insert_post( $post_data );                            
                    
                    //company               field_60f5906fa11eb
                    $field_key = "field_60f5906fa11eb";                
                    $value = $new_job->Company_Name;
                    update_field( $field_key, $value, $post_id );
                    
                    //deadline  field_60f59106a11ef
                    $field_key = "field_60f59106a11ef";                
                    $value = date('Y-m-d',strtotime($new_job->Closing_Date));               
                    update_field( $field_key, $value, $post_id );                
                    
                    //location              field_60f59102a11ee
                    $field_key = "field_60f59102a11ee";                
                    $value = $new_job->Country.' '.$new_job->Country;
                    update_field( $field_key, $value, $post_id );

                    //job domain            field_60f59096a11ec
                    $field_key = "field_60f59096a11ec";                
                    $value = $new_job->Domain;
                    update_field( $field_key, $value, $post_id );

                    //link to opportunity   field_60f590efa11ed
                    $field_key = "field_60f590efa11ed";                
                    $value = $new_job->Web_Link;
                    update_field( $field_key, $value, $post_id );

                    //languages             field_60f59112a11f0
                    $field_key = "field_60f59112a11f0";                
                    $tmpData = unserialize($new_job->Languages);
                    $value = "";
                    foreach ($tmpData as $val) {
                        $value .= $val.' ';
                    }                    
                    update_field( $field_key, $value, $post_id );

                    //job description       field_60f59134a11f1
                    $field_key = "field_60f59134a11f1";                
                    $value = $new_job->Job_Description;
                    update_field( $field_key, $value, $post_id );
                    
                    //responsabilities      field_60f59141a11f2
                    $field_key = "field_60f59141a11f2";                
                    $tmpData = unserialize($new_job->Responsabilities);
                    $value = "<ul>";
                    foreach ($tmpData as $val) {
                        $value .= '<li>'.$val.'</li>';
                    }
                    $value .='</ul>';
                    update_field( $field_key, $value, $post_id );

                    //qualifications        field_60f59168a11f3
                    $field_key = "field_60f59168a11f3";                
                    $tmpData = unserialize($new_job->Qualifications);
                    $value = "<ul>";
                    foreach ($tmpData as $val) {
                        $value .= '<li>'.$val.'</li>';
                    }
                    $value .='</ul>';
                    update_field( $field_key, $value, $post_id );      
                    
                    //how to apply          field_6154969742aea
                    $field_key = "field_6154969742aea";                
                    $value = 'Please contact by email <a href="'.$new_job->Email.'">'.$new_job->Email.'</a> or by calling '.$new_job->Phone_Number;
                    update_field( $field_key, $value, $post_id );
                    
                    //bgw id                field_616d72f2e83d4 
                    $field_key = "field_616d72f2e83d4";                
                    $value = $new_job->ID;
                    update_field( $field_key, $value, $post_id );

                    //Company Description   field_617301c8cb5df
                    $field_key = "field_617301c8cb5df";                
                    $value = $new_job->Company_Description;
                    update_field( $field_key, $value, $post_id );

                    //Company Name          field_617301d6cb5e0
                    $field_key = "field_617301d6cb5e0";                
                    $value = $new_job->Company_Name;
                    update_field( $field_key, $value, $post_id );                   
                    
                    echo '<li>'.$new_job->Job_Title.'</li>';

                    //tags                  field_60f8542780816
                }
            }

        }

        $query = $wpdb->prepare("
                            DELETE a.*
                            FROM wp_posts AS a
                            INNER JOIN (
                                SELECT post_title, MIN( id ) AS min_id
                                FROM wp_posts
                                WHERE post_type = career_jobs
                                AND post_status = 'publish'
                                GROUP BY post_title
                                HAVING COUNT( * ) > 1
                            ) AS b ON b.post_title = a.post_title
                            AND b.min_id <> a.id
                            AND a.post_type = career_jobs
                            AND a.post_status = 'publish'
                            ",  '' 
                            ) ;
    
        $results = $wpdb->query( $query );

        date_default_timezone_set('America/Toronto'); 

        update_option('last_career_jobs_import_date',  date('Y-m-d H:i:s'));



?>

</ul>

<script>
    jQuery(document).ready(function () {
        var titre = "";
        <?php if ( $compteur_ajoutes==0 ) :?>
            titre = "No job added";
        <?php else:?>
            titre = "<?=$compteur_ajoutes?> jobs added";
        <?php endif; ?>        
        $("#titre").html(titre);
    });
</script>