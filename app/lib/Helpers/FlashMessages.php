<?php 

namespace Mensageiro\Helpers;

class FlashMessages{

	public static function flash($titulo = '', $mensagem = '', $tipo = 'success', $redirect = '')
	{
		$_SESSION['tipo'] = $tipo;
		$_SESSION['titulo'] = $titulo;
		$_SESSION['mensagem'] = $mensagem;
		if($redirect == 'home'){
			header('Location: /index.php');
		}else if(!empty($redirect)){
			header('Location: ' . $redirect);
		}
	}
}

?>