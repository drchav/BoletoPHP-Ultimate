<?
  $dadosboleto["charset"] = "UTF-8";

  //Sufixo existente no nome do arquivo do boleto do banco (após o caractere _)
  //Para o banco do brasil, o nome do arquivo é boleto_bb.php
  //logo, o sufixo é bb (sem a extensão)
	$sufixo_arquivo_boleto = "unibanco";
	$data_venc = date("d/m/Y"); //defina sua data de vencimento

  //APENAS PARA TESTE: GERA DATA DE VENCIMENTO ALEATÓRIA
  //$data_venc = date("d/m/Y", time() + (rand(1,30) * 86400));  // Prazo de X dias OU informe data: "13/04/2006"; 

	$valor_inscricao="65.0";

  //APENAS PARA TESTE: GERA VALOR ALEATÓRIO
  //$valor_inscricao=$cand->valor_inscricao($_REQUEST['cod_candidato']) + rand(1,1000);
	//**********************************************************************
	
	// DADOS DO BOLETO PARA O SEU CLIENTE--------------------------------------
	$taxa_boleto = 0; //custo adicional para geração do boleto
	// Valor - REGRA: Tanto faz símbolo da casa decimal com "." ou ","
	$valor_cobrado = $valor_inscricao; 
	$valor_cobrado = str_replace(",", ".",$valor_cobrado);
	$valor_boleto=number_format($valor_cobrado+$taxa_boleto, 2, ',', '');
	
	//número único para o boleto sendo gerado
	$dadosboleto["nosso_numero"] = "87654"; 
	// Num do pedido ou nosso numero
	$dadosboleto["numero_documento"] = 1; //número sequencial
	$dadosboleto["data_vencimento"] = $data_venc; // Data de Vencimento do Boleto
	$dadosboleto["data_documento"] = date("d/m/Y"); // Data de emissão do Boleto
	$dadosboleto["data_processamento"] = date("d/m/Y"); // Data de processamento do boleto (opcional)
	// Valor do Boleto, com vírgula, sempre com duas casas depois da virgula
	$dadosboleto["valor_boleto"] = $valor_boleto; 	
	
	// DADOS DO SEU CLIENTE----------------------------------------------------
	$dadosboleto["sacado"] = "MANOEL CAMPOS DA SILVA FILHO";
  $dadosboleto["cpf_cnpj_sacado"] = "111.111.111-11";
	$dadosboleto["endereco1"] = "CLN 405, BLOCO A, NÚMERO 220, PLANO DIRETOR SUL";
	$dadosboleto["endereco2"] = "BRASÍLIA-DF - 70.850-500";
	
	// INFORMACOES PARA O CLIENTE-----------------------------------------------
	$dadosboleto["demonstrativo1"] = "<strong>PAGAMENTO DE INSCRI&Ccedil;&Atilde;O NO VESTIBULAR</strong>"; 
	$dadosboleto["demonstrativo2"] = "SEU N&Uacute;MERO DE INSCRI&Ccedil;&Atilde;O É 1";
	$dadosboleto["demonstrativo3"] = "A inscri&ccedil;&atilde;o s&oacute; &eacute; confirmada ap&oacute;s o pagamento do boleto.";

	// INFORMACOES PARA O CAIXA-----------------------------------------------
	$dadosboleto["instrucoes1"] = "--------------------------------------";
	$dadosboleto["instrucoes2"] = "Não receber após o vencimento.";
  $dadosboleto["instrucoes3"] = "";
  $dadosboleto["instrucoes4"] = "";
	
	// DADOS OPCIONAIS DE ACORDO COM O BANCO OU CLIENTE-------------------------
	$dadosboleto["quantidade"] = ""; //só deve ser preechidos quando houver valor indexador (ex: URV, UFIR, etc.)
	$dadosboleto["valor_unitario"] = ""; //só deve ser preechidos quando houver valor indexador (ex: URV, UFIR, etc.)
  $dadosboleto["aceite"] = "N";	    // N - remeter cobrança sem aceite do sacado  (cobranças não-registradas)
                                    // S - remeter cobrança apos aceite do sacado (cobranças registradas)
	$dadosboleto["uso_banco"] = ""; 	
	$dadosboleto["especie"] = "R $";


// Espécie do Documento (Título)
/*
DM	Duplicata Mercantil
DMI	Duplicata Mercantil p/ Indicação
DS	Duplicata de Serviço
DSI	Duplicata de Serviço p/ Indicação
DR	Duplicata Rural
LC	Letra de Câmbio
NCC Nota de Crédito Comercial
NCE Nota de Crédito a Exportação
NCI Nota de Crédito Industrial
NCR Nota de Crédito Rural
NP	Nota Promissória
NPR	Nota Promissória Rural
TM	Triplicata Mercantil
TS	Triplicata de Serviço
NS	Nota de Seguro
RC	Recibo
FAT	Fatura
ND	Nota de Débito
AP	Apólice de Seguro
ME	Mensalidade Escolar
PC	Parcela de Consórcio
*/
	$dadosboleto["especie_doc"] = "DS";
	
	// ---------------------- DADOS FIXOS DE CONFIGURAÇÃO DO SEU BOLETO --------------- //
	
	// DADOS DA SUA CONTA - BANCO DO BRASIL
	$dadosboleto["agencia"] = "1867"; // Num da agencia, sem digito
  $dadosboleto["agencia_dv"] = "8"; 
	$dadosboleto["conta"] = "32720"; 	// Num da conta, sem digito
  $dadosboleto["conta_dv"] = "1";
	
	// DADOS PERSONALIZADOS DO BANCO SENDO UTILIZADO
	// Num do convênio no Banco do Brasil - REGRA: 6 ou 7 dígitos
	$dadosboleto["convenio"] = "1234567";  
	$dadosboleto["contrato"] = "123456"; // Num do seu contrato no banco
		
	/*
	#################################################
	DESENVOLVIDO PARA CARTEIRA 18
	
	- Carteira 18 com Convenio de 7 digitos
	  Nosso número: pode ser até 10 dígitos
	
	- Carteira 18 com Convenio de 6 digitos
	  Nosso número:
	  de 1 a 99999 para opção de até 5 dígitos
	  de 1 a 99999999999999999 para opção de até 17 dígitos
	
	#################################################
	*/
	
	// DADOS DE QUEM VAI RECEBER PELO BOLETO
  //Campo livre para inserir, por exemplo, o nome do sistema???????????
	$dadosboleto["identificacao"] = "Sistema de Inscri&ccedil;&otilde;es On-Line"; 
	$dadosboleto["cpf_cnpj"] = "11.111.111/0001-22";
	$dadosboleto["endereco"] = "210 RUA, AV LO 05 ESQUINA COM RUA SO 9, S/N"; 
	$dadosboleto["cidade_uf"] = "PALMAS-TO";
	$dadosboleto["cedente"] = "EMPRESA TESTE";

  //Chama o boleto para o banco indicado 
	require_once("boleto_$sufixo_arquivo_boleto.php");
?>

<script language="javascript" charset="utf-8">
  window.print();
</script>

