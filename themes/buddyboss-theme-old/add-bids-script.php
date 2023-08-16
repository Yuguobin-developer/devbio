<?php


/**
 * Template name: add bids script
 *
 * @package BuddyBoss_Theme
 */
 
$row = 1;
$i = 0;

if (($handle = fopen("https://docs.google.com/spreadsheets/d/e/2PACX-1vQtcyY36Ad6L5IvPs0IxfpcxBvhYy5SCelfchnMStYO3LqcZQL1IpRklSRm9ty_E3Ejws7OTVq4LDCE/pub?gid=571344969&single=true&output=csv", "r")) !== FALSE) {
    
    while (($data = fgetcsv($handle, 1000, ",")) !== FALSE) {

        $num = count($data);

        $row++;

        for ($c=0; $c <= $num; $c++) {                        
            if ($c==0) {
                $linevalues[$i]['title'] = $data[$c];
            }
            if ($c==7) {
                $linevalues[$i]['country'] = $data[$c];
            }
            if ($c==4) {
                $linevalues[$i]['description'] = $data[$c];
            }
            if ($c==5) {
                $linevalues[$i]['category'] = $data[$c];
            }
            if ($c==12) {
                $linevalues[$i]['email'] = $data[$c];
            }
            if ($c==13) {
                $linevalues[$i]['biogasbid'] = $data[$c];
            }
            if ($c==2) {
                $linevalues[$i]['endDate'] = $data[$c];
            }
            if ($c==6) {
                $linevalues[$i]['organization'] = $data[$c];
            }
            if ($c==10) {
                $linevalues[$i]['Fname'] = $data[$c];
            }
            if ($c==11) {
                $linevalues[$i]['Lname'] = $data[$c];
            }
            if ($c==3) {
                $linevalues[$i]['url'] = $data[$c];
            }
        }

        $i++;

    }

    fclose($handle);

}

function prettyPrint($a, $t='pre') {echo "<$t>".print_r($a,1)."</$t>";}


for ($j=1; $j < count($linevalues) ; $j++) { 
    $post_data = array(
        'post_title'    => $linevalues[$j]['title'],
        'post_type'     => 'bid',
        'post_status'   => 'publish'
    );
    $post_id = wp_insert_post( $post_data );


    $field_key = "field_6079c707ea692";
    $value = date('D M dS Y',strtotime($linevalues[$j]['endDate']));

    update_field( $field_key, $value, $post_id );

    $field_key = "field_607b3a28b6816";
    $value = $linevalues[$j]['category'];
    
    update_field( $field_key, $value, $post_id );

    $field_key = "field_6079c735ea693";
    $value = $linevalues[$j]['description'];

    update_field( $field_key, $value, $post_id );

    $field_key = "field_6079c744ea694";
    $value = $linevalues[$j]['organization'];

    update_field( $field_key, $value, $post_id );

    $field_key = "field_6079c74bea695";
    $value = $linevalues[$j]['country'];

    update_field( $field_key, $value, $post_id );

    $field_key = "field_6079c765ea696";
    $value = $linevalues[$j]['Fname']." ".$linevalues[$j]['Lname'];

    update_field( $field_key, $value, $post_id );

    $field_key = "field_6079c776ea697";
    $value = $linevalues[$j]['email'];

    update_field( $field_key, $value, $post_id );

    $field_key = "field_6079d4928082b";
    $value = $linevalues[$j]['url'];

    update_field( $field_key, $value, $post_id );
    
    $field_key = "field_60e8645e20529";
    $value = $linevalues[$j]['category'];

    update_field( $field_key, $value, $post_id );
}
?>