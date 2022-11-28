<?php
class MyDB extends SQLite3
{
    public $rootDir;
    function __construct()
    {
        $this->rootDir = realpath($_SERVER["DOCUMENT_ROOT"]);
        $this->open($this->rootDir . '/test.db');
    }

    public function CreateTables()
    {
        $this->exec('CREATE TABLE IF NOT EXISTS fruits (id INTEGER PRIMARY KEY, name TEXT, amount INTEGER, CHECK (amount > 0))');
    }

    public function AddFruit($name, $amount)
    {
        $this->exec("INSERT INTO fruits (name, amount) VALUES ('$name', '$amount')");
    }

    public function GetFruits()
    {
        $results = $this->query('SELECT * FROM fruits');
        return $results;
    }

    public function BuyFruit($id)
    {
        $this->exec("UPDATE fruits SET amount = amount - 1 WHERE id = $id");
        if ($this->changes() == 0) {
            $this->exec("DELETE FROM fruits WHERE id = $id");
        }
    }

    function __destruct()
    {
        $this->close();
    }
}

class Logger
{
    private $logFile;

    function __construct()
    {
        $this->logFile = fopen(realpath($_SERVER["DOCUMENT_ROOT"]) . "/log.txt", "a");
        $this->Log("Logger created");
    }

    public function Log($message)
    {
        fwrite($this->logFile, $message . PHP_EOL);
    }

    public function __destruct()
    {
        $this->Log("Logger destroyed");
        fclose($this->logFile);
    }
}

$logger = new Logger();
$db = new MyDB();

if (!$db) {
    echo $db->lastErrorMsg();
} else {
    $logger->Log("Opened database successfully");
    $db->CreateTables();
}
