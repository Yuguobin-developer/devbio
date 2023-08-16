jQuery(document).ready(function($){
    'use strict';
    var extensions = {
    	pdf		: ['pdf','indd'],
    	text   	: ['txt','tex','rtf','log'],
    	code	: ['php','asp','aspx','html','htm','exe','com','js','phtml','css','less'],
    	audio	: ['aif','ief','m3u','m4a','mid','mp3','mpa','wav','wma'],
    	video	: ['3g2','3gp','asf','avi','flv','mp4','m4v','mov','mpg','rm','srt','swf','vob','wmv'],
    	archive	: ['7z','cbr','deb','gz','pkg','rar','rpm','sitx','tar.gz','zip','zipx'],
    	image	: ['ai','eps','ps','svg','bmp','dds','gif','jpg','png','psd','pspimage','tga','thm','tif','tiff','yuv'],
    	word	: ['doc','docx','wpd','wps'],
    	excel	: ['xlr','xls','xlsx','csv'],
    	powerpoint	: ['pps','ppt','pptx']
    };
    function set_upload_icon(ths){  
        var txt     = ths.text().trim();
        var icls    = 'jbfile-icon-file';
        if(txt != ""){
            $.each( extensions, function( key, arr ) {
                $.each(arr, function(i, val){
                    if(txt.indexOf(val) >= 0){
                        icls = 'jbfile-icon-'+key;
                    }
                });
            });
            ths.addClass(icls);
        }
    }
    function init() {
        var interval_drop, interval_ctr = 0; 
        $('html').on('drop', function(event) {
            console.log("drop files");
            interval_ctr = 0;
            setInterval(function(){
                if( interval_ctr < 20 ){
                    $('.gfield .ginput_preview').each(function(){
                        set_upload_icon($(this));
                    });
                }else{ clearInterval(interval_drop); }
                interval_ctr++;
            },300);
        });
        $('.jbfile-styler__field .ginput_preview').each(function(){
        	set_upload_icon($(this));
        });
        $('.jbfile-styler__field').on('change', 'input[type=file]', function(e){
            var fname = 'No file chosen';
            if(e.target.files.length){
                fname = e.target.files[0].name;
            }
            $(this).siblings('.jbfile-styler__single').find('.jbfile-styler__caption').text(fname);

            var ths = $(this);

            if(ths.closest('.gfield').find('.gform_fileupload_multifile').length){
                setTimeout(function(){
                    ths.closest('.gfield').find('.ginput_preview').each(function(){
                        set_upload_icon($(this));
                    });
                },500);
            }
        }).on('click', function(e){
            if($(e.target).hasClass('gform_delete'))
                $(this).find('.jbfile-styler__single').show();
        });
        $('.jbfile-styler__single').on('click',function(){
            $(this).siblings('input[type=file]').trigger('click');
        }).each(function(){
            var con = $(this).closest('.gfield').find('.jbfile-styler__field');
            con.append($(this));

            if($(this).closest('.jbfile-styler__field').find('.ginput_preview').length){
                $(this).hide();
            };
        });
    }
    init();
    jQuery(document).on('gform_post_render', function(){
        init();
    });
});