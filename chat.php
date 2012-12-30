<?php
header('Refresh: 3');

include_once('includes/dbfunc.inc.php');

$result = getAllChat();
while ($line = mysql_fetch_assoc($result)) {
?>
<style>
html {
	background-color: #000;
}

#chat {
	margin-top: 10px;
	margin-left: 10px;
}
p {
	font-family: courier;
	font-size: 50px;
	line-height: .00000001em;
	color: #33FF00;
}
</style>
<!--<script type="text/javascript">
    var source = new EventSource('stream.php');
    source.addEventListener('message', function(e) {
        alert(e.data);
    }, false);
</script> -->
<div id="chat"><p><?php echo $line['data']; ?></p></div>
<?php
}
?>