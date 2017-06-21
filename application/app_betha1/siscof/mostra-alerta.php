<?php
if(!isset($_SESSION)) { 
    session_start(); 
}

// Mostra alerta dependendo do tipo
function mostraAlerta($tipo) {
    $actual_link = "http://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]"; 
	if(isset($_SESSION[$tipo])) : ?>
<div <?php if($actual_link === "http://localhost/siscof/index.php") echo "style='max-width: 350px; padding-top: 15px'"; else echo "class='mensagem'" ?> >
                <div class="alert alert-<?= $tipo ?> alert-dismissable fade in"><a href="index.php" class="close" data-dismiss="alert" aria-label="close">&times;</a><?= $_SESSION[$tipo];?></div>
            </div>
<?php
// exclui sessão do tipo
unset($_SESSION[$tipo]);
endif;
}

?>
