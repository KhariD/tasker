<?php

class CarAccess
{

    private $db;

    public function __construct($database)
    {
        $this->db = new mysqli("localhost", "ubuntu", "monkey", $database);
        if ($this->db->connect_errno != 0)
        {
            echo "error connecting to database: ".$this->db->connect_error.PHP_EOL;
            exit();
        }
    }

    public function __destruct()
    {
        if (isset($this->db))
        {
            $this->db->close();
        }
    }

    public function validateRep($username, $password)
    {
        $u = $this->db->real_escape_string($username);
        $p = $this->db->real_escape_string($password);

        $q = "select * from users where user = '$u';";

        while ($row = $q->fetch_assoc())
        {
            if ($row["pass"] == $p)
            {
                return true;            
            }
        }
        return false;
        } 
    }

    public function determineUser($user);
    {
        //Assumes user exists
        //Determines if user is owner or sales representative
        // T if rep
        // F if owner
        $u = $this->db->real_escape_string($user);

        $q = "Select * from reps where user = '$u';";

        $result = mysql_query($q);
        if (mysql_num_rows($result) > 0)
        {
            return true;
        }
        else
        {
            return false;
        }

    }

    public function validateOwner($username, $password)
    {
        $u = $this->db->real_escape_string($username);
        $p = $this->db->real_escape_string($password);

        $q = "select * from users where username = '$u';";

        while ($row = $q->fetch_assoc())
        {
            if ($row["pass"] == $p)
            {
                return true;            
            }
        }
        return false;
    }

    public function setVehicle($vin, $make, $model, $year, $miles, $type, $color, $trans, $price)
    {   
        $v = $this->db->real_escape_string($vin);
        $m = $this->db->real_escape_string($make);
        $mo = $this->db->real_escape_string($model);
        $y = $this->db->real_escape_string($year);
        $mi = $this->db->real_escape_string($miles);
        $t = $this->db->real_escape_string($type);
        $c = $this->db->real_escape_string($color);
        $tr = $this->db->real_escape_string($trans);
        $p = $this->db->real_escape_string($price);

        $query = "insert into vehicle(vin,make,model,year,miles,type,color,trans,price) VALUES ('$v','$m','$mo','$y','$mi','$t','$c','$tr','$p');";

        echo "executing SQL statement:\n".$query."\n";
        if (!$this->db->query($query))
        {
            echo "failed to insert record for ".$studentName.PHP_EOL;
        }
    }

    public function getVehicles()
    {
        //list vehicles based on automatic, manual or both
        $sql = "select * from vehicle;";

        $sqlResponse = $this->db->query($sql);
        
        $response = array();

        while ($row = $sqlResponse->fetch_assoc())
        {
            $response = $row;
        }

        echo "executing SQL statement:\n".$sql."\n";
        if (!$this->db->query($sql))
        {
            return "failed to show list of vehicles".PHP_EOL; 
        }

        return $response;
    }

    public function showVehicle($vin)
    {
        $sql = "select * from vehicle where vin = '$vin';";

        $sqlResponse = $this->db->query($sql);

        $response = $sqlResponse->fetch_assoc();

        echo "executing SQL statement:\n".$sql."\n";
        if (!$this->db->query($sql))
        {
            return "Vehicle with vin: ".$vin." Does not exist".PHP_EOL; 
        }

        return $response;
    }

    public function setRep($user, $fname, $lname, $phone, $com)
    {
        
        $u = $this->db->real_escape_string($user);
        $f = $this->db->real_escape_string($fname);
        $l = $this->db->real_escape_string($lname);
        $p = $this->db->real_escape_string($phone);
        $c = $this->db->real_escape_string($com);

        $sql = "insert into reps (user, fname, lname, phone, com) values ('$u', '$f', '$l', '$p', '$c');";

        echo "executing SQL statement:".PHP_EOL.$sql.PHP_EOL;
        if (!$this->db->query($sql))
        {
            echo "failed to insert record for ".$user.PHP_EOL;
        }
    }

    public function getAllSales()
    {
        $sql = "select * from sales";
        
        $sqlResponse = $this->db->query($sql);
        
        $response = array();

        while ($row = $sqlResponse->fetch_assoc())
        {
            $response = $row;
        }

        echo "executing SQL statement:\n".$sql."\n";
        if (!$this->db->query($sql))
        {
            return "failed to show sales".PHP_EOL; 
        }

        return $response;
    }

    public function getSales($user)
    {
        $sql = "select * from sales where user = '$user';";
        
        $sqlResponse = $this->db->query($sql);

        $response = $sqlResponse->fetch_assoc();

        echo "executing SQL statement:\n".$sql."\n";
        if (!$this->db->query($sql))
        {
            return "No sales records found from sales rep: ".$user.PHP_EOL; 
        }

        return $response;
    }

    public function setSale($vin, $user, $date)
    {
        $v = $this->db->real_escape_string($vin);
        $u = $this->db->real_escape_string($user);
        $d = $this->db->real_escape_string($date);
        

        $sql = "insert into reps (vin, user, date) values ('$v', '$u', '$d');";

        echo "executing SQL statement:".PHP_EOL.$sql.PHP_EOL;
        if (!$this->db->query($sql))
        {
            echo "failed to book sale ".PHP_EOL;
        }
    }

    

}

?>