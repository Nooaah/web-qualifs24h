<?php
session_start();

// https://github.com/Nooaah/bloggy/blob/master/index.php

$bdd = new PDO("mysql:host=localhost;dbname=qualifs24h;charset=utf8", 'root', 'root');

$users = $bdd->prepare('SELECT * FROM test WHERE id != ?');
$users -> execute(array(0));

while ($u = $users->fetch()) {
    ?>
    <h6><?= $u['nom'] ?></h6>
    <?php
}

?>
<script>
    for (i = 0; i < document.querySelectorAll('h6').length; i++) {
        document.querySelectorAll('h6')[i].addEventListener('click', () => {
            var script = document.createElement('script');
            script.src = 'exempleJsCall.php';
            document.body.appendChild(script);
        })
    }
</script>
<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta http-equiv="x-ua-compatible" content="ie=edge">
    <title>Qualifications 24H des DUT Informatique</title>
    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.6.3/css/all.css">
    <!-- Bootstrap core CSS -->
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" rel="stylesheet">
    <!-- Material Design Bootstrap -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/mdbootstrap/4.8.8/css/mdb.min.css" rel="stylesheet">
    <!-- Your custom styles (optional) -->
    <link href="css/style.css" rel="stylesheet">
</head>

<body>
    <!-- DEBUT DU PROJET-->



    <!--Navbar-->
    <nav class="navbar navbar-expand-lg navbar-dark elegant-color">

        <!-- Navbar brand -->
        <a class="navbar-brand" href="#">Navbar</a>

        <!-- Collapse button -->
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#basicExampleNav" aria-controls="basicExampleNav" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>

        <!-- Collapsible content -->
        <div class="collapse navbar-collapse" id="basicExampleNav">

            <!-- Links -->
            <ul class="navbar-nav mr-auto">
                <li class="nav-item active">
                    <a class="nav-link" href="#">Home
                        <span class="sr-only">(current)</span>
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="#">Features</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="#">Pricing</a>
                </li>

                <!-- Dropdown -->
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" id="navbarDropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">Dropdown</a>
                    <div class="dropdown-menu dropdown-primary" aria-labelledby="navbarDropdownMenuLink">
                        <a class="dropdown-item" href="#">Action</a>
                        <a class="dropdown-item" href="#">Another action</a>
                        <a class="dropdown-item" href="#">Something else here</a>
                    </div>
                </li>

            </ul>
            <!-- Links -->

            <form class="form-inline">
                <div class="md-form my-0">
                    <input class="form-control mr-sm-2" type="text" placeholder="Search" aria-label="Search">
                </div>
            </form>
        </div>
        <!-- Collapsible content -->

    </nav>
    <!--/.Navbar-->

    <div class="alert alert-success" role="alert">
        Template Mdbootstrap avec tous les fichiers externalisés ! © Noah Chatelain
    </div>


    <div class="container mt-5">
        <div class="row">
            <div class="col-md-12 mb-5">
                <h1>Template indépendant Mdbootstrap</h1>
            </div>
        </div>
        <div class="row">
            <div class="col-md-4">
                Lorem ipsum dolor sit amet consectetur adipisicing elit. Consequuntur iusto in omnis
                voluptatem sunt repudiandae totam temporibus id accusantium vel eaque, adipisci autem saepe distinctio aliquam,
                nulla ipsa consectetur doloremque inventore sapiente! Excepturi labore dolor fugiat ducimus suscipit doloremque
                quia nobis aliquam esse possimus in, dignissimos provident inventore totam dicta?</div>
            <div class="col-md-4">
                Lorem ipsum dolor sit amet consectetur adipisicing elit. Laudantium consequuntur delectus
                possimus repudiandae tempora maiores nisi dignissimos officiis aut, totam cumque corporis dolorum eius commodi
                unde cupiditate tempore vero distinctio a minima soluta officia. Commodi ullam sequi quisquam perspiciatis.
                Repudiandae quis odio aliquam velit perspiciatis voluptatem laboriosam. Itaque, fugiat quaerat.</div>
            <div class="col-md-4">
                Lorem ipsum dolor sit amet consectetur adipisicing elit. Dolorum id cupiditate, repudiandae
                doloribus quod ratione? Fugit obcaecati incidunt eligendi quas. Maxime aspernatur asperiores praesentium iste
                voluptate impedit magni consectetur, explicabo quis suscipit delectus minus repellat possimus modi totam beatae
                doloribus a facilis? Quas culpa repellendus deserunt quod expedita nihil ex?</div>
        </div>
    </div>

    <!-- /FIN DU PROJET-->

    <!-- JQuery -->
    <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
    <!-- Bootstrap tooltips -->
    <script src='https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.1/popper.js'></script>
    <!-- Bootstrap core JavaScript -->
    <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.3.1/js/bootstrap.min.js"></script>
    <!-- MDB core JavaScript -->
    <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/mdbootstrap/4.8.8/js/mdb.js"></script>
    <!-- VueJS -->
    <!--
    <script src="https://cdnjs.cloudflare.com/ajax/libs/vue/2.6.10/vue.js"></script>
    -->
    <!-- SCRIPTS -->
    <script src="js/script.js"></script>
    <script src="js/app.js"></script>
</body>

</html>