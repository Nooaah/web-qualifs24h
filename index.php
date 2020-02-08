<?php
session_start();
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

// https://github.com/Nooaah/bloggy/blob/master/index.php

$bdd = new PDO("mysql:host=localhost;dbname=qualifs24h;charset=utf8", 'root', 'root');

?>
<!DOCTYPE html>
<html lang="fr">

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <meta http-equiv="x-ua-compatible" content="ie=edge">
  <title>Material Design Bootstrap</title>
  <!-- Font Awesome -->
  <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.11.2/css/all.css">
  <!-- Bootstrap core CSS -->
  <link href="css/bootstrap.min.css" rel="stylesheet">
  <!-- Material Design Bootstrap -->
  <link href="css/mdb.min.css" rel="stylesheet">
  <!-- Your custom styles (optional) -->
  <link href="css/style.min.css" rel="stylesheet">
  <style>
    /*
    tr:hover {
      cursor: pointer;
    }
    */
  </style>
  <script src='https://cdnjs.cloudflare.com/ajax/libs/jquery/3.4.1/jquery.min.js'></script>
  <script src="js/script.js"></script>
</head>

<body class="grey lighten-3">

  <!--Main Navigation-->
  <header>

    <!-- Navbar -->
    <nav class="navbar fixed-top navbar-expand-lg navbar-light white scrolling-navbar">
      <div class="container-fluid">

        <!-- Brand -->
        <a class="navbar-brand waves-effect" href="https://mdbootstrap.com/docs/jquery/" target="_blank">
          <strong class="blue-text"></strong>
        </a>

        <!-- Collapse -->
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent"
          aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
          <span class="navbar-toggler-icon"></span>
        </button>

        <!-- Links -->
        <div class="collapse navbar-collapse" id="navbarSupportedContent">

          <!-- Left -->
          <ul class="navbar-nav mr-auto">
            <li class="nav-item active">
              <a class="nav-link waves-effect" data-toggle="modal" data-target="#modalLoginForm" href="#">Ajouter un TIE Fighter
                <span class="sr-only">(current)</span>
              </a>
            </li>
            <!--

            <li class="nav-item">
              <a class="nav-link waves-effect" href="https://mdbootstrap.com/docs/jquery/" target="_blank">Noah</a>
            </li>
          -->
          </ul>

          <!-- Right 
          <ul class="navbar-nav nav-flex-icons">
            <li class="nav-item">
              <a href="https://www.facebook.com/mdbootstrap" class="nav-link waves-effect" target="_blank">
                <i class="fab fa-facebook-f"></i>
              </a>
            </li>
            <li class="nav-item">
              <a href="https://twitter.com/MDBootstrap" class="nav-link waves-effect" target="_blank">
                <i class="fab fa-twitter"></i>
              </a>
            </li>
            <li class="nav-item">
              <a target="_blank" href="https://www.noah-chatelain.fr/"
                class="nav-link border border-light rounded waves-effect" target="_blank">
                <i class="fas fa-external-link-alt mr-2"></i>Noah
              </a>
            </li>
          </ul>
          -->
        </div>

      </div>
    </nav>
    <!-- Navbar -->

    <!-- Sidebar -->
    <div class="sidebar-fixed position-fixed">

      <a class="logo-wrapper waves-effect">
        <img src="https://i.pinimg.com/originals/19/b4/6c/19b46c150c545d88925c8e1856b786bf.png" class="img-fluid" alt="">
      </a>

      <div class="list-group list-group-flush">
        <a href="#" class="list-group-item list-group-item-action waves-effect">
          <i class="fas fa-space-shuttle mr-3"></i>Réservations
        </a>
      </div>

    </div>
    <!-- Sidebar -->

  </header>
  <!--Main Navigation-->

  <!--Main layout-->
  <main class="pt-5 mx-lg-5">
    <div class="container-fluid mt-5">

      <div class="container">
        <div class="row">
          <div class="col-md-12">

          <?php
            $tiefighters = $bdd->prepare('SELECT * FROM tiefighters WHERE id != ? ORDER BY numero');
            $tiefighters->execute(array(0));

            $nbResa = $bdd->prepare('SELECT * FROM reservations WHERE id != ?');
            $nbResa->execute(array(0));
            $nbResa = $nbResa->rowcount();
          ?>

          <h4 class="mt-3">Réservations des TIE-Fighters</h4>
          <h6 class="mb-5 mt-3">
            <?php
                if ($nbResa == 0) {
                    echo "Aucune réservation en cours";
                } else if ($nbResa == 1) {
                    echo $nbResa . " réservation en cours";
                } else {
                    echo $nbResa . " réservations en cours";
                }
            ?>
          </h6>
            
            <table class="table table-striped text-center mb-5">
            <thead>
                <tr>
                    <th scope="col">Numéro TIE Fighter</th>
                    <th scope="col">Réservé par</th>
                    <th scope="col">Heure de la réservation</th>
                    <th scope="col" class="text-left">Action</th>
                </tr>
            </thead>
            <tbody>
                <?php while($tf = $tiefighters->fetch()) 
                {
                ?>
                    <tr>
                        <td class="align-middle"><b><?= $tf['numero'] ?></b></td>
                        <?php
                            $etat = $bdd->prepare('SELECT * FROM reservations WHERE id_tiefighter = ?');
                            $etat->execute(array($tf['id']));
                            $nbReservation = $etat->rowcount();
                            if ($nbReservation == 1) {
                                $etat = $etat->fetch();
                                $stormtrooper = $bdd->prepare('SELECT * FROM stormtroopers WHERE id = ?');
                                $stormtrooper->execute(array($etat['id_stormtrooper']));
                                $st = $stormtrooper->fetch();
                                $nom = $st['nom'];
                                $prenom = $st['prenom'];
                                ?>
                                    <td class="align-middle">
                                        <?= $prenom . " " . $nom ?>
                                    </td>
                                    <td class="align-middle">
                                        <?= $etat['date'] . " " . ($etat['heure'] + 1) . ":" ?>
                                        <?php
                                            if ($tf['minute'] < 10) {
                                                echo "0" . $tf['minute'];
                                            } else {
                                                echo $tf['minute'];
                                            }
                                            //$date = date($etat['date']);
                                            //echo date('Y-m-d H:i:s', strtotime($date));
                                        ?>
                                    </td>

                                    <td class="align-middle text-left">
                                        <button type="button" class="btn btn-success p-2 vehiculeRendu" data-id="<?= $tf['id'] ?>" data-toggle="modal" data-target="#vehiculeRendu">Véhicule rendu</button>
                                        <button type="button" class="btn btn-danger p-2 vehiculeSupprimer" data-toggle="modal" data-target="#vehiculeSupprimer">Véhicule détruit</button>
                                        <script>
                                            for (i = 0; i < document.getElementsByClassName('vehiculeSupprimer').length ; i++) {
                                                document.getElementsByClassName('vehiculeSupprimer')[i].addEventListener('click', function() {
                                                    document.getElementById('vehiculeSupprimerText').innerHTML = "Supprimer ce véhicule détruit : <b><?= $tf['numero'] ?></b> ?";
                                                    document.getElementById('vehiculeSupprimerButton').dataset.id = <?= $tf['id'] ?>;
                                                });
                                            }
                                        </script>
                                        <script>
                                            for (i = 0; i < document.getElementsByClassName('vehiculeRendu').length ; i++) {
                                                document.getElementsByClassName('vehiculeRendu')[i].addEventListener('click', function() {
                                                    document.getElementById('vehiculeRenduText').innerHTML = "Le Stormtrooper <b><?= $st['prenom'] ?> <?= $st['nom'] ?></b> à t'il bien ramené ce TIE-Fighter <b><?= $tf['numero'] ?></b>";
                                                    document.getElementById('vehiculeRenduButton').dataset.id = <?= $tf['id'] ?>;
                                                });
                                            }
                                        </script>
                                    </td>
                                <?php
                            } else {
                                ?>
                                    <td class="align-middle">
                                        Aucune réservation
                                    </td>
                                    <td class="align-middle">
                                        Rendu le <?= $tf['date'] . " " . $tf['heure'] . ":" ?>
                                        <?php
                                        if ($tf['minute'] < 10) {
                                            echo "0" . $tf['minute'];
                                        } else {
                                            echo $tf['minute'];
                                        }
                                            //$date = date($tf['date']);
                                            //echo date('Y-m-d H:i:s', strtotime($date));
                                        ?>
                                    </td>
                                    <td class="align-middle text-left">

                                        <div class="row">
                                            <div class="col-md-4 align-middle">

                                                <!-- Material input -->
                                                <div class="md-form">
                                                    <input type="text" id="matricule" data-id="<?= $tf['id'] ?>" class="form-control align-middle">
                                                    <label for="matricule">N° Stormtrooper</label>
                                                </div>
                                            </div>
                                            <div class="col-md-4 align-middle">
                                                <button type="button" class="btn btn-success p-2 vehiculeDonner" data-toggle="modal" data-target="#vehiculeDonner">Donner ce véhicule</button>
                                            </div>
                                            <div class="col-md-4 align-middle">
                                                <button type="button" class="btn btn-danger p-2 vehiculeSupprimer pt-3 pb-3" data-toggle="modal" data-target="#vehiculeSupprimer">Véhicule détruit</button>
                                                <script>
                                                    for (i = 0; i < document.getElementsByClassName('vehiculeSupprimer').length ; i++) {
                                                        document.getElementsByClassName('vehiculeSupprimer')[i].addEventListener('click', function() {
                                                            document.getElementById('vehiculeSupprimerText').innerHTML = "Supprimer ce véhicule détruit : <b><?= $tf['numero'] ?></b> ?";
                                                            document.getElementById('vehiculeSupprimerButton').dataset.id = <?= $tf['id'] ?>;
                                                        });
                                                    }
                                                </script>
                                            </div>
                                            <script>

                                                document.getElementsByClassName('vehiculeDonner')[document.getElementsByClassName('vehiculeDonner').length - 1].addEventListener('click', function() {
                                                    document.getElementById('vehiculeDonnerButton').dataset.id = <?= $tf['id'] ?>;
                                                    document.getElementById('vehiculeDonnerButton').dataset.idstormtrooper = document.querySelector('input[data-id="<?= $tf['id'] ?>"]').value;
                                                    
                                                    document.getElementById('vehiculeDonnerText').innerHTML = "Réserver ce véhicule <b><?= $tf['numero'] ?></b> pour le Stormtrooper <b>" + document.getElementById('vehiculeDonnerButton').dataset.idstormtrooper + '</b>';
                                                    
                                                });
                                            
                                        </script>
                                        </div>



                                    </td>
                                <?php
                            }
                        ?>
                        
                    </tr>
                <?php 
            } 
            ?>
            </tbody>
            </table>



          </div>
        </div>
      </div>

    </div>

  </main>
  <!--Main layout-->

  <div class="modal fade" id="modalLoginForm" tabindex="-1" role="dialog" aria-labelledby="myModalLabel"
  aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header text-center">
        <h4 class="modal-title w-100 font-weight-bold">Ajouter un TIE Fighter</h4>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body mx-3">
        <div class="md-form mb-5">
          <i class="fas fa-space-shuttle prefix grey-text"></i>
          <input id="nameTIE" type="text" id="defaultForm-email" class="form-control validate">
          <label class="pl-1" data-error="Non !" data-success="Joli ! 😱" for="defaultForm-email">Nom</label>
        </div>

      </div>
      <div class="modal-footer d-flex justify-content-center">
        <button id="buttonAddTIE" class="btn btn-default">Ajouter</button>
      </div>
    </div>
  </div>
</div>

<script>
    document.getElementById('nameTIE').addEventListener('keyup', function() {
        document.getElementById('buttonAddTIE').textContent = "AJOUTER " + document.getElementById('nameTIE').value;
    })
    document.getElementById('buttonAddTIE').addEventListener('click', function() {
        var script = document.createElement('script');
        script.src = 'addTieFighter.php?nom=' + document.getElementById('nameTIE').value;
        document.body.appendChild(script);
    })
</script>


  <!-- Modal -->
<div class="modal fade" id="vehiculeSupprimer" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
  aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Véhicule détruit</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div id="vehiculeSupprimerText" class="modal-body">
        
      </div>
      <div class="modal-footer">
        <button type="button" id="vehiculeSupprimerButton" class="btn btn-primary" data-id="0" data-dismiss="modal">Oui</button>
        <button type="button" class="btn btn-danger" data-dismiss="modal">Non</button>
      </div>
    </div>
  </div>
</div>

<!-- Modal -->
<div class="modal fade" id="vehiculeDonner" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
  aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Réserver ce véhicule</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div id="vehiculeDonnerText" class="modal-body">
        
      </div>
      <div class="modal-footer">
        <button type="button" id="vehiculeDonnerButton" class="btn btn-primary" data-id="0" data-idStormtrooper="0" data-dismiss="modal">Oui</button>
        <button type="button" class="btn btn-danger" data-dismiss="modal">Non</button>
      </div>
    </div>
  </div>
</div>


<!-- Modal -->
<div class="modal fade" id="vehiculeRendu" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
  aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Rendre le véhicule</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div id="vehiculeRenduText" class="modal-body">
        
      </div>
      <div class="modal-footer">
        <button type="button" id="vehiculeRenduButton" class="btn btn-primary" data-id="0" data-dismiss="modal">Oui</button>
        <button type="button" class="btn btn-danger" data-dismiss="modal">Non</button>
      </div>
    </div>
  </div>
</div>




  <!--Footer -->
  <footer class="page-footer text-center font-small elegant-color darken-2 mt-4">

    <div class="pt-4">


    </div>

    <div class="footer-copyright py-3">
      © <script>
        document.write(new Date().getFullYear())
      </script> Copyright :
      <a href="https://www.noah-chatelain.fr/" target="_blank"> HAPPI - 24h </a>
    </div>

  </footer>


  <!-- SCRIPTS -->
  <!-- JQuery -->
  <script type="text/javascript" src="js/jquery-3.4.1.min.js"></script>
  <!-- Bootstrap tooltips -->
  <script type="text/javascript" src="js/popper.min.js"></script>
  <!-- Bootstrap core JavaScript -->
  <script type="text/javascript" src="js/bootstrap.min.js"></script>
  <!-- MDB core JavaScript -->
  <script type="text/javascript" src="js/mdb.min.js"></script>
  <!-- Initializations -->
  <script type="text/javascript">
    // Animations initialization
    new WOW().init();
  </script>

</body>

</html>