<?php
session_start();
$error = 0; 
$db = mysqli_connect('localhost','root','','piscine');
if (!($db)){
    echo "erreur";   
}

if (isset($_POST['submit'])){
        // connexion à la base de données
    //recup donées 
    $nom = $_POST['nom'];
    $prenom = $_POST['prenom'];
    $email = $_POST['email'];
    $cin = $_POST['cin'];
    $date = $_POST['dateN'];
    $password1 = $_POST['password'];
    $password2 = $_POST['comfirm-password'];
    $query = "select count(*) from utilisateur where email ='".$email."' or CIN ='". $cin."'";
    $result = mysqli_query($db,$query);
    $tab = mysqli_fetch_row($result);
    if ($password1 != $password2) {
      echo "deux mots non conformes<br>";
      $error = 1;
}      
      if ($tab[0] == 1) {
        echo "CIN ou/et Email déja utilisé<br>";
        $error = 1;
      }
    }
/*echo $nom."<br>";
echo $prenom."<br>";
echo $date."<br>";
echo $cin."<br>";
echo $password1."<br>";*/
if ($error == 0) {
   $password1 = md5($password1);//encrypt the password before saving in the database
   $query = "INSERT INTO utilisateur(nom,prenom,date_naissance,CIN,email,passwd) 
           VALUES('".$nom."', '".$prenom."', '".$date."','".$cin."','".$email."','".$password1."')";
   mysqli_query($db, $query);
   $_SESSION['nom'] = $nom;
   $_SESSION['success'] = "vous êtes connecté";
   header('location: fichier_test.php');
}else{
   session_destroy();
   echo "<br>";
   ?><a href="inscri.html">revenir vers la page précédente.</a><?php
}

/*
session_start();
if(isset($_POST['username']) && isset($_POST['password']))
{
    // connexion à la base de données
    $db_username = 'root';
    $db_password = 'mot_de_passe_bdd';
    $db_name     = 'nom_bdd';
    $db_host     = 'localhost';
    $db = mysqli_connect($db_host, $db_username, $db_password,$db_name)
           or die('could not connect to database');
    
    // on applique les deux fonctions mysqli_real_escape_string et htmlspecialchars
    // pour éliminer toute attaque de type injection SQL et XSS
    $username = mysqli_real_escape_string($db,htmlspecialchars($_POST['username'])); 
    $password = mysqli_real_escape_string($db,htmlspecialchars($_POST['password']));
    
    if($username !== "" && $password !== "")
    {
        $requete = "SELECT count(*) FROM utilisateur where 
              nom_utilisateur = '".$username."' and mot_de_passe = '".$password."' ";
        $exec_requete = mysqli_query($db,$requete);
        $reponse      = mysqli_fetch_array($exec_requete);
        $count = $reponse['count(*)'];
        if($count!=0) // nom d'utilisateur et mot de passe correctes
        {
           $_SESSION['username'] = $username;
           header('Location: principale.php');
        }
        else
        {
           header('Location: login.php?erreur=1'); // utilisateur ou mot de passe incorrect
        }
    }
    else
    {
       header('Location: login.php?erreur=2'); // utilisateur ou mot de passe vide
    }
}
else
{
   header('Location: login.php');
}
mysqli_close($db); // fermer la connexion*/
?>
