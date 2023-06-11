<?php
 header('Access-Control-Allow-Origin: http://localhost:4200');
 header('Access-Control-Allow-Credentials: true');
 header('Access-Control-Allow-Methods: GET, POST');
 header('Access-Control-Allow-Headers: Content-Type');
class Estado
{
    private $id_estado;
    private $no_estado;
    private $co_estado;


    public static function findAll()
    {
       
        require 'Connection.php';
        $conn = new Connection();
        $conn->connect();
        $query = 'SELECT * FROM estados';
        $result = $conn->query($query);
        $estados = [];
        while ($data = $result->fetch_assoc()) {
           
            array_push($estados, $data);
        }
        echo json_encode(['success' => true,'data'=>$estados]);
    }
}
