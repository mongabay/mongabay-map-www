<?php

header('Cache-Control: no-cache, must-revalidate');
header('Expires: Mon, 26 Jul 1997 05:00:00 GMT');
header('Content-type: application/json');

require_once("../xml2array.inc.php");

$limit = 4500;
if (!empty($_GET["limit"])) {
	$limit = intval($_GET["limit"]);
}

$feed = "environment1";
if (!empty($_GET["feed"])) {
	$feed = $_GET["feed"];
}

$site = "news";
if (!empty($_GET["site"])) {
	$site = $_GET["site"];
}

//$xml = file_get_contents("http://{$site}.mongabay.com/xml/{$feed}.xml?limit={$limit}");
//$xml = file_get_contents("http://www.mongabay.co.id/feed/");
$xml = file_get_contents("http://localhost/code/mongabay-map-www/json/mongabay.co.id/test.xml");
$obj = xml2array($xml,$get_attributes=1);
$out = array();

foreach ($obj['rss']['channel']['item'] as $i => $v) {
	
	$node = array();

	$node["guid"] = substr($v["guid"],4+strpos($v["guid"],"/?p="));
	$node["published"] = @date("D, j M Y H:i:s O", @strtotime($v["pubDate"]));
	// $node["updated"] = $v["updated"];
	$node["loc"] = $v["link"];
	$node["title"] = 
		str_replace(
		array(	"&#8212;",	"&amp;", 	"’", 	"'", 	"'", 	"‘"	),
		array(	"—",				"&", 			"",		"", 	"",		""	),
			$v["title"]
		)
		;

	$v["content"] = 
		str_replace(
		array(	"&#8212;",	"&amp;", 	"’", 	"'", 	"'", "‘"	),
		array(	"—",				"&", 			"",		"", 	"", ""	),
			$v["description"]
		)
	;
	if (strpos($v["content"],"</table>") > 0) {
		$node["description"] = strip_tags(substr($v["content"],8+strpos($v["content"],"</table>")));
	} else {
		$node["description"] = strip_tags($v["content"]);
	}
	$node["description"] = substr($node["description"],0,strpos($node["description"],"[&#8230;]"));
	
	$node["author"] = $v["dc:creator"];
	
	$node["lat"] = floatval($v["latitude"]["name"]);
	$node["lon"] = floatval($v["longitude"]["name"]);
	

	if (strpos($v["content:encoded"],"<img ") > 0) {
		$node["thumbnail"] = substr($v["content:encoded"],6+strpos($v["content:encoded"]," src=\""));
		$node["thumbnail"] = substr($node["thumbnail"],0,strpos($node["thumbnail"],"\""));
	} else {
		$node["thumbnail"] = "";
	}

	
	$categ = array();
	foreach ($v["category"] as $i_=>$v_) {
		if (count($v_) > 0) {
			$categ[count($categ)] = strtolower($v_);
		}
	}
	$node["keywords"] = str_replace("'","",$categ);
	
//	if (intval($node["lon"]) != 0) {
		array_push($out,json_encode($node));	
//	}

}

echo "[".implode(",",$out)."]";

?>
