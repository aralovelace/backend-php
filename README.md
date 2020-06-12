# Waldo Backend PHP - JSON Sort

## Please setup the following:
- Create a database called `waldo_backend` or you can change it at the database.php
- fill in your _host_, _DB user name_, _DB password_ in the `database.php`
- In this project, make sure it runs in your Docker or MAMP orVagrant so it can connect to the database.
- run `composer update`

## Description of the Method I used:
In reading the bulky JSON file, I used - **JSON Machine** `(halaxa/json-machine)` package which is an efficient , easy and fast JSON stream parser based on generators for long JSON streams.


For the manipulation of the data,I  used the usual way of dealing bulky data which is storing them in the database by chunks.Ideally I would run it in using cronjob when storing to the database, but since in this challenge I can only do the solution via code only so I use sleep() php function which still paused the server for a given seconds.

- In the `BulkBrokenSorter::sort`after the files has been parsed then it will store in the database.  So in every  20 seconds it will store 3,000 data in the database until  all the 10,000 data will be stored.
- In displaying the 10,000 records `BulkBrokenSorter::renderItems`, I still chunked them into 5,000 records per 6 seconds. 


Though the method class names doesnt really work well with the code, so I won't change anything in the `script.php`

### The Actual Testing
I ran it on my local machine it works. It will have a lot of waiting time considering it has 10,000 records.



## Estimated Time Completed
- 2 hours plus 30 minutes of testing
- Spent a lot of time with the `BulkBrokenSorter::sorting()` functionality. **JSON Machine only** works when iterating the object, but it would exhaust the PHP memory once read the file like using the registered data for the sorting,
- It would be more scalable to use NoSQL database, but due to time constraint and haven't tried any of it yet.
