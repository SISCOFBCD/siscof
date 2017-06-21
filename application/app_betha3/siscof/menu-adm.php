 <!-- /. NAV TOP  -->
 <!-- A variavel $sessao[0] serve para verificar qual página esta o usuário para mudar a cor do menu -->
    <nav class="navbar-side menu-fixo" role="navigation">
            <div class="sidebar-collapse">
                <ul class="nav" id="main-menu">
                    <li>
						<!-- Foto de perfil do usuário -->
						<img src="assets/img/find_user.png" class="user-image img-responsive"/>
                    </li>                     
                    <li>
                        <a href="painel.php" <?php if($_GET["pagina"] === "inicio") echo "class='active-menu'"; ?>><i class="fa fa-home fa-2x"></i> Home</a>
                    </li>
                    	
					<!-- alertas -->
                    <li>                        
                        <a href="#" id="alertas" <?php if($secao[0] === "alertas") echo "class='active-menu'"; ?>><i class="fa fa-exclamation-triangle fa-2x"></i> Alertas <span class="fa arrow"></span></a>
                        <ul class="nav nav-second-level">
						
							<li>
                                <a href="#" >Criar Novo<span class="fa arrow"></span></a>
                                <ul class="nav nav-third-level">
                                    <li>
										<a href="?pagina=alertas/formCadastraAlertaF">Alerta de Faltas<i class="fa fa-plus-circle icon-direita"></i></a>
									</li>
							
									<li>
										<a href="?pagina=alertas/formCadastraAlertaH">Alerta de Horário<i class="fa fa-plus-circle icon-direita"></i></a>
									</li>
                                </ul>
                            </li>
							
							
							<li>
                                <a href="#" >Listar Alertas<span class="fa arrow"></span></a>
                                <ul class="nav nav-third-level">
                                    <li>
										<a href="?pagina=alertas/listAlertasF&cat=3">Por Faltas <i class="fa fa-list icon-direita"></i></a>
									</li>
									
									<li>
										<a href="?pagina=alertas/listAlertasH&cat=3">Por Horário <i class="fa fa-list icon-direita"></i></a>
									</li>

									
									<!--
									<li>
										<a href="?pagina=alertas/listAlertasFConcluidos">Concluídos Por Faltas <i class="fa fa-list icon-direita"></i></a>
									</li>
									
									<li>
										<a href="?pagina=alertas/listAlertasFAbertos">Em Aberto Por Faltas <i class="fa fa-list icon-direita"></i></a>
									</li>
									
									<li>
										<a href="?pagina=alertas/listAlertasHConcluidos">Concluídos Por Horário <i class="fa fa-list icon-direita"></i></a>
									</li>
									
									<li>
										<a href="?pagina=alertas/listAlertasHAbertos">Em Aberto Por Horário <i class="fa fa-list icon-direita"></i></a>
									</li> -->
									
                                </ul>
                            </li>
							
                         </ul>
                    </li>  
                    <!--fim alertas-->				
					
                    <!-- usuários -->
                        <li>
                            <a href="#" <?php if($secao[0] === "usuarios") echo "class='active-menu'"; ?> id="usuarios"><i class="fa fa-users fa-2x"></i>Usuários<span class="fa arrow"></span></a>  
                            <ul class="nav nav-second-level">
                                <li>
                                    <a href="?pagina=usuarios/listaUser">Listar <i class="fa fa-list icon-direita"></i></a>
                                </li> 
                                <li>
									<a href="?pagina=usuarios/cadastraUser">Adicionar <i class="fa fa-plus-circle icon-direita"></i></a>
                                    
                                </li>                                                           
                            </ul>
                        </li>
					<!--fim usuários--> 
					
                  </ul>                   
            </div>            
        </nav>     
        <!-- /. NAV SIDE  -->