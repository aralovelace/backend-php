<?php

use Functions\StreamBytes;

require 'vendor/autoload.php';
require_once __DIR__ . '/SortInterface.php';
require_once __DIR__.'/database.php';

class BulkBrokenSorter implements SortInterface
{
    protected $fileName;
    protected $items;
    protected $con;

    public function __construct($fileName)
    {
        $this->fileName = $fileName;
        $db = new Database();
        $this->con = $db->getConnection();
    }

    /**
     * @var \JsonMachine\JsonMachine
     */
    public function sort(): void
    {
        $this->con->prepare("DELETE FROM bigfiles")->execute();
        $items  = \JsonMachine\JsonMachine::fromFile($this->fileName);
         $pause = 3000;
         $count = 0;
           foreach ($items as $item) {
               $this->con->prepare("INSERT INTO bigfiles (data,registered) VALUES (?,?)")
                   ->execute([ json_encode($item), $item['registered']]);
               $count++;
               if ($count>=$pause){
                   sleep(10);
                   $count= 0;
               }
           }
        sleep(20);
    }

    public function test() {

        $limit =  10;
        $offset = 0;
        while ($offset < 100) {
            $data = $this->con->query("SELECT * FROM bigfiles ORDER BY registered ASC LIMIT " . $offset . " , " . $limit)
                ->fetchAll();
            foreach ($data as $person) {
                print ("\n".$person['id']);
            }
            $offset +=$limit;
            print ("\n");
            }


    }

    public function renderItems(): void
    {

        $nRows = $this->con->query('select count(*) from bigfiles')->fetchColumn();
        $limit =  5000;
        $offset = 0;
        $c=0;

        while ($c < $nRows) {
            $data = $this->con->query("SELECT * FROM bigfiles ORDER BY registered ASC LIMIT " . $offset . " , " . $limit)
                ->fetchAll();

            foreach ($data as $person) {
                $jsonData = $person['data'];
                var_dump(json_decode($jsonData));
                $c++;
            }
            $offset +=$limit;
            sleep(6);



        }


    }
}


?>