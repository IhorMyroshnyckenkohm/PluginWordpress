<?php

namespace order_import\classes;

use WpOrg\Requests\Exception;

class Order_Import_Actions
{
    /**
     * @throws Exception
     */

    public static function on_post()
    {
        $fields_values = self::get_data();

        if ( $_POST['CRM_transfer'] === NULL ) $fields_values['CRM_transfer'] = '';

        foreach ( $fields_values as $key => $value ) {

            switch ( self::action( $key ) ) {
                case 'save':
                    add_option( $key, $value );
                    break;
                case 'update':
                    update_option( $key, $value );
                    break;
                case 'delete':
                    delete_option( $key );
                    break;
                default:
                  //  throw new Exception('Something went wrong','');
            }

        }
    }

    /**
     * @throws Exception
     */

    private static function get_data(): array
    {
        $result = array();

        foreach ( $_POST as $key => $value )
        {
            if ( strlen($value) <= 90 )
            {
                $result[ $key ] = $value;
            } else {
                //custom logic
                //throw new Exception('less symbol pls','');
            }
        }
        return $result;
    }

    public static function action( $key ): string
    {
        if ( strlen ( get_option ( $key ) ) < 0 or !isset( $key ) )
        {
            $action = 'save';
        }
        else
        {
            $action = 'update';
        }
        return $action;
    }
}
