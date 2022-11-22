<?php 
    require "../Controller/connect.php";
    
    function fetchData($query){
        global $conn;
        $rawData = $conn->query($query);
        $data = [];
        while($row = mysqli_fetch_assoc($rawData)){
            $data[] = $row;
        }

        return $data;
    }

    function fetchScalar($query){
        global $conn;
        $rawData = $conn->query($query);
        $data = mysqli_fetch_column($rawData);

        return $data;
    }

    function crud($query){
        global $conn;

        $conn->query($query);

        return $conn->affected_rows;
    }

    function toDate($rawDate){
        return date("Y-m-d", strtotime($rawDate));
    }

?>