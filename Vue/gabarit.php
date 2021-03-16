<!doctype html>
<html lang="fr">
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta2/dist/css/bootstrap.min.css"
          rel="stylesheet">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.9.0/css/all.css">
    <title><?= $titre ?></title>
</head>
<body>
    <nav class="navbar navbar-expand-lg navbar-dark" style="background-color: #001D6E">
        <div class="container">
            <a class="navbar-brand" href="index.php"><i class="fas fa-chalkboard-teacher"></i>&nbsp;&nbsp;Site de Convocations Sportives </a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav">
                    <li class="nav-item px-1">
                        <a class="nav-link active" aria-current="page" href="index.php?action=menuCompte"><i class="fa fa-home"></i>&nbsp;&nbsp;Accueil</a>
                    </li>
                    <li class="nav-item px-1">
                        <a class="nav-link" href="index.php?action=match"><i class="fa fa-handshake"></i>&nbsp;&nbsp;Matchs</a>
                    </li>
                    <li class="nav-item px-1">
                        <a class="nav-link" href="index.php?action=convocation"><i class="fa fa-clipboard-list"></i>&nbsp;&nbsp;Convocations</a>
                    </li>
                    <li class="nav-item px-1">
                        <a class="nav-link" href="index.php?action=absence"><i class="fas fa-id-card-alt"></i>&nbsp;&nbsp;Absences</a>
                    </li>

                </ul>
            </div>
            <div class="navbar-nav ms-lg-auto mx-sm-5">
                <a href="#" class="nav-item nav-link" onmouseenter="changeIcon(this,false)" onmouseleave="changeIcon(this,true)"><i class="fa fa-lock"></i>&nbsp;&nbsp;Se connecter</a>
            </div>
        </div>
    </nav>

    <div class="container">
        <?= $contenu ?>
    </div>
    <!-- #contenu -->
    <footer> Site de gestion de convocations sportives réalisé avec PHP, HTML5 et CSS. </footer>
<!-- #global -->

<script>
    function changeIcon(e,iconLock) {
        let lock = e.firstChild.classList;
        if(iconLock)
            lock.replace("fa-unlock","fa-lock");
        else lock.replace("fa-lock","fa-unlock");
    }
</script>
</body>
</html>