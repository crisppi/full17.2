<?php
	// http://www.thiengo.com.br
	// Por: Vinícius Thiengo
	// Em: 17/11/2013
	// Versão: 1.0
	
	if(strcasecmp('formulario-ajax', $_POST['metodo']) == 0){
	
		$html = 'Nome: '.$_POST['nome'];
		$html .= "\n";
		$html .= 'Email: '.$_POST['email'];
		$html .= "\n\n Obrigado pelo cadastro.";
		
		echo $html;
	}
?>