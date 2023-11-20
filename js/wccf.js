/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

(function($) {
    'use strict';
    $(document).ready(function(){
        $('.wccf_custom_field_wrap').on('click','.wccf_add_field',function(){
            var id,amount,label,description,name,fields;
            
            label = $('.wccf_field_label').val();
            description = $('.wccf_field_description').val();
            id = $('.wccf_field_id').val();
            amount = $('#wccf_custom_field_form_field_wrapper .wccf_each_row').length + 1;
            name = "data[variation][" + amount + "]";
            //[" + amount + "]
            fields = "<div class='wccf_each_row'>";
            fields +="<input name='" + name + "[label]' type='text' class='wccf_e_label' value='" + label + "'>";
            fields +="<input name='" + name + "[id]' type='text' value='" + id + "' placeholder='Slug automatically create here'>";
            fields +="<input name='" + name + "[description]' type='text' class='wccf_e_description' value='" + description + "'>";
            fields +="<span class='wccf_remove_field dashicons dashicons-no-alt'></span>";
            fields +="</div>";
            
            
            $('#wccf_custom_field_form_field_wrapper').prepend(fields);
            $('.wccf_field_label').val("")
            $('.wccf_field_id').val("")
            $('.wccf_field_description').val("")
            
        });
        
        $('body').on('click','span.wccf_remove_field.dashicons',function(){
            var permistion = confirm("Are you Sure?");
            console.log(permistion);
            if(permistion){
                $(this).parents('.wccf_each_row').remove();
            }
            
        });
        
        $('.wccf_custom_field_wrap').on('change','.wccf_field_label',function(){
            var id,label;
            label = $(this).val();
            id = convertToSlug(label);
            $('.wccf_field_id').val(id);
        });
        function convertToSlug(Text){
                return Text.toLowerCase().replace(/ /g,'-').replace(/[^\w-]+/g,'');
        }          
        
    });
})(jQuery); 