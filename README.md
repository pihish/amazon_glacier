amazon_glacier
==============

A couple of quick code snippets that will allow you to upload and download from Amazon Glacier using the PHP SDK.  There's been a lack of working examples ever since Glacier support was introduced to the PHP SDK.  Hopefully, this will serve as a quick springboard for anybody looking to jump into using Glacier.

What you'll need:

1. The aws.phar file (included in this Git)

There are four main steps in the Glacier use cycle:

1. Creating a vault (this is the equivalent of a folder) and adding archives (equivalent of a file) to the vault

2. Once you have uploaded files onto your instance of Glacier, you need to initiate jobs to get the files ready for download.  A Glacier job takes four to five hours to complete.  Once the job is complete, you will be able to download your file

3. Checking the status of jobs you've started

4. Downloading files after jobs are complete

Each of the above four steps are individually represented with a separate PHP file in this Git
