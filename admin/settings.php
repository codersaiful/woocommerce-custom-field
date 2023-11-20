<?php
/**
 * Faq Page for WC Min Max Quantity
 */
function wccf_option_panel(){
    if( isset( $_POST['custom_fields'] ) && isset( $_POST['data'] ) ){
        $args = $_POST['data'];
        update_option( WC_Custom_Field::KEY , $args);
    }
    
    
?>
<h1>WooCommerce Custom Field Setting Panel</h1>
<div class="wccf_custom_field_wrap">
    <h2>Add New Custom fields :</h2>
    <div class="wccf_fields">
        <input class="wccf_field_label" type="text" name="label" value="" placeholder="Label">
        <input class="wccf_field_id" type="text" name="id" value="" placeholder="slug">
        <input class="wccf_field_description" type="text" name="description" value="" placeholder="Description">
    </div>
    <span class="wccf_add_field dashicons dashicons-plus-alt" title="Click here to add new custom fields "></span>
</div>
<form id="wccf_custom_field_form" action="" method="POST">
    
    <h2>Added Custom fields :</h2>
    <div id="wccf_custom_field_form_field_wrapper">
        <?php
        $data_variation = get_option( WC_Custom_Field::KEY );
        $variations = $data_variation['variation'];
        $serial = 1;
        if( is_array( $variations ) && count( $variations ) > 0 ){
            foreach( $variations as $key=>$variation ){
                $id = $variation['id'];
                $label = $variation['label'];
                $description = $variation['description'];
        ?>
       
        <div class="wccf_each_row">
            <input name="data[variation][<?php echo $serial; ?>][label]" type="text" class="wccf_e_label" value="<?php echo esc_attr( $label ); ?>">
            <input name="data[variation][<?php echo $serial; ?>][id]" type="text" value="<?php echo esc_attr( $id ); ?>">
            <input name="data[variation][<?php echo $serial; ?>][description]" type="text" class="wccf_e_description" value="<?php echo esc_attr( $description ); ?>">
            
            <span class="wccf_remove_field dashicons dashicons-no-alt" title="Remove Custom Field"></span>
        </div>
        
        <?php
            $serial++;
            }
        }
        ?>
    </div>
    
   
    <input type="submit" class="primary button button-primary button-large" name="custom_fields"> 
</form>
<style>
    span.wccf_remove_field.dashicons.dashicons-no-alt {
        background: red;
        color: white;
        margin: 8px 5px;
        cursor: pointer;
    }
    .wccf_custom_field_wrap div {
        display: inline;
    }

    span.wccf_add_field.dashicons.dashicons-plus-alt {
        padding: 6px;
        font-size: 24px;
        cursor: pointer;
    }

    .wccf_fields input,.wccf_each_row input {
        padding: 5px;
        font-size: 18px;
        width: 20%;
    }

    form#wccf_custom_field_form input[type=submit] {
        margin-top: 15px;
    }
    form#wccf_custom_field_form {
    margin-top: 7px;
    }

    form#wccf_custom_field_form input {margin-bottom: 10px;}
</style>
<?php
}