<?php
class SqlConnection {
    private string $password;
    private string $username;
    private string $dbname;
    private string $host;
    public PDO $connection;

    public function __construct() {
        $this->password = '';
        $this->username = 'root';
        $this->dbname = 'memeageboard';
        $this->host = 'localhost';
        $this->connection = new PDO("mysql:host=$this->host;dbname=$this->dbname;charset=UTF8", $this->username, $this->password);

        $this->connection->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    }
}