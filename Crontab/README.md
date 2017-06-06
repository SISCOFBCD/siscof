# Monitoramento Diário de Banco de Dados com Notificações#

Esta aplicação faz parte do sistema SISCOF, o qual serve de apoio à coordenadoria pedagógica do IFSC - Câmpus São José de forma a criar um controle de matrículas e frequência mais eficiente em relação ao existente e automatizar atividades de controle e verificação de dados na coordenadoria pedagógica.

As aplicações verificacaoFaltas.py e verificacaoHorario.py tem por objetivo, monitorar os bancos de dados do sistema informando ao usuário quando algum dos alertas cadastrados por ele ocorre. Por exemplo, o usuário do sistema pode cadastrar um alerta para monitorar um aluno que vêm faltando constantemente as aulas (utilizar a interface gŕafica para tal tarefa). As aplicações de verificação irão enviar um notificação (e-mail) no dia seguinte em que os parâmetros definidos forem atendidos. O e-mail é padrão, conforme exemplo abaixo:

![promisechains](https://bytebucket.org/luucasgoomes/siscof/raw/6c6487620d9259fa3cde19c9957cfdc0341af8c5/imagens/email.png?token=84aade3d33793d2b5ce84d036835b86e27e16e75)

# Pré-requisitos #

* Python 2.x em diante;
* Extensão cx_Oracle para python;
* Extensão mysql_connector;


# Configurações iniciais #

## Modificar arquivo configuracoes.cfg ##

O arquivo configuracoes.cfg define os valores para acesso aos bancos de dados (mysql e Oracle), bem como os valores para configuração do servidor SMPT (google).

```
[mysqlSection]
user = usuario_mysql
password = senha_mysql
host = servidor_mysql
database = banco_mysql

[smtpSection]
servidor = servidor_smtp
login = login_smtp
senha = senha_smtp
enviador = email_origem
mensagem = definir_mensagem

[oracleSection]
conexaoOracle1 = login/senha@servidor:porta/banco_dados
conexaoOracle2 = login/senha@servidor:porta/banco_dados
```

O arquivo já está configurado, porém qualquer modificação deve ser executada neste arquivo e não nas aplicações de verificação!

## Configurar crontab ##

O cron é um programa de agendamento de tarefas. Utilizando dos seus recursos é possível programar qualquer coisa a ser executada em uma periodicidade ou até mesmo em um exato dia, numa exata hora. 

Para o projeto em questão, queremos que os scripts verificacaoFaltas.py e verificacaoHorarios.py sejam execetudos às 3:00hs de terça-feira à sabado. A intenção de executá-los neste horário é impedir que o sistema da catraca esteja recebendo registros durante o periodo de verificação. Vale ressaltar que os programas de verificações são executados em relação ao dia anterior, por exemplo: na quarta-feira, será feita a verificação referente a terça-feira.

Para configurar o crontab com o agendamento desta tarefa é necessário editar o arquivo, /etc/crontab. Este arquivo só pode ser manipulado pelo root

```
sudo gedit /etc/crontab
```
Utilizamos o editor de texto gedit, utilize o da sua preferência.

O arquivo provavelmente terá alguns agendamentos pré-definidos, portanto será semelhante ao seguinte:

```
# /etc/crontab: system-wide crontab
# Unlike any other crontab you don't have to run the `crontab'
# command to install the new version when you edit this file
# and files in /etc/cron.d. These files also have username fields,
# that none of the other crontabs do.

SHELL=/bin/sh
PATH=/usr/local/sbin:/usr/local/bin:/sbin:/bin:/usr/sbin:/usr/bin

# m h dom mon dow user	command
17 *	* * *	root    cd / && run-parts --report /etc/cron.hourly
25 6	* * *	root	test -x /usr/sbin/anacron || ( cd / && run-parts --report /etc/cron.daily )
47 6	* * 7	root	test -x /usr/sbin/anacron || ( cd / && run-parts --report /etc/cron.weekly )
52 6	1 * *	root	test -x /usr/sbin/anacron || ( cd / && run-parts --report /etc/cron.monthly )
#
```

Podemos observar que o crontab tem o seguinte formato:

```
[minutos] [horas] [dias do mês] [mês] [dias da semana] [usuário] [comando]

```
O preenchimento de cada campo deve ser feito da seguinte maneira:

- Minutos: números de 0 a 59;
- Horas: números de 0 a 23;
- Dias do mês: números de 0 a 31;
- Mês: números de 1 a 12;
- Dias da semana: informe números de 0 a 7;
- Usuário: usuário que vai executar o comando;
- Comando: a tarefa que deve ser executada.

Desta maneira, para a configuração desejada, devemos incluir a seguinte instrução no arquivo:

``` 
* * * * * * *
```