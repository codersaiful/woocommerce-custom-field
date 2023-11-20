<?php

add_action( 'woocommerce_variation_options', 'wccf_add_custom_field_to_variations', 10, 3 );
 
function wccf_add_custom_field_to_variations( $loop, $variation_data, $variation ) {
    $data_options = get_option( WC_Custom_Field::KEY );
    $data_variations = $data_options['variation'];
    if( is_array( $data_variations ) && count( $data_variations ) > 0 ){
        foreach( $data_variations as $data_variation ){
            $id = $data_variation['id'];
            $label = $data_variation['label'];
            $description = $data_variation['description'];
            $args[] = array(
                'id'        =>  $id . '[' . $loop . ']',
                //'name'        =>  '_wcmmq_min_quantity',
                'label'     =>  $label,//'Min Quantity',
                'class'     =>  'wccf_input',
                'type'      =>  'text',
                'desc_tip'  =>  true,
                'description'=> 'Enter Data',//'Enter Minimum Quantity for this Variation',
                //'data_type' => 'decimal',
                'value' => get_post_meta( $variation->ID, $id, true ),
            );
        }
        //var_dump(get_option( WC_Custom_Field::KEY ));
        foreach($args as $arg){
            woocommerce_wp_text_input($arg);
        }
    }
    

    
    

}

add_action( 'woocommerce_save_product_variation', 'wccf_save_custom_field_variations', 10, 2 );
 
function wccf_save_custom_field_variations( $variation_id, $i ) {
    
    $data_options = get_option( WC_Custom_Field::KEY );
    $data_variations = $data_options['variation'];
    if( is_array( $data_variations ) && count( $data_variations ) > 0 ){
        foreach( $data_variations as $data_variation ){
            $id = $data_variation['id'];
            $custom_field = $_POST[$id][$i];
            if ( isset( $custom_field ) ) update_post_meta( $variation_id, $id, esc_attr( $custom_field ) );
        }
    }
    /*
    $args = array(
        '_wcmmq_min_quantity',
        '_wcmmq_max_quantity',
        '_wcmmq_product_step',
    );
    foreach($args as $arg){
        $custom_field = $_POST[$arg][$i];
        if ( isset( $custom_field ) ) update_post_meta( $variation_id, $arg, esc_attr( $custom_field ) );
    }
    */
}