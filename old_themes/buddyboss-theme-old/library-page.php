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



<script src="https://cdn.datatables.net/1.11.0/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/responsive/2.2.9/js/dataTables.responsive.min.js"></script>


<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-grid-only@1.0.0/bootstrap.css">





<div id="primary" class="content-area">

    <main id="main" class="site-main">



        <h1 style="color:white"><?php echo $post->post_title; ?> </h1>



        <div id="post_list" class="bids_list" style="margin-top:70px">

            <div class="row">
                <div class="col-sm-4">
                    <p>Keyword</p>
                    <input type="text" id='keyword' name="keyword" placeholder="Keyword" class="form-control" style="width:95%">
                </div>  
                <div class="col-sm-4">
                    <p>Organization</p>
                    <span id="Organization"></span>
                </div>                
                <div class="col-sm-4">
                    <p>Year</p>
                    <span id="Year"></span>
                </div>                
                <div class="col-sm-4">
                    <p>Country</p>
                    <span id="Country"></span>
                </div>

                <div class="col-sm-4">
                    <p>Tags</p>
                    <select class="form-control" style="width:95%" id="Tags"><option value=""></option></select>
            
                </div>

                
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

                  
                        <tr>
                        
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
                                
                            <? endif; ?>
                                
                            
                        </tr>


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

<style>
   @media only screen and (min-width:600px){.first_column{width:35px!important}}@media only screen and (max-width:600px){.first_column{width:200px!important}}#Tableau_filter,#Tableau_length{display:none}.col-sm-6>input,.col-sm-6>span>select{width:100%}.col-sm-6{padding:10px}.col-sm-6>p{margin-bottom:10px}thead>tr{background:#00d37d;color:#fff;border-radius:67px}td{vertical-align:revert}table.dataTable.dtr-inline.collapsed>tbody>tr>td.dtr-control:before,table.dataTable.dtr-inline.collapsed>tbody>tr>th.dtr-control:before{background-color:#000daa!important}#primary.content-area::before{content:"";width:100vw;height:110px;position:absolute;top:105px;left:0;background:#000d9d;background:linear-gradient(132deg,#000d9d 0,#00c67d 100%)}.deck{display:block;padding:20px 0}.grid_2{display:grid;grid-template-columns:1fr 1fr;grid-gap:20px}.single .entry-title{margin-top:-30px}
   .col-sm-4 > p {
        margin-bottom: 15px;
        margin-top: 15px;
    }
    td.dt-nowrap > ul {
        margin: 0px  ;
    }
</style>
