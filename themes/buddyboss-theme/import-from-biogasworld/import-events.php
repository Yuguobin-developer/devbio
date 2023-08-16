<h3 id="titre" style="text-transform: uppercase;"></h3>
<ul>
<?php 

    $url = "https://biogasworld.com/wp-json/v1/events?api_key=85wefzfc-ef47-4934-b350-u5979e0ax581&from_date=".$_POST["from_date"];

    //call api
    $json = file_get_contents($url);
    $json = json_decode($json);
    
    $date_args = array(
                        'post_type'   =>  array( 'event', 'funding','bid-private' ),
                        'posts_per_page' => -1,
                        'post_status' => 'publish'       
                    );

    $query = new WP_Query( $date_args ); 
    $query = $query->posts;

    $i = 0 ;
    $compteur_ajoutes=0;

    foreach ($query as $key => $value) {
        $old_events[$value->ID]['title'] = $value->post_title;
        $old_events[$value->ID]['closing'] = get_field("closing_date", $value->ID);
    }


    global $wpdb;
    $events = $wpdb->get_results( 
        $wpdb->prepare("SELECT ID FROM `wp_posts` WHERE `post_type` = '%s' AND `post_status`='%s'", 'event','publish') 
    );

    foreach ($events as $value) {
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


    foreach ($json->result as $new_event) {

        foreach ($old_events as $key => $old_event) {

            if ( preg_replace("/\s+/", "", $new_event->Title) == preg_replace("/\s+/", "", $old_event['title']) && preg_replace("/\s+/", "", $new_event->End_Date) == preg_replace("/\s+/", "", $old_event['closing']) ) {
                $duplicate_check = 1;
                break;
            }else{
                $duplicate_check = 0;
            }       
        }


        if ( !in_array($new_event->id ,$Old_BGW_Ids) ) {

            if($duplicate_check==1){

                $exclude_bids[] = $new_event->id;

            }
            else{       
                
                $compteur_ajoutes++;

                $post_data = array(
                    'post_title'    => $new_event->Title,
                    'post_type'     => 'event',
                    'post_content'  => $new_event->Description,
                    'post_status'   => 'publish'
                );
        
                $post_id = wp_insert_post( $post_data );    

                //event banner
                $field_key = "field_6165b37f940d9";    
                $value = $new_event->Banner_Picture;  
                update_field( $field_key, $value, $post_id ); 

                //event picture
                $field_key = "field_6165b38d940da";    
                $value = $new_event->Event_Picture;  
                update_field( $field_key, $value, $post_id ); 

                //start date
                $field_key = "field_614d3df4a5343";
                $value = date('Y-m-d',strtotime($new_event->Start_Date));       
                update_field( $field_key, $value, $post_id ); 

                //end date
                $field_key = "field_614d3e27a5344";
                $value = date('Y-m-d',strtotime($new_event->End_Date));       
                update_field( $field_key, $value, $post_id ); 

                //Multiday
                $field_key = "field_614d3e7aab6c5";    
                $value = $new_event->Multiday;  
                update_field( $field_key, $value, $post_id ); 

                //Biogasworld ID
                $field_key = "field_61658e53543ab";    
                $value = $new_event->id;  
                update_field( $field_key, $value, $post_id ); 


                if ( !strlen($new_event->City)>0 ) {
                    //Event Location
                    $field_key = "field_60bd744d3f251";    
                    $value = $new_event->Country;
                    update_field( $field_key, $value, $post_id );
                }else{
                    //Event Location
                    $field_key = "field_60bd744d3f251";    
                    $value = $new_event->City.", ".$new_event->Country;
                    update_field( $field_key, $value, $post_id );
                }
                

                //Event Website
                $field_key = "field_60bd74893f252";  
                $value = $new_event->Website;
                update_field( $field_key, $value, $post_id );


                //Discount Code Name
                $field_key = "field_60e31b240995e";  
                $value = $new_event->Reduction_Msg;
                update_field( $field_key, $value, $post_id );

                //Discount Code 
                $field_key = "field_60e31b1a0995d";  
                $value = $new_event->PromoCode;
                update_field( $field_key, $value, $post_id );

                if ($new_event->Multiday != 'YES') {
                    
                    //Start Time
                    $field_key = "field_614d3ee0ab6c7";    
                    $value = $new_event->Start_Time;  
                    update_field( $field_key, $value, $post_id ); 

                    //End Time
                    $field_key = "field_614d3f13ab6c8";    
                    $value = $new_event->Ends_Time;  
                    update_field( $field_key, $value, $post_id ); 

                    //event date
                    $field_key = "field_60bd73fa3f24f";
                    $value = date('Y-m-d',strtotime($new_event->Start_Date));       
                    update_field( $field_key, $value, $post_id ); 

                    //Event Time
                    $field_key = "field_60bd74373f250";    
                    $value = "from ".$new_event->Start_Time."to ".$new_event->Ends_Time;
                    update_field( $field_key, $value, $post_id );
                    
                }else{
                    //event date
                    $field_key = "field_60bd73fa3f24f";
                    $value = "from ".date('Y-m-d',strtotime($new_event->Start_Date))." to ".date('Y-m-d',strtotime($new_event->End_Date));
                    update_field( $field_key, $value, $post_id ); 

                    
                }


                echo "<li>".$new_event->Title."</li>";

            } //if($duplicate_check==1)

        }//if ( in_array($new_event->ID ,$Old_BGW_Ids) )


    }



    $query = $wpdb->prepare("
                            DELETE a.*
                            FROM wp_posts AS a
                            INNER JOIN (
                                SELECT post_title, MIN( id ) AS min_id
                                FROM wp_posts
                                WHERE post_type = event
                                AND post_status = 'publish'
                                GROUP BY post_title
                                HAVING COUNT( * ) > 1
                            ) AS b ON b.post_title = a.post_title
                            AND b.min_id <> a.id
                            AND a.post_type = event
                            AND a.post_status = 'publish'
                            ",  '' 
                            ) ;
    
    $results = $wpdb->query( $query );

    date_default_timezone_set('America/Toronto'); 

    update_option('last_events_import_date',  date('Y-m-d H:i:s'));

   

?>

</ul>
<script>
    jQuery(document).ready(function () {
        var titre = "";
        <?php if ( $compteur_ajoutes==0 ) :?>
            titre = "No event added";
        <?php else:?>
            titre = "<?=$compteur_ajoutes?> events added";
        <?php endif; ?>        
        $("#titre").html(titre);
    });
</script>

