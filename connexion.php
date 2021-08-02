
<?php
  include_once('db/connexiondb.php');
  //print_r($_POST);
  if(!empty($_POST)){
      extract($_POST);
      $valid = (boolean) true;

      if(isset($_POST['inscription'])){
          //echo'ok';
          $pseudo = (String) trim($pseudo);
          $mail = (String) trim($mail);
          $password = (String) trim($password);
          $jour = (int) trim($jour);
          $mois = (int) trim($mois);
          $annee = (int) trim($annee);
          $departement = (int) trim($departement);
          $date_naissance = (String) null;
          $date_connexion = (String) null;
           
          if(empty($pseudo)){
              $valid = false;
              $err_pseudo = "Veuillez renseingner ce champs !";
          }
          if(empty($mail)){
              $valid = false;
              $err_mail = "Veuillez renseingner ce champs !";
          }
          if(empty($password)){
              $valid = false;
              $err_password = "Veuillez renseingner ce champs !";
          }
          $verif_jour = array(1 , 2 , 3);

          if(!in_array($jour , $verif_jour)){
              $valid = false;
              $err_jour = "Veuillez renseingner ce champs !";

          }

          $verif_mois = array(7 , 8, 9);

          if(!in_array($mois , $verif_mois)){
              $valid = false;
              $err_mois = "Veuillez renseingner ce champs !";

          }

          $verif_annee = array(1997 , 1998 , 1999);

          if(!in_array($annee , $verif_annee)){
              $valid = false;
              $err_annne = "Veuillez renseingner ce champs!";

          }

          if(!checkdate($mois , $jour , $annee)){
              $valid = false;
              $err_date = "date fausse";
          }else{
              $date_naissance = $annee .'-' . $mois .'-' . $jour;

          }

          $verif_departement = array(1 , 2 , 3);

          if(!in_array($departement , $verif_departement)){
              $valid = false;
              $err_departement = "Veuillez renseingner ce champs !";

          }


          if($valid){
              $date_inscription = date("Y-m-d");
              $req = $BDD->prepare("INSERT INTO utilisateur(pseudo, mail , password, date_naissance, departement ,date_inscription, date_connexion)
              VALUES(?,?,?,?,?,?,?)"); 
              
              $req->execute(array($pseudo, $mail , $password, $date_naissance, $departement ,$date_inscription, $date_inscription));

          }





      }
  }
?>
<!doctype html>

<html lang="fr">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
    <link rel="stylesheet" href="style.css">


    <title>Acceuil</title>
  </head>
  <body> 
    <?php
        require_once('menu.php');  
    ?>
    
    <h1>Inscription</h1>
    <form method="post" >
        <section>
            <div>
                <?php
                  if(isset($err_pseudo)){
                      echo $err_pseudo;
                  }
                ?>
                <input type="text" name="pseudo" placeholder="Pseudo">
            </div>
            <div>
                <input type="text" name="mail" placeholder="Mail">
            </div>
            <div>
                <input type="password" name="password" placeholder="Password">
            </div>
            <div>
                <select name="jour">
                    <option value="1">1</option>
                    <option value="2">2</option>
                    <option value="3">3</option>
                </select>
                <select name="mois">
                    <option value="7">7</option>
                    <option value="8">8</option>
                    <option value="9">9</option>
                </select>
                <select name="annee">
                    <option value="1997">1997</option>
                    <option value="1998">1998</option>
                    <option value="1999">1998</option>
                </select>
             </div>
             <div>
                <select name="departement">
                    <option value="1">1</option>
                    <option value="2">2</option>
                    <option value="3">3</option>
                </select>
             </div>

        </section>
        <input type="submit" name="inscription" value="S'inscrire">
        
    </form>

    <!-- Optional JavaScript -->
    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>

  </body>
</html>