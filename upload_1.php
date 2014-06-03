<!DOCTYPE html>

<html>

<body>

<?php

//Load the PHP SDK
require "aws.phar";

//We're assuming all of the info related to the file you want to load are being posted from another file
$data = $_POST["data"]; 
$fileName = $_POST["name"];
$size = $_POST["size"];
$description = $_POST["description"];
unlink("files/temp"); //Delete file 'temp' from web directory 'files'.  This is the location where we store all uploaded files before transferring them to Glacier
$filepath = "files/temp";  //Set the $filepath variable for use below
$fp = fopen($filepath, "w"); //Create the temp file
fwrite($fp, $data); //Write to temp file using data from the POST 

use Aws\Glacier\GlacierClient;
use Aws\Common\Enum\Region;

//This is where we connect to the Glacier Server
$aws = GlacierClient::factory(array(
	'key' => 'your key', //Your key and secret key are found at https://portal.aws.amazon.com/gp/aws/securityCredentials
	'secret' => 'your secret key',
	'region' => Region::US_EAST_1 //This is the server cluster we are connecting to.  US_EAST_1 is Northern Virginia.  US_WEST_1 is Northern California.  US_WEST_2 is Oregon
));

$aws->createVault(array('vaultName' => 'new-vault'));  //Creating a new vault called 'new-vault'

//Uploading the file I just added to my webserver onto Glacier
$result = $aws->uploadArchive(array(
	'vaultName' => 'new-vault', //Vault to add to 
	'archiveDescription' => 'mytestfile', //Description given to my file
	'body' => fopen("files/temp", "r") //File itself being transferred
));

$archiveId = $result->get('archiveId'); //Return the ID of the file I just uploaded.  This is important, make sure to save it (along with other identifying info related to the file)!

echo $archiveId;
					   
?>

</body>

</html>