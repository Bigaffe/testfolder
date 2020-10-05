<?php

class DB{

    static function connect(){

        $con = new mysqli("localhost","affe","abc123","food","3306");
        return $con;
    }


    static function fetchAll($tableName = "dishes"){

        $con = self::connect();
        $result = $con->query("SELECT * FROM $tableName");
        $returnArr = $result->fetch_all(MYSQLI_ASSOC);
        $result->free_result();
        $con->close();
        return $returnArr;

    }

    static function fetchBy($id, $fieldType, $tableName="dishes"){

   
            $con = self::connect();
            $result = $con->query("SELECT * FROM $tableName WHERE $fieldType = '$id'");
            $returnArr = $result->fetch_all(MYSQLI_ASSOC);
            $result->free_result();
            $con->close();
            return $returnArr;
      

      
    }

    static function search($s,$tableName="dishes",$fieldName="name"){
        $con = self::connect();
        $stmt = $con->prepare("SELECT * FROM $tableName WHERE $fieldName LIKE ? "); 
        $qs = "%".$s."%";
        $stmt->bind_param("s",$qs);
        $stmt->execute();
        $result = $stmt->get_result();
        $returnArr = $result->fetch_all();
        $result->free_result();
        $con->close();
        return $returnArr;
    }


    static function insert($data,$tableName="dishes"){

        $keys = [];
        $values = [];
        foreach($data as $key=>$val)
        {
            $keys[]= $key;  // push
            $values[]="'".$val."'";  // push
        }

        $keys = implode(",",$keys);
        $values = implode(",",$values);

        $queryString = "INSERT INTO $tableName ($keys) VALUES ($values)";
        $con = self::connect();
        $result = $con->query($queryString);
        $returnId = $con->insert_id;
        $con->close();
        return $returnId;

    }

    static function deleteById($id, $tableName="dishes"){

        if(!is_int($id)){
            return "error";
        }
        else{
            $con = self::connect();
            $result = $con->query("DELETE  FROM $tableName WHERE id = ".$id);
            $con->close();
            return $result;
        }

      
    }

    static function update($data,$id,$tableName="dishes"){


        if(!is_int($id)){
            return "error";
        }
        else{

        $strArr = [];
        foreach($data as $key=>$val)
        {
            $strArr[] = $key." = '".$val."'";
        }
        $str = implode(",",$strArr);

        $queryString = "UPDATE $tableName SET ".$str. " WHERE id = $id";
       
        $con = self::connect();
        $result = $con->query($queryString);
        
        $con->close();
        return $result;

        }

    }



/*     static function insert($data){

      
        $quote = $data['quote'];
        $author = $data['author'];

        $queryString = "INSERT INTO dishes (quote, author) VALUES ('$quote','$author')";
        $con = self::connect();
        echo "<hr>".$queryString;
        $result = $con->query($queryString);
        var_dump($result);
        $con->close();

    } */



}

