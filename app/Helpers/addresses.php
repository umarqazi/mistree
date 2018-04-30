<?php
/**
 * Created by shabanhassan@live.com
 * User: Shaban Hassan
 * Date: 4/30/18
 * Time: 5:46 PM
 */

if( !function_exists( 'workshopAddressGenerator' ))
{
    function workshopAddressGenerator($address)
    {
        return implode(', ', array_filter(array_except($address->toArray(),['id', 'workshop_id', 'coordinates', 'deleted_at', 'created_at', 'updated_at'])));
    }
}

if( !function_exists('customerAddressGenerator') )
{
    function customerAddressGenerator($address)
    {
        return implode(', ', array_filter(array_except($address->toArray(),['id', 'customer_id', 'geo_cord', 'deleted_at', 'created_at', 'updated_at'])));
    }
}