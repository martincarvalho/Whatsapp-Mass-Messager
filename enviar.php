<?php 

require_once 'app/config/config.php';
require __DIR__ . '/vendor/autoload.php';

$mensageiro = new Mensageiro\Mensageiro;
use Mensageiro\Helpers\FlashMessages;

function checkPostedImage(){
	if(!empty($_FILES['imagem']['tmp_name'])){
		return true;
	}
	return false;
}

// Função de upload
include 'partials/uploadImage.php';

if(isset($_POST['form_type']) || isset($_POST['mensagem'])){
	$form_type = $_POST['form_type'];
	$mensagem = $_POST['mensagem'];

	// MENSAGEM INDIVIDUAL
	if($form_type == 'individual' && isset($_POST['numero'])){
		$numero = $_POST['numero'];
		$numero = $mensageiro->formataNumero($numero);
		if($numero){
			if(checkPostedImage()) {
				$imagem = uploadImage($_FILES['imagem']);
				$mensageiro->enviarMensagemComImagem($imagem, $numero, $mensagem);
			}else{
				$mensageiro->enviarMensagem($numero, $mensagem);
			}
			FlashMessages::flash('Beleza!', 'Mensagem enviada com sucesso!', 'success', 'home');
		}else{
			FlashMessages::flash('Ops!', 'Por favor insira um número válido! Ex: (61)81819292', 'warning', 'home');
		}

	// MENSAGEM PARA LISTA
	}elseif ($form_type == 'lista') {
		// Carregar o arquivo CSV
		$extensao = pathinfo($_FILES["lista"]["name"],PATHINFO_EXTENSION);
		// Check file size
		if ($_FILES["lista"]["size"] > 500000) {
			FlashMessages::flash('Ops!', 'O arquivo é muito grande!', 'warning', 'home');
		}
		// Allow certain file formats
		if($extensao != "csv" ) {
			FlashMessages::flash('Ops!', 'Somente arquivos .csv são aceitos.', 'warning', 'home');
		} else {
			$arquivo = $_FILES["lista"]["tmp_name"];
			if(checkPostedImage()) {
				$imagem = uploadImage($_FILES['imagem']);
				$mensageiro->dispararListaComImagem($imagem, $arquivo, $mensagem);
			}else{
				$mensageiro->dispararLista($arquivo, $mensagem);
			}
		}
	}
}

?>