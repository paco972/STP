<?php
    // Connexion à la BDD
    include("db_connect.php");
    $method = $_SERVER["REQUEST_METHOD"];

    function getConnexions() {
        global $conn;
        $connexions = array();
        $query = "SELECT * FROM connexion";
        $result = mysqli_query($conn, $query);
        while($row = mysqli_fetch_array($result))
        {
            $connexion = array();
            $connexion['id'] = $row['id'];
            $connexion['idEtudiant'] = $row['idEtudiant'];
            $connexion['idMaquette'] = $row['idMaquette'];
            $connexion['debut'] = $row['debut'];
            $connexion['fin'] = $row['fin'];
            array_push($connexions, $connexion);
        }
        echo json_encode($connexions);    
    }

    function getConnexion($id=0) {
        global $conn;
        $query = "SELECT * FROM connexion WHERE id = ".$id;
        // echo $query;
        $result = mysqli_query($conn, $query);
        while($row = mysqli_fetch_array($result))
        {
            $connexion = array();
            $connexion['id'] = $row['id'];
            $connexion['idEtudiant'] = $row['idEtudiant'];
            $connexion['idMaquette'] = $row['idMaquette'];
            $connexion['debut'] = $row['debut'];
            $connexion['fin'] = $row['fin'];
        }
        echo json_encode($connexion);    
    }

    function addConnexion() {
        global $conn;
        $connexion = json_decode(file_get_contents("php://input"));
        $idEtudiant = $connexion->idEtudiant;
        $idMaquette = $connexion->idMaquette;
        $query = "INSERT INTO connexion (`idEtudiant`, `idMaquette`) 
            VALUES ('".$idEtudiant."', '".$idMaquette."');";
        // echo $query;
        if (mysqli_query($conn, $query)) {
            $response = array(
                'status' => 1,
                'message' => 'Ajout connexion OK'
            );
        }
        else {
            $response  = array(
                'status' => 0,
                'message' => 'Erreur ajout connexion'
            );
        };
        header('Content-Type: application/json');
        echo json_encode($response);
    }

    function updateConnexion($id) {
        global $conn;
        //$connexion = json_decode(file_get_contents("php://input"));
        //$fin = $connexion->fin;
        $query = "UPDATE connexion SET fin = NOW() WHERE id = ".$id;
        // echo $query;
        if (mysqli_query($conn, $query)) {
            $response = array(
                'status' => 1,
                'message' => 'Mise à jour connexion OK'
            );
        }
        else {
            $response  = array(
                'status' => 0,
                'message' => 'Erreur mise à jour connexion'
            );
        };
        header('Content-Type: application/json');
        echo json_encode($response);
    }

    function deleteConnexion($id) {
        global $conn;
        $query = "DELETE FROM connexion WHERE id = ".$id;
        // echo $query;
        if (mysqli_query($conn, $query)) {
            $response = array(
                'status' => 1,
                'message' => 'Suppression connexion OK'
            );
        }
        else {
            $response  = array(
                'status' => 0,
                'message' => 'Erreur suppression connexion'
            );
        };
        header('Content-Type: application/json');
        echo json_encode($response);
    }

    switch($method) {
        case 'GET' :
            if (empty($_GET["id"])) {
                getConnexions();
            }
            else {
                $id = intval($_GET["id"]);
                getConnexion($id);
            }
            break;
            
        case 'POST' :
            addConnexion();
            break;

        case 'PUT' :
            $id = intval($_GET["id"]);
            updateConnexion($id);
            break;

        case 'DELETE' :
            $id = intval($_GET["id"]);
            deleteConnexion($id);
            break;

        default :
            // Méthode non autorisée
            header("HTTP/1.0 405 Method not allowed : ");
    }    
?>