<?php

// include all features classes
function __autoload($class_name) {
    include 'features/'.$class_name . '.php';
}

header("content-type: text/xml");
echo "<?xml version=\"1.0\" encoding=\"UTF-8\"?>\n";

$keyword = $_REQUEST['Body'];

$aprice = eBay::getAvgPrice($keyword);

?>
<Response>
    <Sms>Average Price: $<?php echo $aprice ?></Sms>
</Response>
