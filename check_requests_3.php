<!DOCTYPE html>

<html>

<body>

<?php

//Load the PHP SDK
require "aws.phar"; 

use Aws\Glacier\GlacierClient;
use Aws\Common\Enum\Region;	

//This is where we connect to the Glacier Server
$aws = GlacierClient::factory(array(
	'key' => 'your key',  //Your key and secret key are found at https://portal.aws.amazon.com/gp/aws/securityCredentials
	'secret' => 'your secret key',
	'region' => Region::US_EAST_1  //This is the server cluster we are connecting to.  US_EAST_1 is Northern Virginia.  US_WEST_1 is Northern California.  US_WEST_2 is Oregon
));

//Request an update on all of your jobs
$result = $aws->listJobs(array(
	'vaultName' => 'new-vault',  //Tell Amazon the name of the vault that the jobs you want to check on belong to
));

$array = $result->get('JobList');  //Creates an array with metadata regarding your jobs

print_r($array);

?>

</body>

</html>