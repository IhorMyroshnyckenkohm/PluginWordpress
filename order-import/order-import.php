<?php

/*
Plugin Name: Order Import Plugin
Plugin URI: http://example.com/abobius
Description: WordPress 6.5 / Додає новий пункт меню з певною конфігурацією для організації
Author: Ігор Мирошниченко
Version: 1.0
Author URI: http://example.com/author
*/



require_once 'classes/order-import-actions.php';
require_once 'classes/order-import-ajax.php';
require_once 'classes/order-import-db.php';
require_once 'classes/order-import-view.php';
require_once ABSPATH . 'wp-admin/includes/upgrade.php';

if ( !defined( 'ABSPATH' ) )
{
    exit;
}

class Order_Import_Plugin
{
    public function __construct()
    {
        $ajax_class_object = new \order_import\classes\Order_Import_Ajax();

        add_action( 'admin_menu' , array( $this, 'initialize' ) );
        add_action( 'wp_ajax_nopriv_order_import_ajax_action' , array( $ajax_class_object, 'validate_url' ) );
        add_action( 'wp_ajax_order_import_ajax_action' , array( $ajax_class_object, 'validate_url' ) );



        wp_enqueue_script('custom-script', plugin_dir_url( __FILE__ ) . 'js/order-import.js', array( 'jquery' ), '1.0', true );
        wp_enqueue_style('custom-css', plugin_dir_url( __FILE__ ) . 'css/order-import.css', array( ), '1.0' );
    }

    public function initialize()
    {

        add_menu_page(
            __( 'Імпорт замовлень' ) ,
            'Імпорт замовлень' ,
            'manage_options' ,
            'order_import' ,
            array( new  \order_import\classes\Order_Import_View, 'page_view' ) ,
            'dashicons-download'
        );
    }

}

if (class_exists('Order_Import_Plugin')){
    $GLOBALS[ 'order_import_object' ] = new Order_Import_Plugin();
}
