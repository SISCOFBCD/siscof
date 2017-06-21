<?php

include ("./gerenciaAlertas.php");

    $AHid = $_GET["id"];
	
	if(desativarAlertaH($AHid) == null) {
		
		?>
		<div class="mensagem">
			<div class="alert alert-danger" role="alert">
				<center>
				<?php echo utf8_encode("Não foi possível desativar o Alerta."); ?>
				</center>
			</div>
		</div>
		<?php

		
	} else {
		
		?>
		<div class="mensagem">
			<div class="alert alert-success" role="alert">
				<center>
				<?php echo utf8_encode("Alerta desativado com sucesso!"); ?>
				</center>
			</div>
		</div>
		<?php
			
	}
	
	echo "<meta http-equiv=\"refresh\" content=\"3;URL=".'painel.php?pagina=alertas/listAlertasH'."\">";


?>