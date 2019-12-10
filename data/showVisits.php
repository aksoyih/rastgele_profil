<?php
$fp = fopen("visitsProfile.txt", "r");
$numberOfProfileCreations = fread($fp, 1024);
fclose($fp);

$fp2 = fopen("visits.txt", "r");
$numberOfApiRequests = fread($fp2, 1024);
fclose($fp2);

echo "<h3>Number of profile creations: $numberOfProfileCreations<br>Number of API requests: $numberOfApiRequests</h3>";
?>
