<?php 

class Database {
    
    public mysqli $connection_string;
    
    public function __construct() { 
        try { 
            $this->connection_string = mysqli_connect('localhost', 'root', '', 'mvc');
        } catch (Exception $e) { 
            var_dump($e);
        }
    }

    public function execute(string $query,  array $params = []) { 
       try { 
            $stmt = $this->connection_string->prepare($query); 
            $result = $stmt->execute($params); 
            $result = $stmt->get_result();
            return $result;
       } catch (Exception $e) { 
            var_dump($e);
       }
    }

    public function insert(string $table, array $params){ 
        try { 
            $query = "INSERT INTO $table (".implode(',', array_keys($params)).") VALUES (".implode(',', array_fill(0, count($params), '?')).")";
            $stmt = $this->connection_string->prepare($query);
            $stmt->execute(array_values($params));
            return $stmt;
        } catch (Exception $e) {
            return $e;
        }
    }

    public function update(string $table, array $params, array $where){
        try {
            $query = "UPDATE $table SET ".implode(',', array_map(fn($key) => "$key = ?", array_keys($params)))." WHERE ".implode(' AND ', array_map(fn($key) => "$key = ?", array_keys($where)));
            $stmt = $this->connection_string->prepare($query);
            $stmt->execute(array_merge(array_values($params), array_values($where)));
            return $stmt;
        } catch (Exception $e) {
            var_dump($e);
        }
    }

    public function delete(string $table, array $where){
        try {
            $query = "DELETE FROM $table WHERE ".implode(' AND ', array_map(fn($key) => "$key = ?", array_keys($where)));
            $stmt = $this->connection_string->prepare($query); 
            $stmt->execute(array_values($where)); 
            return $stmt; 
        } catch (Exception $e) { 
            var_dump($e);
        }
    }
}