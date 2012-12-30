<?php

// include all features classes
//function __autoload($class_name) {
//    include 'features/'.$class_name . '.php';
//}

header("content-type: text/xml");
echo "<?xml version=\"1.0\" encoding=\"UTF-8\"?>\n";

$urltoshorten = $_REQUEST['Body'];

//get url back, get short url
$url = "http://tinyurl.com/api-create.php?url={$urltoshorten}";
$ch = curl_init();

curl_setopt($ch, CURLOPT_URL, $url);
curl_setopt($ch, CURLOPT_HEADER, 0);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);


$output = curl_exec($ch);

curl_close($ch);

//eBay::getAvgPrice("keywords");

?>
<Response>
    <Sms>Short URL: <?php echo $output ?></Sms>
</Response>