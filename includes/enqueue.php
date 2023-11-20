<?php

function wccf_front_script_enqueue() {
    wp_enqueue_script('jquery');
    //wp_register_script( 'wccf_front_js', WCCF_BASE_URL . 'js/wccf_front.js', false, WC_Custom_Field::getVersion() );
    //wp_enqueue_script( 'wccf_front_js' );
}
//add_action( 'wp_enqueue_scripts', 'wccf_front_script_enqueue' );

function wccf_inline_script_enqueue() {

$ajax_url = get_site_url() . "/wp-admin/admin-ajax.php";

$script = <<<EOF
<script type="text/javascript">
(function($) {
    'use strict';
    $(document).ready(function(){
        //For FrontEnd
        $(document).on('change','.data_product_variations',function(){
            var variation_id,product_id;
            product_id = $(this).data('product_id');//.children('a.single_add_to_cart_button')
            //console.log(variation_id);
            //product_id = 111;
            $( document ).trigger( 'wccf_variation_changed',product_id );
        });
        
        $(document).on('wccf_variation_changed',function(hello,product_id){
            var variation_id = $("#product_id_" + product_id + " .data_product_variations a.single_add_to_cart_button").attr('data-variation_id');
            var ajax_url = "$ajax_url";
            $.ajax({
                type: 'POST',
                url: ajax_url,// + get_data,
                data: {
                    action:         'wccf_ajax_data',
                    variation_id:    variation_id,
                },
                complete: function(){

                },
                success: function(data) {
                    var objs = JSON.parse(data);
                    $.each(objs, function (key,value) {
                    console.log(key,value);
                    var target = "#product_id_" + product_id + " .wpt_cf_" + key;
                    $(target).html(value);
                });
                },
                error: function() {
                    
                },
            });
        });
        
    });

})(jQuery);    
</script>
EOF;
echo $script;
}
add_action( 'wp_footer', 'wccf_inline_script_enqueue' );

function wccf_get_ajax_data(){
    $variation_id = ( isset( $_POST['variation_id'] ) && is_numeric( $_POST['variation_id'] ) ? $_POST['variation_id'] : false );

    $data_variation = get_option( WC_Custom_Field::KEY );
    $data_variation = $data_variation['variation'];
    $data = false;
    if( is_array( $data_variation ) && count( $data_variation ) > 0 ){
        foreach($data_variation as $variation ){
           $data_key =  $variation['id'];
           $data_value = get_post_meta($variation_id, $data_key, true);
           if( !$data_value ){
               $data_value = "";
           }
           $data[$data_key] = $data_value;
        }
    }
    echo wp_json_encode($data);
    die();
}
add_action( 'wp_ajax_wccf_ajax_data', 'wccf_get_ajax_data' );
add_action( 'wp_ajax_nopriv_wccf_ajax_data', 'wccf_get_ajax_data' );