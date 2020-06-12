<?php

require __DIR__ . '/SortInterface.php';

class BrokenSorter implements SortInterface
{
    protected $fileName;
    protected $items;

    public function __construct($fileName)
    {
        $this->fileName = $fileName;
    }

    public function sort(): void
    {
        $fileContents = file_get_contents($this->fileName);
        $this->items = json_decode($fileContents, true);

        usort($this->items, function($a, $b) {
            return $a['registered'] <=> $b['registered'];
        });
    }

    public function renderItems(): void
    {
        foreach($this->items as $item) {
            var_dump($item);
        }
    }
}
