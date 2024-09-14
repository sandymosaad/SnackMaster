

<?php
ini_set('display_errors', '1');
ini_set('display_startup_errors', '1');
error_reporting(E_ALL);


class db
{

    private $server = 'localhost';
    private $username = 'root';
    private $password = 'Anas_246810';
    private $database = 'Cafeteria';
    private $connection;




    function __construct()
    {
        try{

            $dsn = 'mysql:dbname='.$this->database.';host='.$this->server;
            $this->connection= new PDO($dsn, $this->username, $this->password);
        }
        catch (PDOException $e) {
            echo 'Connection failed: ' . $e->getMessage();
        }
    }

    function get_connection()
    {
        return $this->connection;
    }

    function get_data($table, $condetion = 1)
    {


        $query= "SELECT * FROM $table WHERE $condetion";
        $stmt=$this->connection->prepare($query);
        $colcount = $stmt->columnCount();
        $stmt->execute();
        $result=$stmt->fetchAll();
        
        return $result;
    }


    function get_count_data($table, $condetion = 1)
    {


        $query= "SELECT * FROM $table WHERE $condetion";
        $stmt=$this->connection->prepare($query);
        $stmt->execute();
        $result=$stmt->fetchAll();
        $colcount =count($result);
        
        
        return $colcount;
    }

    function get_data_col($col,$table, $condetion = 1)
    {


        $query= "SELECT $col FROM $table WHERE $condetion";
        $stmt=$this->connection->prepare($query);
        $colcount = $stmt->columnCount();
        $stmt->execute();
        $result=$stmt->fetchAll();
        
        return $result;
    }

    function get_count_data_col($col,$table, $condetion = 1)
    {


        $query= "SELECT $col FROM $table WHERE $condetion";
        $stmt=$this->connection->prepare($query);
        $colcount = $stmt->columnCount();
        $stmt->execute();
        $result=$stmt->fetchAll();
        $colcount =count($result);
        
        
        return $colcount;    }

    

    function delete_data($table, $condetion)
    {

        $query= "delete  FROM $table WHERE ?";
        $stmt=$this->connection->prepare($query);
        $stmt->execute([ $condetion ]);
        $result=$stmt->fetchAll();
        
        return $result;
        // return $this->connection->query("delete  FROM $table WHERE $connection");
    }
    function insert_data($table, $cols, $value)
    {

        $query= "insert into $table ($cols)  values(?)";
        $stmt=$this->connection->prepare($query);
        $stmt->execute([ $value ]);
        $result=$stmt->fetchAll();

        return $result;
        // return $this->connection->query("insert into $table ($cols)  values($value)");
    }

    function update_data($table,$cols,$condetion)
    {

        $query= "UPDATE $table SET $cols WHERE $condetion";
        $stmt=$this->connection->prepare($query);
        $stmt->execute();
        $result=$stmt->fetchAll();

        return $result;

        // return $this->connection->query("UPDATE $table SET $cols WHERE $condetion");
    }
}

?>