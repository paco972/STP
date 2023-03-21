<?php
    // Connexion à la BDD
    include("db_connect.php");
    $method = $_SERVER["REQUEST_METHOD"];

    function getEtudiants() {
        global $conn;
        $etudiants = array();
        $query = "SELECT * FROM etudiant";
        $result = mysqli_query($conn, $query);
        while($row = mysqli_fetch_array($result))
        {
            $etudiant = array();
            $etudiant['id'] = $row['id'];
            $etudiant['nom'] = $row['nom'];
            $etudiant['prenom'] = $row['prenom'];
            $etudiant['section'] = $row['section'];
            $etudiant['user'] = $row['user'];
            $etudiant['pwd'] = $row['pwd'];
    
            array_push($etudiants, $etudiant);
        }
        echo json_encode($etudiants);    
    }

    function getEtudiant($id=0) {
        global $conn;
        $query = "SELECT * FROM etudiant WHERE id = ".$id;
        // echo $query;
        $result = mysqli_query($conn, $query);
        while($row = mysqli_fetch_array($result))
        {
            $etudiant = array();
            $etudiant['id'] = $row['id'];
            $etudiant['nom'] = $row['nom'];
            $etudiant['prenom'] = $row['prenom'];
            $etudiant['section'] = $row['section'];
    
        }
        echo json_encode($etudiant);    
    }

    function addEtudiant() {
        global $conn;
        $etudiant = json_decode(file_get_contents("php://input"));
        $nom = $etudiant->nom;
        $prenom = $etudiant->prenom;
        $section = $etudiant->section;
        $user = $etudiant->user;
        $pwd = $etudiant->pwd;
        $hash = password_hash($pwd, PASSWORD_DEFAULT);
        $query = "INSERT INTO etudiant (`nom`, `prenom`, `section`, `user`, `pwd`) 
            VALUES ('".$nom."', '".$prenom."', '".$section."', '".$user."', '".$hash."');";
        echo $query;
        if (mysqli_query($conn, $query)) {
            $response = array(
                'status' => 1,
                'message' => 'Ajout étudiant OK'
            );
        }
        else {
            $response  = array(
                'status' => 0,
                'message' => 'Erreur ajout étudiant'
            );
        };
        header('Content-Type: application/json');
        echo json_encode($response);
    }

    function updateEtudiant($id) {
        global $conn;
        $etudiant = json_decode(file_get_contents("php://input"));
        $nom = $etudiant->nom;
        $prenom = $etudiant->prenom;
        $section = $etudiant->section;
        $query = "UPDATE etudiant 
                    SET nom = '".$nom."', prenom = '".$prenom."', section = '".$section."'
                    WHERE id = ".$id;
        // echo $query;
        if (mysqli_query($conn, $query)) {
            $response = array(
                'status' => 1,
                'message' => 'Mise à jour étudiant OK'
            );
        }
        else {
            $response  = array(
                'status' => 0,
                'message' => 'Erreur mise à jour étudiant'
            );
        };
        header('Content-Type: application/json');
        echo json_encode($response);
    }

    function deleteEtudiant($id) {
        global $conn;
        $query = "DELETE FROM etudiant WHERE id = ".$id;
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
                getEtudiants();
            }
            else {
                $id = intval($_GET["id"]);
                getEtudiant($id);
            }
            break;
            
        case 'POST' :
            addEtudiant();
            break;

        case 'PUT' :
            $id = intval($_GET["id"]);
            updateEtudiant($id);
            break;

        case 'DELETE' :
            $id = intval($_GET["id"]);
            deleteEtudiant($id);
            break;

        default :
            // Méthode non autorisée
            header("HTTP/1.0 405 Method not allowed : ");
    }    
?>