<h3 id="titre" style="text-transform: uppercase;"></h3>
<ul>

<?php



    $url = "https://biogasworld.com/wp-json/v1/bids?api_key=85wefzfc-ef47-4934-b350-u5979e0ax581&from_date=".$_POST["from_date"];



    //call api
    $json = file_get_contents($url);
    $json = json_decode($json);

    $date_args = array(
        'post_type'   =>  array( 'bid', 'funding','bid-private' ),                
        'posts_per_page' => -1,                
        'post_status' => 'publish'               
    );

    $query = new WP_Query( $date_args );                 
    $query = $query->posts;

    $i = 0 ;
    $compteur_ajoutes=0;

    foreach ($query as $key => $value) {
        $old_bids[$value->ID]['title'] = $value->post_title;
        $old_bids[$value->ID]['closing'] = get_field("closing_date", $value->ID);                
    }

    $fieldGroup = acf_get_field_group(295);
    $fields = acf_get_fields_by_id(295);

    global $wpdb;

    $bids = $wpdb->get_results( 
        $wpdb->prepare("SELECT ID FROM `wp_posts` WHERE `post_type` = '%s' AND `post_status`='%s'", 'bid','publish') 
    );

    $funding = $wpdb->get_results( 
        $wpdb->prepare("SELECT ID FROM `wp_posts` WHERE `post_type` = '%s' AND `post_status`='%s'", 'funding','publish') 
    );

    $private_bids = $wpdb->get_results( 
        $wpdb->prepare("SELECT ID FROM `wp_posts` WHERE `post_type` = '%s' AND `post_status`='%s'", 'bid-private','publish') 
    );

    foreach ($bids as $value) {
        $all_existing_BGW_Ids[] = intval( $value->ID ); 
    }
    foreach ($funding as $value) {
        $all_existing_BGW_Ids[] = intval( $value->ID ); 
    }
    foreach ($private_bids as $value) {
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
    
    

    
    
    foreach ($json->result as $new_bid) {

        foreach ($old_bids as $key => $old_bid) {

            if ( preg_replace("/\s+/", "", $new_bid->Title) == preg_replace("/\s+/", "", $old_bid['title']) && preg_replace("/\s+/", "", $new_bid->End_Date) == preg_replace("/\s+/", "", $old_bid['closing']) ) {
                $duplicate_check = 1;                        
                break;
            }else{
                $duplicate_check = 0;                        
            }               
        }


        if ( !in_array($new_bid->ID ,$Old_BGW_Ids) ) {


            if($duplicate_check==1){
                $exclude_bids[] = $new_bid->ID;
                
            }else{       
                
                $compteur_ajoutes++;

                $category = str_replace('Biogas & RNG Systems','Biogas and Upgrading Systems',$new_bid->Topics);
    
                
                if ($category == 'Funding Opportunities') {
                    $post_type = 'funding';
                }else{
                    $post_type = 'bid';
                }
                if($new_bid->Biogas_Bid == 'YES'){
                    $post_type = 'bid-private';
                }
    
                $post_data = array(
                    'post_title'    => $new_bid->Title,                
                    'post_type'     => $post_type,                
                    'post_status'   => 'publish'                
                );
            
                $post_id = wp_insert_post( $post_data );    
                
                //closing date
                $field_key = "field_6079c707ea692";                
                $value = date('Y-m-d',strtotime($new_bid->End_Date));               
                update_field( $field_key, $value, $post_id );                
            
                //category
                $field_key = "field_607b3a28b6816";                
                $value = $category;
                update_field( $field_key, $value, $post_id );                
            
                //description
                $field_key = "field_6079c735ea693";                                    
                $value = $new_bid->Description;          
                update_field( $field_key, $value, $post_id );                
            
                //organization
                $field_key = "field_6079c744ea694";               
                $value = $new_bid->Organization;
                update_field( $field_key, $value, $post_id );                
            
                //country
                $field_key = "field_6079c74bea695";               
                $value = $new_bid->Country;
                update_field( $field_key, $value, $post_id );                
            
                //contact name
                $field_key = "field_6079c765ea696";                
                $value = $new_bid->FName." ".$new_bid->LName;      
                update_field( $field_key, $value, $post_id );                
                
                //email
                $field_key = "field_6079c776ea697";               
                $value = $new_bid->Email;
                update_field( $field_key, $value, $post_id );                
            
                //url
                $field_key = "field_6079d4928082b";
                $value = $new_bid->URL;
                update_field( $field_key, $value, $post_id );                
                
                //tags
                $field_key = "field_60e8645e20529";                
                $value = $new_bid->Topics;              
                update_field( $field_key, $value, $post_id );
                
                //description
                $field_key = "field_6155ad2367b8b";                                    
                $value = $new_bid->ID;          
                update_field( $field_key, $value, $post_id );  

                echo '<li>'.$new_bid->Title.'</li>';


                
            } //if($duplicate_check==1)

        }//if ( in_array($new_bid->ID ,$Old_BGW_Ids) )

        
    }
    
    echo '</ul>';


    $types = ['bid','funding','bid-private'];

    foreach ($types as $key => $value) {

        $query = $wpdb->prepare("
                                DELETE a.*
                                FROM wp_posts AS a
                                INNER JOIN (
                                    SELECT post_title, MIN( id ) AS min_id
                                    FROM wp_posts
                                    WHERE post_type = ".$value."
                                    AND post_status = 'publish'
                                    GROUP BY post_title
                                    HAVING COUNT( * ) > 1
                                ) AS b ON b.post_title = a.post_title
                                AND b.min_id <> a.id
                                AND a.post_type = ".$value."
                                AND a.post_status = 'publish'
                            ",  '' ) ;
        $results = $wpdb->query( $query );
    }

    date_default_timezone_set('America/Toronto'); 

    update_option('last_bids_import_date',  date('Y-m-d H:i:s'));

    //echo '<h4 style="color:#00d37d">Bids Successfully imported</h4>'; 

?>


</ul>
<script>
    jQuery(document).ready(function () {
        var titre = "";
        <?php if ( $compteur_ajoutes==0 ) :?>
            titre = "No bid added";
        <?php else:?>
            titre = "<?=$compteur_ajoutes?> bids added";
        <?php endif; ?>        
        $("#titre").html(titre);
    });
</script>