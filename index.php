<?php
// Display erros
error_reporting(E_ALL);
ini_set('display_errors', 1);

// Set the encoding
header('Content-type: text/html; charset=ASCII');

// Function to replace embedded urls to proxied urls
function replace($repl) {
	global $content;
	global $webproxy;
	global $baseurl;
	$content = str_replace($repl . '//', $repl . $webproxy . 'https://', $content);
	$content = str_replace($repl . '/', $repl . $webproxy . $baseurl . '/', $content);
}

// The url of the webproxy instance
$webproxy = 'http' . (isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] === 'on' ? 's' : '') . '://' . $_SERVER['HTTP_HOST'] . strtok($_SERVER['REQUEST_URI'], '?') . '?url=';

// Get the url to proxy
if(isset($_GET['url'])) {
	$url = $_GET['url'];
} else {
	echo 'No url provided. Usage: ' . $webproxy . 'yourUrlToProxy.tld';
	exit;
}

// Get base url of the website to proxy
$baseurl = $url;
if(strpos($url, '?')) {
	$baseurl = explode('?', $url)[0];
}

// Call the website
$curl = curl_init();
curl_setopt($curl, CURLOPT_URL, $url);
curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
curl_setopt($curl, CURLOPT_FOLLOWLOCATION, true);
curl_setopt($curl, CURLOPT_HEADER, false);
curl_setopt($curl, CURLOPT_ENCODING, '');
curl_setopt($curl, CURLOPT_HTTPHEADER, ['Accept-Language: de,en']);
curl_setopt($curl, CURLOPT_USERAGENT, 'Mozilla/5.0 (Windows NT 6.1; Win64; x64; rv:59.0) Gecko/20100101 Firefox/59.0');
$content = curl_exec($curl);
$contentType = curl_getinfo($curl, CURLINFO_CONTENT_TYPE);
//$content = utf8_decode($content);
curl_close($curl);

// Set content type
header('Content-Type: ' . $contentType);

// Replace the embedded urls to proxied urls
$content = str_replace('https://', $webproxy . 'https://', $content);
$content = str_replace('http://', $webproxy . 'http://', $content);

replace('href="');
replace('href=\'');
replace('src="');
replace('src=\'');
replace('action="');
replace('action=\'');

// Xenforo uses no leading '/' for css files
$content = str_replace('href="css.php', 'href="' . $webproxy . $baseurl . '/css.php', $content);

// Display the proxied website
echo $content;
?>
