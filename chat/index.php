<?php
header('Refresh: 3');
mysql_connect("localhost", "root", "root") or die("Connection Failed");
mysql_select_db("balls")or die("Connection Failed");
$query = "SELECT * FROM chat ORDER BY id DESC";
$result = mysql_query($query);
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
	font-family: helvetica;
	font-size: 50px;
	line-height: .00000001em;
	color: #FFF;
}
</style>
<div id="chat"><p><?php echo $line['data']; ?></p></div>
<?php
}
?>