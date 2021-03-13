<!doctype html>
<html lang="fr">
<head>
<meta charset="UTF-8" />
<link rel="stylesheet" href="Contenu/style.css" />
<title><?= $titre ?></title>
</head>
<body>
	<div id="global">
		<header>
			<a href="index.php"><h1 id="titreBlog">Convocations sportives</h1></a>
		</header>
        <div id="contenu">
            <?= $contenu ?>
        </div>
		<!-- #contenu -->
		<footer id="piedBlog"> Site de convocations sportives réalisé avec PHP, HTML5 et CSS. </footer>
	</div>
	<!-- #global -->
</body>
</html>