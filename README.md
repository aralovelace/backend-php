# Waldo Backend PHP - JSON Sort

## Please setup the following:
- Create a database called 'waldo_backend' or you can change it at the database.php
- fill in your host, DB user name, DB password at the database.php
- in copying this folder, make sure it runs in your Docker or MAMP orVagrant so it can connect to the database.
- run 'composer update'

## Description of the Method I used:
In reading the bulky JSON file, I used - JSON Machine (halaxa/json-machine) package which is an efficient , easy and fast JSON stream parser based on generators for long JSON streams.

For the manipulation of the data, Ideally my plan is to run 
a scheduled task in storing them in the database after it has been parsed.
So in every  minute it will store 5,000 data until  all the 10,000 data will be
stored in the Database. Running it to my local machine it works - I used sleep(10) so it will pause for 10 seconds for every 3000
data. It is not ideal to run in the server like this, so if it runs in the server, 
the standard way is to  use a scheduled task or cron job.



## Estimated Time Completed
- 2 hours plus 30 minutes of testing
- Spent a lot of time with the BulkBrokenSorter::sorting() functionality. JSON Machine only works when iterating the object, but it would exhaust the PHP memory once read the file like using the registered data for the sorting,
- I also use the usual way when dealing bulky data which is storing them in the database by chunks.
- Ideally it would be more scalable to a NoSQL database, but due to time constraint and haven't tried any of it yet.