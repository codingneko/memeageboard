<?php
class SqlConnection {
    private $password;
    private $username;
    private $dbname;
    private $host;
    public $connection;

    function __construct($host, $username, $password, $dbname) {
        $this->password = $password;
        $this->username = $username;
        $this->dbname = $dbname;
        $this->host = $host;
    }

    public function connect() {
        $this->connection = new mysqli($this->host, $this->username, $this->password, $this->dbname);
    }

    public function uploadFile($file, $tags) {
        if (isset($this->connection)) {
            $statement = $this->connection->prepare("INSERT INTO images (file_name, tags) VALUES (?, ?)");
            $statement->bind_param('ss', $file, $tags);
            print_r($file);
            $statement->execute();
        } else {
            throw new Exception('You need to use `connect()` first', 1);
        }

        return true;
    }

    public function fetchFiles() {
        if (isset($this->connection)) {
            $query_res = $this->connection->query("SELECT * FROM images");
            $files = [];
            while($file = $query_res->fetch_assoc()) {
                array_push($files, $file);
            }

            return $files;
        } else {
            throw new Exception('You need to use `connect()` first', 1);
        }
    }
}