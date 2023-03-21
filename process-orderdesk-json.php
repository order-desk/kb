<?php
//Check For Order
if (!isset($_POST['order'])) {
        header(':', true, 400);
        die('No Data Found');
}
 
//Cbeck Store ID
//Be sure to set your store ID. Ask Order Desk support if you aren't sure what it is.
if (!isset($_SERVER['HTTP_X_ORDER_DESK_STORE_ID']) || $_SERVER['HTTP_X_ORDER_DESK_STORE_ID'] != "YOUR-STORE-ID") {
        header(':', true, 403);
        die('Unauthorized Request');
}
 
//Check the Hash (optional)
//The API Key can be found in the Advanced Settings section. Order Desk Pro only
if (!isset($_SERVER['HTTP_X_ORDER_DESK_HASH']) || hash_hmac('sha256', $_POST['order'], 'YOUR_API_KEY') !== $_SERVER['HTTP_X_ORDER_DESK_HASH']) {
        header(':', true, 403);
        die('Unauthorized Request');
}
 
//Check Order Data
$order = json_decode($_POST['order'], 1);
if (!is_array($order)) {
        header(':', true, 400);
        die('Invalid Order Data');
}
 
//Everything Checks Out -- do your thing
echo "<pre>" . print_r($order, 1) . "</pre>";