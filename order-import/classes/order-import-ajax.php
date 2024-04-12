<?php

namespace order_import\classes;

class Order_Import_Ajax
{
    public function validate_url()
    {
        if ( defined ( 'DOING_AJAX' ) && DOING_AJAX ) {

            if ( filter_input ( INPUT_POST,'CRM_URL', FILTER_VALIDATE_URL ) )
            {
                echo json_encode( array( 'valid' => true, 'url' => $_POST['CRM_URL'] ) );
            } else {
                echo json_encode( array( 'valid' => false, 'url' => $_POST['CRM_URL'] ) );
            }

        }

        wp_die();
    }


}