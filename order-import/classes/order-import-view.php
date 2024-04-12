<?php

namespace order_import\classes;

use WpOrg\Requests\Exception;

class Order_Import_View
{
    /**
     * @throws Exception
     */

    public function page_view()
    {
        if ( $_POST ) \order_import\classes\Order_Import_Actions::on_post();
        require_once( ABSPATH . 'wp-content/plugins/order-import/order-import-html.php' );
    }

}
