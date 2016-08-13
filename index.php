<h1>My-Anime-List-API-Configuration-PHP</h1>
<?php
set_time_limit(0);
$fp = fopen ('./temp.xml', 'w+');
$string = 'http://myanimelist.net/api/anime/search.xml?q=Sword_Art_Online';//xml url
$string = preg_replace('/\s+/', '+',$string);
echo $string;
$ch = curl_init($string);
curl_setopt($ch, CURLOPT_USERPWD, 'maluser:malpassword'); //mal username and password
curl_setopt($ch, CURLOPT_TIMEOUT, 50);
curl_setopt($ch, CURLOPT_FILE, $fp);
curl_setopt($ch, CURLOPT_FOLLOWLOCATION, true);
curl_exec($ch);
curl_close($ch);
fclose($fp);

?>
<h1>
<?php
libxml_use_internal_errors(true);
$xml=simplexml_load_file("./temp.xml") or die("Error to create objects :(");
if ($xml === false) {
    echo "Fail to load xml data :( ";
    foreach(libxml_get_errors() as $error) {
        echo "<br>", $error->message;
    }
} else {

	$str = $xml->entry[0]->synopsis;
	$order   = array("br");
	$replace = '';
	$str = str_replace($order, $replace, $str);
	$order   = array("< />");
	$replace = '';
	$str = str_replace($order, $replace, $str);
	$order   = array("\n");
	$replace = '';
	$str = str_replace($order, $replace, $str);
	$order   = array("[Written by MAL Rewrite]");
	$replace = '';
	$str = '<p>'.str_replace($order, $replace, $str).'</p>'; //filterd synopsis
}

?>
<?php 
//mal source data
$xml->entry[0]->id; 
$xml->entry[0]->name; 
$xml->entry[0]->image; 
$synopsis = $str;
//add more like this form xml

?>
</h1>