<?php



/**

 * Template name: Industry Library Template

 *

 * @package BuddyBoss_Theme

 */



get_header();

global $wpdb;



$has_access = false;

if (current_user_can('editor') || current_user_can('administrator')) {

    $has_access = true;

}

$current_date = strtotime(date("Y-m-d"));

?>

<?php

$share_box = buddyboss_theme_get_option('blog_share_box');

if (!empty($share_box) && is_singular('post')) :

    get_template_part('template-parts/share');

endif;

?>







<link rel="stylesheet" href="https://cdn.datatables.net/1.11.2/css/jquery.dataTables.min.css">
<link rel="stylesheet" href="https://cdn.datatables.net/responsive/2.2.9/css/responsive.dataTables.min.css">
<link rel="stylesheet" href="<?php echo get_stylesheet_directory_uri(); ?>/assets/css/bgcommunity.css?id=<?php echo rand(1000,9999); ?>" />



<script src="https://cdn.datatables.net/1.11.0/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/responsive/2.2.9/js/dataTables.responsive.min.js"></script>


<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-grid-only@1.0.0/bootstrap.css">
<link rel="stylesheet" href="<?php echo get_stylesheet_directory_uri(); ?>/assets/css/bg-list.css?id=<?php echo rand(1000,9999); ?>">





<div id="primary" class="content-area">

    <main id="main" class="site-main">

        <div class="flex grid_flex">
            <div><h1><?php echo $post->post_title; ?><sup>(<span class="no_items">0</span>)</sup> </h1></div>
            <div><a href="<?php echo site_url() . '/add-industry-resource/'; ?>" class="button ">+ Add your resource</a></div>
        </div>


        <div id="post_list" class="bids_list" style="">

            <div class="row bg_form_fields">
                <div class="col-sm-3">
                    <p>Filter by:</p>
                </div>
                <div class="col-sm-3">
                    <input type="text" id='keyword' name="keyword" placeholder="Keyword" class="form-control" style="width:95%">
                </div>  
                <div class="col-sm-3 select_wrapper">
                    <span id="Organization"  placeholder="Organization"></span>
                </div>                
                <div class="col-sm-3 select_wrapper">
                    <span id="Year" placeholder="Year"></span>
                </div>                
                <div class="col-sm-3  select_wrapper">
                    <span id="Country" placeholder="Country"></span>
                </div>

                <div class="col-sm-3  select_wrapper">
                    <span id="option_tag" placeholder="Tags"></span>
                    <select class="form-control" style="width:95%" id="Tags"><option value=""></option></select>
            
                </div>
            </div>
            <div class="row">
                
                <div class="col-sm-12" style="padding: 25px 0px 0px 0px;" >
                    <h3 ><!--THERE ARE CURRENTLY <span id='bidsNum' style="font-weight:bold"></span> FILES ON INDUSTRY LIBRARY --></h3>
                </div>
               

            </div>


            <?php     

                $date_args = array(
                    'post_type'   => 'library',                
                    'posts_per_page' => -1,                
                    'post_status' => 'publish',
                    'order' => 'ASC',
                
                );
                $query = new WP_Query( $date_args );
                $query = $query->posts;

            ?>

            <!--
            <pre>
                <?php //var_dump($query); ?>
            </pre>
            -->


            <table class='sortable display responsive' id='Tableau' style="width:100%">

                <thead>
                    <th>Report Title</th>
                    <th>Date</th>
                    <th>Organization</th>
                    <th>Country</th>
                    <th>Tags</th>
                </thead>

                <tbody>
                    <?php $allTags = []; ?>
                    <?php $k = 0; foreach ($query as $value) : ?>

                  
                        
                        
                            <?php 
                                $link='';
                                if ( strlen( get_field("file_upload", $value->ID)['url'] ) > 1 ) {
                                    $link=get_field("file_upload", $value->ID)['url'];
                                }
                                
                                if ( strlen( get_field("file_url", $value->ID) ) > 1 ) {
                                    $link=get_field("file_url", $value->ID) ;
                                }
                              
                            ?>
                           
                            <? if(  strlen($link)>1 ): ?>
                            
                                <tr>
                                    <td><a href="<?= $link; ?>" target='_blank'><?= get_field("report_title", $value->ID); ?></a></td>
                                    <td><?= get_field("year", $value->ID); ?></td>
                                    <td><?= get_field("author_name", $value->ID);   ?></td>
                                    <td><?= ucfirst( get_field("country", $value->ID) ); ?></td>
    
                                    <?php  $ii=0;?>
                                    <?php if($tags = explode("; ",get_field("tags", $value->ID))):?>
                                        
                                        <td><ul><?php foreach ($tags as $tag) { ?> <li> <?php echo ucfirst($tag);  array_push($allTags,strtolower($tag)); ?> </li> <?php } ?></ul></td>
                                    <?php else: ?>
                                        <td><?= get_field("tags", $value->ID);?></td>
                                    <?php endif; ?>
                                </tr>
                                
                            <? endif; ?>
                                
                            
                       


                    <?php endforeach; ?>

                </tbody>

            </table>

            <script>

                jQuery(document).ready(function() {

                    $('#bidsNum').html('<?= count($query) ;?>');

                    jQuery('#keyword').keyup(function() {
                        oTable.search(jQuery(this).val()).draw();
                    });

                    jQuery('#Tags').change(function() {
                        oTable.search(jQuery(this).val()).draw();
                    });

                    oTable = $('#Tableau').DataTable({                 
                        "order": [          
                        ],
                        "columnDefs": [
                            { className: "dt-nowrap", "targets": [ 4 ] }
                        ],
                        "pageLength": 50,
                        responsive: true,
                        initComplete: function() {
                            var i = 0;
                            var Ids = ["#Year", /* "#Type",*/ "#Organization","#Country"];
                            this.api().columns().every(function() {
                                var column = this;
                                if (i > 0) {
                                    var select = $('<select class=\'form-control\' style="width:95%" ><option value=""></option></select>')
                                        .appendTo($(Ids[i - 1]).empty())
                                        .on('change', function() {
                                            var val = $.fn.dataTable.util.escapeRegex(
                                                $(this).val()
                                            );
                                            column
                                                .search(val ? '^' + val + '$' : '', true, false)
                                                .draw();
                                        });
                                    column.data().unique().sort().each(function(d, j) {
                                        select.append('<option value="' + d + '">' + d + '</option>')
                                    });
                                }

                                i = i + 1;
                            });
                        }
                    });

                    $('#container').css( 'display', 'block' );
                    oTable.columns.adjust().draw();

                    $('<select class=\'form-control\' style="width:95%" ><option value=""></option></select>').appendTo('#Tags');
                    
                    <?php foreach ( array_unique($allTags) as $value) :?>       
                        $('#Tags').append($('<option>', {
                            value: '<?=$value;?>',
                            text: '<?=strtoupper($value);?>'
                        }));                 
                    <?php endforeach;?>

                });

            </script>

        </div>

    </main><!-- #main -->

</div><!-- #primary -->



<?php //get_sidebar(); ?>



<?php get_footer();?>
<?php include(get_template_directory() . "/assets/includes/promo-footer.php");  ?>
<?php include(get_template_directory() . "/assets/includes/bg-footer.php");  ?>

<style>
   @media only screen and (min-width:600px){.first_column{width:35px!important}}@media only screen and (max-width:600px){.first_column{width:200px!important}}#Tableau_filter,#Tableau_length{display:none}.col-sm-6>input,.col-sm-6>span>select{width:100%}.col-sm-6{padding:10px}.col-sm-6>p{margin-bottom:10px}thead>tr{background:#00d37d;color:#fff;border-radius:67px}td{vertical-align:revert}table.dataTable.dtr-inline.collapsed>tbody>tr>td.dtr-control:before,table.dataTable.dtr-inline.collapsed>tbody>tr>th.dtr-control:before{background-color:#000daa!important}#primary.content-area::before{content:"";width:100vw;height:110px;position:absolute;top:105px;left:0;background:#000d9d;background:linear-gradient(132deg,#000d9d 0,#00c67d 100%)}.deck{display:block;padding:20px 0}.grid_2{display:grid;grid-template-columns:1fr 1fr;grid-gap:20px}.single .entry-title{margin-top:-30px}
   @media(min-width: 1200px){
        .col-sm-6>input::placeholder{font-size: 20px;}    
    }
   .col-sm-4 > p {
        margin-bottom: 15px;
        margin-top: 15px;
    }
    td.dt-nowrap > ul {
        margin: 0 0 0 20px  ;
        display: block;
    }
    
    tbody > tr > td:nth-child(5){ display: block;}
    
    tbody > tr > td:nth-child(5) ul{
        display: block;
    }
    tbody > tr > td:nth-child(5) ul li{
        /*list-style: none; */
        
    }
    
    td.dt-nowrap > ul li::after{/* content: ","; */}
</style>
<style>

                #Tableau_length,#Tableau_filter {display: none;}

                .col-sm-6>input,.col-sm-6>span>select {width: 100%;}

                .col-sm-6 {padding: 10px;}

                .col-sm-6>p {margin-bottom: 10px;}

                thead>tr {background: #006633;color: white;border-radius: 67px;}

                td {vertical-align: revert;}

                table.dataTable.dtr-inline.collapsed>tbody>tr>td.dtr-control:before, table.dataTable.dtr-inline.collapsed>tbody>tr>th.dtr-control:before {
                    background-color: #000daa!important;
                }

table.dataTable thead th, table.dataTable thead td {
padding: 25px 5px;
    
}

table.dataTable thead th, table.dataTable tfoot th{font-weight: initial;}
    

table.dataTable.display tbody tr.odd>.sorting_2, table.dataTable.order-column.stripe tbody tr.odd>.sorting_2, table.dataTable.display tbody tr.even>.sorting_2, table.dataTable.order-column.stripe tbody tr.even>.sorting_2{
    background-color: #D2E4DA;
}

table.dataTable.display tbody tr.odd>.sorting_1, table.dataTable.order-column.stripe tbody tr.odd>.sorting_1{background-color: initial;}

body.bb-custom-typo{font-family: "Helvetica Neue",Helvetica,Arial,sans-serif;}

tbody > tr >td:nth-child(2){background-color: #D2E4DA;}
tbody > tr{border-bottom: 1px solid #006633;}
td, th{border-bottom: 1px solid #006633;}
body > tr >td:nth-child(2){background-color: #d2E4D1;}

.col-sm-6>input, .col-sm-6>span>select{
    font-size: 12px; color: #006633;
}
</style>
<script>
    jQuery(document).ready(function(){
        updateNoItems();
        addPlaceHolders();
        
        setInterval(updateNoItems, 1000);
    });
    
    function updateNoItems(){
        var no_items_string = $("#Tableau_info").html();
		var items_string = no_items_string.split(" ");
		
        console.log(items_string[5]);
        jQuery('.no_items').html(items_string[5]);
    }
    
    function addPlaceHolders(){
        var no_select = jQuery(".select_wrapper").size();
        
        for(var i = 0; i < no_select; i++){
            var select_title = jQuery(".select_wrapper:eq(" + i + ") span").attr("placeholder");
            //jQuery(".select_wrapper:eq(" + i + ") select").prepend('<option value="">' + select_title + '</option>');
            jQuery(".select_wrapper:eq(" + i + ") select option:first-child").html(select_title);
            jQuery(".select_wrapper:eq(" + i + ") select").addClass("unselected");
        }
    }
</script>
