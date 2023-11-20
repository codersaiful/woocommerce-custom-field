/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

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
        
        $(document).on('wccf_variation_changed',function(hello,abc){
            //console.log(abc);
            var variation_id = $("#product_id_" + abc + " .data_product_variations a.single_add_to_cart_button").attr('data-variation_id');
            if('variation_id' !== variation_id){
                
            }
        });
        
    });

})(jQuery); 