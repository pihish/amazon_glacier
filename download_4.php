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

//Download our archive from Amazon to our server
$result = $aws->getJobOutput(array(
	'vaultName' => 'new-vault',  //The archive is located in the 'new-vault' vault
	'jobId' => '-jlRMxi3sC5fj-hWX-IF6KqXYEAkYfsXjJwGH6Yr7XVZxmo121AgGuILPGM3Fvhcs1kBwr28pE0bVNLKLrxAArZ3aII4'  //We supply the unique ID of the job that retrieved the archive
));

$data = $result->get('body');  //Sets the file data to a variable
$description = $result->get('archiveDescription');  //Sets file description to a variable

//deletes the temp file on our server if it exists
if(file_exists("files/temp")){
	unlink("files/temp");
}
$filepath = "files/temp";  
$fp = fopen($filepath, "w");  //creates a new file temp file on our web server
fwrite($fp, $data);  //write the data in our variable to our temp file

//Your archive is now ready for download on your web server

echo $description;

?>

</body>

</html>