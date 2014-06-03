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

//We request a file to be ready for download
$result = $aws->initiateJob(array(
	'vaultName'=>'new-vault',  //The archive is located in the 'new-vault' vault 
	'Type'=>'archive-retrieval',  //We're telling the server that we want to retrieve an individual file.  If you want to retrieve all archives in a vault replace 'archive-retrieval' with 'inventory-retrieval' and comment out the next line
	'ArchiveId'=>'VdaEzFnieY2fpDMZBPjBnqeuUG9daasgvDd9f8HH0i-V0UnRK1VmkXeDEe0HZVYqFEUlfeqbD-OzMfAkDVTLbrHc1rax1PGSHtjMWMmVa5Av7Xv3foMNc3obLd68ToYewh6_8DyN6IuRuA'  //Tell Amazon the ID of the archive you want to download
));

$location = $result->get('location');  //Relative path of the job
$jobid = $result->get('jobId');  //ID of the job to retrieve your data

echo $location;
echo "<br><br>";
echo $jobid;

?>

</body>

</html>