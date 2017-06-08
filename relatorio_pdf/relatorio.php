<?php

require('fpdf/fpdf.php');
require_once('banco.php');
require_once('oracle.php');

class Relatorio{

protected $pdf;

function monta_pdf(){

	$this->pdf = new FPDF ();
	$this->pdf->AliasNbPages('{np}');
	$this->pdf->SetMargins(10,20,10);
	$this->pdf->AddPage();
	$this->pdf->SetFont('Arial','',12);
	$this->pdf->Ln(50);
	return;
}

/**************************************RELATÓRIOS DE FALTAS*******************************************/
function relatorio_aluno_falta($filtro,$ocorrencia){

	$this->monta_pdf();
	$this->pdf->Image("logo_faltas.png", 5, 10, 200,40);
	$this->pdf->SetTitle("Relatório individual de faltas",1);

	$query = "SELECT R.matricula,DATE_FORMAT(R.data, '%d/%m/%Y') AS data FROM Registro_Faltas R INNER JOIN Ocorrencia_Faltas O ON R.RFid = O.RFid AND O.OFid <= $ocorrencia AND R.AFid = $filtro";
	$resposta = busca_query($query);

	foreach($resposta as $row){
		$matricula = $row['matricula'];
	}

	$nome = $this->nome($matricula);
	
	$this->pdf->MultiCell(0,0,iconv('utf-8','iso-8859-1',"O(A) aluno(a) $nome, de matrícula $matricula, não compareceu"),0,"C",0);
	$this->pdf->Ln(10);
	$this->pdf->Cell(0,0," nos seguintes dias:",0,1,"");
	$this->pdf->Ln(10);
	$this->pdf->Cell(60, 10, "", 0, 0,"C");
	$this->pdf->Cell(80,10,"DATA",1,1,"C");


	foreach($resposta as $row){
		$this->pdf->Cell(60, 10, "", 0, 0,"C");
		$this->pdf->Cell(80,10,$row['data'],1,1,"C");
	}

	$this->pdf->Close();
	return $this->pdf;

}

function relatorio_turma_falta($filtro,$ocorrencia){

	$this->monta_pdf();
	$this->pdf->Image("logo_faltas.png", 5, 10, 200,40);
	$this->pdf->SetTitle("Relatório de falta por turma",1);

	$query = "SELECT AF.turma, AF.curso FROM Alertas_Faltas AF INNER JOIN (Registro_Faltas R INNER JOIN Ocorrencia_Faltas O ON R.RFid = O.RFid AND O.OFid = $ocorrencia) ON AF.AFid = R.AFid";
	$resposta = busca_query($query);

	foreach($resposta as $row){
		$turma = $row['turma'];
		$curso = $row['curso'];
	}

	$this->pdf->MultiCell(0,0,iconv('utf-8','iso-8859-1',"Os alunos do curso de $curso, turma $turma, não compareceram nos seguintes dias:"),0,"C",0);
	$this->pdf->Ln(10);
	$this->pdf->Cell(10, 10, "", 0, 0,"C");
	$this->pdf->Cell(40,10,iconv('utf-8','iso-8859-1',"MATRÍCULA"),1,0,"C"); 
	$this->pdf->Cell(90,10,"NOME",1,0,"C"); 
	$this->pdf->Cell(40,10,"DATA",1,1,"C"); 

	$query = "SELECT R.matricula,DATE_FORMAT(R.data, '%d/%m/%Y') AS data FROM Registro_Faltas R INNER JOIN Ocorrencia_Faltas O ON R.RFid = O.RFid AND O.OFid <= $ocorrencia AND R.AFid = $filtro";
	$resposta = busca_query($query);

	foreach($resposta as $row){
		$nome=$this->nome($row['matricula']);
		$this->pdf->Cell(10, 10, "", 0, 0,"C");
		$this->pdf->Cell(40,10,$row['matricula'],1,0,"C");
		$this->pdf->Cell(90,10,$nome,1,0,"C"); 
		$this->pdf->Cell(40,10,$row['data'],1,1,"C");
	}
	
	$this->pdf->Close();
	return $this->pdf;

}

/**************************************RELATÓRIOS DE HORÁRIOS*******************************************/

function relatorio_aluno_horario($filtro,$ocorrencia){

	$this->monta_pdf();
	$this->pdf->Image("logo_horarios.png", 5, 10, 200,40);
	$this->pdf->SetTitle("Relatório individual de horário",1);

	$query = "SELECT R.matricula, TIME_FORMAT(R.data, '%H:%m:%s') AS hora, DATE_FORMAT(R.data, '%d/%m/%Y') AS data FROM Registro_Horario R INNER JOIN Ocorrencia_Horario O ON R.RHid = O.RHid AND O.OHid <= $ocorrencia AND R.AHid = $filtro";
	$resposta = busca_query($query);

	foreach($resposta as $row){
		$matricula = $row['matricula'];
	}

	$nome = $this->nome($matricula);

	if($this->entrada($ocorrencia) == 1){
		$this->pdf->MultiCell(0,0,iconv('utf-8','iso-8859-1',"O(a) aluno $nome, matrícula $matricula chegou atrasado"),0,"C",0);
	} else {
		$this->pdf->MultiCell(0,0,iconv('utf-8','iso-8859-1',"O(a) aluno $nome, matrícula $matricula saiu cedo"),0,"C",0);
	}

	$this->pdf->Ln(10);
	$this->pdf->Cell(0,0," nos seguintes dias:",0,1,"");
	$this->pdf->Ln(10);
	$this->pdf->Cell(15, 10, "", 0, 0,"C");
	$this->pdf->Cell(80,10,"DATA",1,0,"C"); //DATA
	$this->pdf->Cell(80,10,"HORA",1,1,"C"); //HORA

	$resposta = busca_query($query);

	foreach($resposta as $row){
		$this->pdf->Cell(15, 10, "", 0, 0,"C");
		$this->pdf->Cell(80,10,$row['data'],1,0,"C");
		$this->pdf->Cell(80,10,$row['hora'],1,1,"C");
	}

	$this->pdf->Close();
	return $this->pdf;

}


function relatorio_turma_horario($filtro,$ocorrencia){

	$this->monta_pdf();
	$this->pdf->Image("logo_horarios.png", 5, 10, 200,40);
	$this->pdf->SetTitle("Relatório de horário por turma",1);

	$query = "SELECT AH.turma, AH.curso FROM Alertas_Horarios AH INNER JOIN (Registro_Horario R INNER JOIN Ocorrencia_Horario O ON R.RHid = O.RHid AND O.OHid = $ocorrencia) ON AH.AHid = R.AHid";
	$resposta = busca_query($query);

	foreach($resposta as $row){
		$turma = $row['turma'];
		$curso =  $row['curso'];
	}

	if($this->entrada($ocorrencia) == 1){
		$this->pdf->MultiCell(0,0,"Os alunos do curso de $curso, turma $turma, chegaram atrasados nos seguintes dias:",0,"C",0);
	} else {
		$this->pdf->MultiCell(0,0,iconv('utf-8','iso-8859-1',"Os alunos do curso de $curso, turma $turma, saíram cedo nos seguintes dias:"),0,"C",0);
	}

	$this->pdf->Ln(10);
	$this->pdf->Cell(10, 10, "", 0, 0,"C");
	$this->pdf->Cell(30,10,iconv('utf-8','iso-8859-1',"MATRÍCULA"),1,0,"C");
	$this->pdf->Cell(90,10,"NOME",1,0,"C"); 
	$this->pdf->Cell(25,10,"DATA",1,0,"C"); 
	$this->pdf->Cell(25,10,"HORA",1,1,"C");

	$query = "SELECT R.matricula,TIME_FORMAT(R.data, '%H:%m:%s') AS hora, DATE_FORMAT(R.data, '%d/%m/%Y') AS data FROM Registro_Horario R INNER JOIN Ocorrencia_Horario O ON R.RHid = O.RHid AND O.OHid <= $ocorrencia AND R.AHid=$filtro";
	$resposta = busca_query($query);

	foreach($resposta as $row){
		$nome=$this->nome($row['matricula']);
		$this->pdf->Cell(10, 10, "", 0, 0,"C");
		$this->pdf->Cell(30,10,$row['matricula'],1,0,"C");
		$this->pdf->Cell(90,10,$nome,1,0,"C"); 
		$this->pdf->Cell(25,10,$row['data'],1,0,"C");
		$this->pdf->Cell(25,10,$row['hora'],1,1,"C");
	}

	$this->pdf->Close();
	return $this->pdf;
	
}

/************************************ FUNÇÕES AUXILIARES *****************************************/

function nome($matricula){
	
	$query_nome = "SELECT NM_PESSOA FROM Alunos WHERE  NR_MATRICULA = $matricula";

	$resp_o = busca_query_o($query_nome);

	foreach($resp_o as $row){
		$nome = $row['NM_PESSOA'];
	}
	return $nome;
}

function entrada($ocorrencia){

	$query = "SELECT AH.chegada FROM Alertas_Horarios AH INNER JOIN (Registro_Horario R INNER JOIN Ocorrencia_Horario O ON R.RHid = O.RHid AND O.OHid = $ocorrencia) ON AH.AHid = R.AHid";
	
	$resposta = busca_query($query);
		
	foreach($resposta as $row){
		$chegada = $row['chegada'];
	}
		
	return $chegada;

}

}

?>
