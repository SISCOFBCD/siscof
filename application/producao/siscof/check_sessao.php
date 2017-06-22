<?php 
//cria uma sessao para segurança
if(!isset($_SESSION)) { 
	session_start();
}
if(!isset($_SESSION["siscof"])){
?>
<!DOCTYPE HTML>
<html lang="br" class="no-js">
<head>
<meta charset="utf-8">
<title>SISCOF</title>
<link href="style.css" rel="stylesheet" />
</head>
<body>
<div id="conteudo">
<h1>SISCOF</h1>
<div class="borda"></div>
<?php
echo "Você está sendo redirecionado para a área de login...";
echo "<meta http-equiv=\"refresh\" content=\"1;URL=".'index.php'."\">";
die();
?>
<div class="borda"></div>
</div>
</body>
</html>
<?php
}
?>

