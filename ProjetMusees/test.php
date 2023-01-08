 <?php
// create curl resource 
$ch = curl_init();

// set url 
curl_setopt($ch, CURLOPT_URL, "https://api.nextendweb.com/");

//return the transfer as a string 
curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);

$errorFile = dirname(__FILE__) . '/curl_error.txt';
$out       = fopen($errorFile, "w");
curl_setopt($ch, CURLOPT_VERBOSE, true);
curl_setopt($ch, CURLOPT_STDERR, $out);

// $output contains the output string 
$output = curl_exec($ch);

curl_close($ch);
fclose($out);

echo "<h1>LOG</h1>";
echo "<pre>";
echo htmlspecialchars(file_get_contents($errorFile));
unlink($errorFile);
echo "</pre>";