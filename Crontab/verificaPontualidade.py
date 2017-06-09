#!/usr/bin/python
#coding: utf-8

__author__ = "BCD"
__date__ = "02/06/2017"

import cx_Oracle
import smtplib
import mysql.connector
import subprocess
import os
import ConfigParser
import time
import sys

from datetime import datetime,timedelta

from email.mime.text import MIMEText


def abre_mysql():
    cnx = mysql.connector.connect(
        user = config.get('mysqlSection', 'user'),
        password = config.get('mysqlSection', 'password'),
        host = config.get('mysqlSection', 'host'),
        database = config.get('mysqlSection', 'database')
    )
    cr = cnx.cursor()
    return (cr,cnx)

def fecha_mysql(cr, cnx):
    cr.close()
    cnx.close()

def abre_oracle():
	con = cx_Oracle.connect(config.get('oracle1Section', 'conexaoOracle1'))
	cur = con.cursor()
	return (con,cur)

def abre_oracle_acad():
	con_acad = cx_Oracle.connect(config.get('oracle2Section', 'conexaoOracle2'))
	cur_acad = con_acad.cursor()
	return (con_acad,cur_acad)

def fecha_oracle(cur,con):
	cur.close()	
	con.close()

def fecha_oracle_acad(cur_acad,con_acad):
	cur_acad.close()	
	con_acad.close()
	
def envia_email(destino):
	sender = config.get('smtpSection', 'enviador')
	receivers =	[destino]
	message = config.get('smtpSection', 'mensagem')
	smtpObj = smtplib.SMTP(config.get('smtpSection','servidor'), 25)
	smtpObj.ehlo()
	smtpObj.starttls()
	smtpObj.login(config.get('smtpSection','login'), config.get('smtpSection','senha'))
	smtpObj.sendmail(sender, receivers, message)         
	print "E-mail enviado"

def verifica_turma(turma,consecutivo,qtd_dias,upid,result):
	query = "SELECT NR_MATRICULA FROM ALUNOS WHERE ID_TURMA ="+str(turma)
	cur_acad.execute(query)
	alunos_turma = cur_acad.fetchall()
	qtd_alunos = len(alunos_turma)
	print qtd_alunos
	a=0
	while a < qtd_alunos:
		print alunos_turma[a][0]
		verifica_matricula(alunos_turma[a][0],consecutivo,qtd_dias,upid,result)
		a=a+1
	
def verifica_matricula(matricula,consecutivo,qtd_dias,UPid,AHid,chegada,limiar_tempo):

	query = "SELECT ID FROM IFSC.USUARIO WHERE MATRICULA="+str(matricula)
	cur.execute(query)
	idusuario = cur.fetchone()
	
	print idusuario
	if idusuario is not None:
		
		#VERIFICAR SITUACAO????
		query = "SELECT CD_TURNO FROM ALUNOS WHERE NR_MATRICULA ="+str(matricula)
		cur_acad.execute(query)
		turno = cur_acad.fetchone()
		print turno

		
		if turno[0] == 'M':
			print "Matutino"
			if chegada == 1:
				codorigem = 2
				print "Verificar chegada tardia"
				horaBase = 7
				print horaBase
			else:
				print "Verificar saida antecipada"
				horaBase = 11
				codorigem = 1
				print horaBase

		elif turno[0] == 'V':
			print "Vespertino"
			if chegada == 1:
				print "Verificar chegada tardia"
				horaBase = 13
				codorigem = 2
				print horaBase
			else:
				print "Verificar saida antecipada"
				horaBase = 17
				codorigem = 1
				print horaBase
		elif turno[0] == 'N':
			print "Noturno"
			if chegada == 1:
				codorigem = 2
				print "Verificar chegada tardia"
				horaBase = 18
				print horaBase
			else:
				print "Verificar saida antecipada"
				horaBase = 22
				codorigem = 1
				print horaBase
		else:
			print "Sem registro de TURNO"


		#query = "SELECT ID FROM IFSC.EVENTO WHERE trunc(DATAHORA)="+str(ontem)+" AND IDUSUARIO="+str(idusuario[0])
		### ALTERAR PRA ONTEM
		if chegada==1:	
			query="SELECT MIN(DATAHORA) FROM IFSC.EVENTO WHERE trunc(DATAHORA)=to_date("+str(ontem_outro)+",'YYYY-MM-DD') AND CODAREAORIGEM="+str(codorigem)+" AND IDUSUARIO="+str(idusuario[0])
		else:
			query="SELECT MAX(DATAHORA) FROM IFSC.EVENTO WHERE trunc(DATAHORA)=to_date("+str(ontem_outro)+",'YYYY-MM-DD') AND CODAREAORIGEM="+str(codorigem)+" AND IDUSUARIO="+str(idusuario[0])

		cur.execute(query)
		result3 = cur.fetchall()
		tamanho_resultado3 = len(result3)
		print "_---------------------"
		print idusuario[0]
		print " -------------------" 
		if result3[0][0] is not None:
			horaBase_formatado = datetime(result3[0][0].year,result3[0][0].month, result3[0][0].day, horaBase, 30)
			print horaBase_formatado
			print result3[0][0]
			diferenca =  (result3[0][0]-horaBase_formatado).seconds
			limiar_calculado = diferenca // 60
			print limiar_calculado

			if chegada == 1:
				if limiar_calculado > 0:
					if limiar_calculado > limiar_tempo:
						print "Atrasado extourou limiar"
						query = "INSERT INTO Registro_Horario VALUES (0,"+str(matricula)+","+str(ontem)+","+str(AHid[i][0])+")"
						cr.execute(query)
						cnx.commit()
						print "Inserido nos registros de horarios"

					else:
						print "Atrasado NÃO extourou limiar"
				else:
					print "Não está atrasado"
			else:
				if limiar_calculado < 0:
					limiar_calculado = limiar_calculado*(-1)
					if limiar_calculado > limiar_tempo:
						print "Saiu mais cedo extourou limiar"
						print "Atrasado extourou limiar"
						query = "INSERT INTO Registro_Horario VALUES (0,"+str(matricula)+","+str(ontem)+","+str(AHid[i][0])+")"
						cr.execute(query)
						cnx.commit()
						print "Inserido nos registros de horarios"


					else: 
						print "Saiu mais cedo NÃO extourou limiar"
				else: 
					print "Não saiu cedo"
			
			
			# Inserir no registro de faltas
			
			# Verificar se o numero de faltas atingiu o limite, pegar o ID do Registro de faltas
			#query="SELECT RFid from Registro_Faltas WHERE AHid="+str(result[i][0])
			query="SELECT RHid from Registro_Horario WHERE AHid="+str(AHid[i][0])+" AND matricula="+str(matricula)+" AND RHid NOT IN (select RHid from Ocorrencia_Horario)"
			cr.execute(query)
			rhid = cr.fetchall()
			contador = len(rhid)
			print contador
		
			if consecutivo == 0:
				if contador < qtd_dias:
					print "Limite não atingido"
				else:
					print "Limite Atingido"
					print rhid	
					#Enviar email e inserir na lista de ocorrencias
					query = "SELECT email FROM Usuarios_Permitidos WHERE ativo=1 and UPid ="+str(upid)
					cr.execute(query)
					destino = cr.fetchone() 
					envia_email(destino[0])
					x=0
					query = "SELECT MAX(OHid) FROM Ocorrencia_Horario"
					cr.execute(query)
					destino = cr.fetchone() 
					print destino
					if destino[0] == None:
						destino=0
					else:
						destino = destino[0]+1 
					while x < contador:
						query = "INSERT INTO Ocorrencia_Horario VALUES ("+str(destino)+","+str(ontem)+","+str(rhid[x][0])+")"
						print query					
						cr.execute(query)
						cnx.commit()
						x=x+1						
			else:
				print "CONSECUTIVO"

				query = "SELECT date_format(data, '%d-%m-%Y') FROM Registro_Horario WHERE matricula="+str(matricula)+" AND RHid NOT IN (select RHid from Ocorrencia_Horario)"
				cr.execute(query)
				datas = cr.fetchall()
				date_format = "%d-%m-%Y"

				query = "SELECT RHid FROM Registro_Horario WHERE matricula="+str(matricula)+" AND RHid NOT IN (select RHid from Ocorrencia_Horario)"
				cr.execute(query)
				rhid_oc = cr.fetchall()

				if contador < qtd_dias:
					print "Limite não atingido"
				else:
					print "Limite Atingido"
					loop_index = 0
					rhid_ocorrencia = []
					valores = []

					while loop_index+1 < contador:
						data1 = datetime.strptime(datas[loop_index][0], date_format)
						data2 = datetime.strptime(datas[loop_index+1][0], date_format)
						
						if ((data2-data1).days == 1):					
							print "consecutivo"
							print rhid_oc[loop_index][0]
							valores.append(rhid_oc[loop_index][0])
							rhid_ocorrencia.append(data1)
							print len(rhid_ocorrencia)
							if(len(rhid_ocorrencia)==qtd_dias-1):
								rhid_ocorrencia.append(data2)
								valores.append(rhid_oc[loop_index+1][0])
								print rhid_oc[loop_index+1][0]
				
								print rhid_ocorrencia
								print "Inserir nas OCORRENCIAS todos estes valores"
								#Enviar email e inserir na lista de ocorrencias
								query = "SELECT email FROM Usuarios_Permitidos WHERE ativo=1 and UPid ="+str(upid)
								cr.execute(query)
								destino = cr.fetchone() 
								envia_email(destino[0])
								c=0
								query = "SELECT MAX(OHid) FROM Ocorrencia_Horario"
								cr.execute(query)
								destino = cr.fetchone() 
								print destino
								if destino[0] == None:
									destino=0
								else:
									destino = destino[0]+1 
								while c < qtd_dias:
									print valores
									query = "INSERT INTO Ocorrencia_Horario VALUES ("+str(destino)+","+str(ontem)+","+str(valores[c])+")"
									print query					
									cr.execute(query)
									cnx.commit()
									c=c+1	
								break
						else:
							print "nao é consecutivo"
							print data2
							print data1
							del rhid_ocorrencia[:]
							del valores[:]
						loop_index=loop_index+1
					
					
		else:
			print "Aluno faltou"
	else:
		print "Matricula inexistente"






config = ConfigParser.RawConfigParser()
config.read('configuracoes.cfg')

query = "SELECT AHid FROM Alertas_Horarios WHERE NOW() < dataFim"
(cr,cnx) = abre_mysql()
cr.execute(query)
result = cr.fetchall()
tamanho = len(result)

(con,cur) = abre_oracle()
(con_acad,cur_acad) = abre_oracle_acad()

hoje = time.strftime('%Y-%m-%d')
print hoje
ontem = datetime.now() - timedelta(days=1)
ontem = ontem.strftime('\'%Y-%m-%d 00:00:01\'')
ontem_outro = datetime.now() - timedelta(days=1)
ontem_outro = ontem_outro.strftime('\'%Y-%m-%d\'')
print ontem
i=0
while i < tamanho:

	query = "SELECT dias_consecutivos,quantidade_dias, matricula, turma, curso, UPid, chegada, limiar_tempo from Alertas_Horarios WHERE AHid=" +str(result[i][0]) 
	cr.execute(query)
	result2 = cr.fetchone()
	consecutivo = result2[0]
	qtd_dias = result2[1]
	matricula = result2[2]
	turma = result2[3]
	curso = result2[4]
	upid = result2[5]
	chegada = result2[6]
	limiar_tempo = result2[7]



	if matricula is not None:		
		verifica_matricula(matricula,consecutivo,qtd_dias,upid,result,chegada,limiar_tempo)

	elif turma is not None:
		verifica_turma(turma,consecutivo,qtd_dias,upid,result)

	elif curso is not None:
		query = "SELECT DISTINCT ID_TURMA FROM ALUNOS WHERE ID_TURMA LIKE '"+str(curso)+"%'" 
		cur_acad.execute(query)
		turmas_curso = cur_acad.fetchall()
		print turmas_curso
		qtd_turmas = len(turmas_curso)
		print qtd_turmas
		b=0
		while b < qtd_turmas:
			print turmas_curso[b][0]
			verifica_turma(turmas_curso[b][0],consecutivo,qtd_dias,upid,result)
			b=b+1

	else:
		print "Matricula, turma e curso estao nulos"	
	
	i = i+1
	
fecha_mysql(cr,cnx)
fecha_oracle(cur,con)
fecha_oracle_acad(cur_acad,con_acad)







