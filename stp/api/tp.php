<?php
    // Connexion à la BDD
    include("db_connect.php");
    $method = $_SERVER["REQUEST_METHOD"];

    function getTps() {
        global $conn;
        $tps = array();
        $query = "SELECT * FROM tp";
        $result = mysqli_query($conn, $query);
        while($row = mysqli_fetch_array($result))
        {
            $tp = array();
            $tp['id'] = $row['id'];
            $tp['titre'] = $row['titre']; //echo $row[titre];
            $tp['difficulte'] = $row['difficulte'];
            $tp['duree'] = $row['duree'];
            $tp['urlSujet'] = $row['urlSujet'];
    
            array_push($tps, $tp);
        }
        echo json_encode($tps);    
    }

    function getTp($id=0) {
        global $conn;
        $query = "SELECT * FROM tp WHERE id = ".$id;
        // echo $query;
        $result = mysqli_query($conn, $query);
        while($row = mysqli_fetch_array($result))
        {
            $tp['id'] = $row['id'];
            $tp['titre'] = $row['titre'];
            $tp['difficulte'] = $row['difficulte'];
            $tp['duree'] = $row['duree'];
            $tp['urlSujet'] = $row['urlSujet'];
        }
        echo json_encode($tp);    
    }

    function addTP() {
        global $conn;
        $tp = json_decode(file_get_contents("php://input"));
        $titre = $tp->titre;
        $difficulte = $tp->difficulte;
        $duree = $tp->duree;
        $urlSujet = $tp->urlSujet;
        $maquetteid = $tp->maquetteid;
        $query = "INSERT INTO tp 
            (`titre`, `difficulte`, `duree`, `urlSujet`, `maquetteid`) 
            VALUES ('".$titre."', '".$difficulte."', '".$duree."','".$urlSujet."', '".$maquetteid."');";
        // echo $query;
        if (mysqli_query($conn, $query)) {
            $response = array(
                'status' => 1,
                'message' => 'Ajout TP OK'
            );
        }
        else {
            $response  = array(
                'status' => 0,
                'message' => 'Erreur ajout TP'
            );
        };
        header('Content-Type: application/json');
        echo json_encode($response);
    }

    function updateTp($id) {
        global $conn;
        $tp = json_decode(file_get_contents("php://input"));
        $titre = $tp->titre;
        $difficulte = $tp->difficulte;
        $duree = $tp->duree;
        $urlSujet = $tp->urlSujet;
        $maquetteid = $tp->maquetteid;
        $query = "UPDATE tp 
                    SET titre = '".$titre."', 
                        difficulte = '".$difficulte."', 
                        duree = '".$duree."',
                        urlSujet = '".$urlSujet."',
                        maquetteid = '".$maquetteid."'
                    WHERE id = ".$id;
        // echo $query;
        if (mysqli_query($conn, $query)) {
            $response = array(
                'status' => 1,
                'message' => 'Mise à jour TP OK'
            );
        }
        else {
            $response  = array(
                'status' => 0,
                'message' => 'Erreur mise à jour TP'
            );
        };
        header('Content-Type: application/json');
        echo json_encode($response);
    }

    function deleteTp($id) {
        global $conn;
        $query = "DELETE FROM tp WHERE id = ".$id;
        // echo $query;
        if (mysqli_query($conn, $query)) {
            $response = array(
                'status' => 1,
                'message' => 'Suppression étudiant OK'
            );
        }
        else {
            $response  = array(
                'status' => 0,
                'message' => 'Erreur suppression étudiant'
            );
        };
        header('Content-Type: application/json');
        echo json_encode($response);
    }

    switch($method) {
        case 'GET' :
            if (empty($_GET["id"])) {
                getTps();
            }
            else {
                $id = intval($_GET["id"]);
                getTp($id);
            }
            break;
            
        case 'POST' :
            addTP();
            break;

        case 'PUT' :
            $id = intval($_GET["id"]);
            updateTp($id);
            break;

        case 'DELETE' :
            $id = intval($_GET["id"]);
            deleteTp($id);
            break;

        default :
            // Méthode non autorisée
            header("HTTP/1.0 405 Method not allowed : ");
    }    
?>