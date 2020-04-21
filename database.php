<?php

class Database
{
    public function __construct($host = '127.0.0.1', $user = '', $password = '', $db = '', $port = 0)
    {
        $this->host = $host;
        $this->user = $user;
        $this->password = $password;
        $this->db = $db;

        try {
            $this->curser = $this->connect();
        } catch (Exception $e) {
            throw new Exception("Database connection could not be established. Error: $e", 1);
        }
    }

    public function connect()
    {
        return mysqli_connect($this->host, $this->user, $this->password, $this->db);
    }

    public function close()
    {
        return mysqli_close($this->curser);
    }

    public function query($q)
    {
        $this->result = $this->curser->query($q);
        
        if(isset($this->curser->error) && !empty($this->curser->error)){
            throw new Exception($this->curser->error);
        }
        
        $this->close();
    }

    public function queryAll($q)
    {
        $this->query($q);

        if($this->result){
            return $this->result->fetch_all(MYSQLI_ASSOC);
        }else{
            throw new Exception("Querry failed. Error: $e", 1);
        }
    }

    public function queryAssoc($q)
    {
        $this->query($q);

        if($this->result){
            return $this->result->fetch_assoc();
        }else{
            throw new Exception("Querry failed. Error: $e", 1);
        }
    }
    
    public function insert($q)
    {
        $r = $this->curser->query($q);

        if(isset($this->curser->error) && !empty($this->curser->error)){
            throw new Exception($this->curser->error);
        }

        return $r;
    }
}
