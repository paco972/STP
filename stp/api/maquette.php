<?php
    // Connexion à la BDD
    include("db_connect.php");
    $method = $_SERVER["REQUEST_METHOD"];

    function getMaquettes() {
        global $conn;
        $maquettes = array();
        $query = "SELECT * FROM maquette";
        $result = mysqli_query($conn, $query);
        while($row = mysqli_fetch_array($result))
        {
            $maquette = array();
            $maquette['id'] = $row['id'];
            $maquette['type'] = $row['type'];
            $maquette['disponible'] = $row['disponible'];
            $maquette['adresseIP'] = $row['adresseIP'];
            array_push($maquettes, $maquette);
        }
        echo json_encode($maquettes);    
    }

    function getMaquette($id=0) {
        global $conn;
        $query = "SELECT * FROM maquette WHERE id = ".$id;
        // echo $query;
        $result = mysqli_query($conn, $query);
        while($row = mysqli_fetch_array($result))
        {
            $maquette = array();
            $maquette['id'] = $row['id'];
            $maquette['type'] = $row['type'];
            $maquette['disponible'] = $row['disponible'];
            $maquette['adresseIP'] = $row['adresseIP'];
        }
        echo json_encode($maquette);    
    }

    function addMaquette() {
        global $conn;
        $maquette = json_decode(file_get_contents("php://input"));
        $type = $maquette->type;
        $adresseIP = $maquette->adresseIP;
        $query = "INSERT INTO maquette (`type`, `adresseIP`) 
            VALUES ('".$type."', '".$adresseIP."');";
        // echo $query;
        if (mysqli_query($conn, $query)) {
            $response = array(
                'status' => 1,
                'message' => 'Ajout maquette OK'
            );
        }
        else {
            $response  = array(
                'status' => 0,
                'message' => 'Erreur ajout maquette'
            );
        };
        header('Content-Type: application/json');
        echo json_encode($response);
    }

    function updateMaquette($id) {
        global $conn;
        $maquette = json_decode(file_get_contents("php://input"));
        //echo file_get_contents("php://input")."<br/>";
        $type = $maquette->type;
        $adresseIP = $maquette->adresseIP;
        $disponible = $maquette->disponible;
        $query = "UPDATE maquette 
                    SET 
                        type = '".$type."', 
                        adresseIP = '".$adresseIP."',
                        disponible = '".$disponible."'
                    WHERE id = ".$id;
        //echo $query;
        if (mysqli_query($conn, $query)) {
            $response = array(
                'status' => 1,
                'message' => 'Mise à jour maquette OK'
            );
        }
        else {
            $response  = array(
                'status' => 0,
                'message' => 'Erreur mise à jour maquette'
            );
        };
        header('Content-Type: application/json');
        echo json_encode($response);
    }

    function deleteMaquette($id) {
        global $conn;
        $query = "DELETE FROM maquette WHERE id = ".$id;
        // echo $query;
        if (mysqli_query($conn, $query)) {
            $response = array(
                'status' => 1,
                'message' => 'Suppression maquette OK'
            );
        }
        else {
            $response  = array(
                'status' => 0,
                'message' => 'Erreur suppression maquette'
            );
        };
        header('Content-Type: application/json');
        echo json_encode($response);
    }

    switch($method) {
        case 'GET' :
            if (empty($_GET["id"])) {
                getMaquettes();
            }
            else {
                $id = intval($_GET["id"]);
                getMaquette($id);
            }
            break;
            
        case 'POST' :
            addMaquette();
            break;

        case 'PUT' :
            $id = intval($_GET["id"]);
            updateMaquette($id);
            break;

        case 'DELETE' :
            $id = intval($_GET["id"]);
            deleteMaquette($id);
            break;

        default :
            // Méthode non autorisée
            header("HTTP/1.0 405 Method not allowed : ");
    }    
?>