<?php
    // Connexion à la BDD
    include("db_connect.php");
    $method = $_SERVER["REQUEST_METHOD"];

    function getEtudiant() {
        global $conn;
        $login = false;
        $etudiant = json_decode(file_get_contents("php://input"));
        $user = $etudiant->user;
        $pwd = $etudiant->pwd;
        $query = "SELECT * FROM etudiant WHERE user = '".$user."'"; 
        // echo $query;
        $result = mysqli_query($conn, $query);
        while($row = mysqli_fetch_array($result))
        {
            $etudiant = array();
            $etudiant['id'] = $row['id'];
            $etudiant['nom'] = $row['nom'];
            $etudiant['prenom'] = $row['prenom'];
            $etudiant['section'] = $row['section'];
            $hash = $row['pwd'];  
            if (password_verify($pwd, $hash)) {
                echo json_encode($etudiant);    
                header('Content-Type: application/json');
                $login = true;
                break;        
            }  
        }
        if (!$login) {
            $response  = array(
                'id' => 0,
                'message' => 'Étudiant non trouvé'
            );
            echo json_encode($response);
        }
    }

    switch($method) {
        case 'POST' :
            getEtudiant();
            break;

        default :
            // Méthode non autorisée
            header("HTTP/1.0 405 Method not allowed : ");
    }    
?>