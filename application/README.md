# Aplicação

- Para acessar a página inicial da aplicação:
localhost/siscof/application/app_alpha1/index.php

# Pré-requisitos #

# Configurações iniciais #

Para habilitar mensagens e warnings de possíveis erros gerados pelo códio .php:
1) Alterar o php.ini. Edite com qualquer editor de texto como root o arquivo /etc/php5/apache2/php.ini. 
Procure pelas linhas display_erros e display_startup_errors. Ela estarão inicialmente setadas como abaixo:

display_errors = Off
display_startup_errors = Off

Troque os valores para:
display_errors = On
display_startup_errors = On

→ Após realizar os testes, antes do servidor entrar em produção,  preciso e altamente recomendável voltar a configuração para
padrão (OFF).

Depois de alterar o php.ini, reinicie o apache:

# /etc/init.d/apache2  stop
# /etc/init.d/apache2  start


