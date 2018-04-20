<?php 

namespace Mensageiro;

class Mensageiro{
	use Helpers\Listador;

	protected $username = "your_number"; // Número que envia
	protected $nickname = "your_nickname"; // Nome
	protected $password= "your_whatsapp_password="; // Senha whatsapp
	protected $debug = false;
	protected $whatsApi;
	protected $flasher;
	protected $listaContatos = array();

	public function __construct()
	{
		// Instancia a biblioteca WhastPort e conecta ao Whatsapp.
		$this->whatsApi = new \WhatsProt($this->username, $this->nickname, $this->debug);
		$this->whatsApi->connect(); // Conecta ao WhatsApp API
		$this->whatsApi->loginWithPassword($this->password); // Tenta logar
		$this->flasher = new Helpers\FlashMessages;
		unset($_SESSION['envios']);
	}

	public function enviarMensagem($numero, $mensagem, $lista = false)
	{
		$this->simularDigitacao($numero);
		$this->whatsApi->sendMessage($numero , $mensagem);
		$this->whatsApi->pollMessage();
		$_SESSION['envios']++;
	}

	public function enviarMensagemComImagem($imagem, $numero, $mensagem)
	{
		$this->simularDigitacao($numero);
		$this->whatsApi->sendMessageImage($numero, $imagem, false, 0 , "", $mensagem);
		$this->whatsApi->pollMessage();
		$_SESSION['envios']++;
	}

	public function dispararLista($arquivo, $mensagem)
	{
		$numeros = $this->prepararNumeros($arquivo);
		$this->listaContatos = $numeros;
		foreach ($numeros as $numero) {
			$this->enviarMensagem($numero, $mensagem);
		}
		$this->flasher->flash('Beleza!', 'A lista foi enviada com sucesso!', 'success', 'home');
	}

	public function dispararListaComImagem($imagem, $arquivo, $mensagem)
	{
		$numeros = $this->prepararNumeros($arquivo);
		$this->listaContatos = $numeros;
		foreach ($numeros as $numero) {
			$this->enviarMensagemComImagem($imagem, $numero, $mensagem);
		}
		$this->flasher->flash('Beleza!', 'A lista foi enviada com sucesso!', 'success', 'home');
	}

	public function simularDigitacao($numero)
	{
		$lista = array_filter($this->listaContatos);
		if (!empty($lista)) {
			$this->whatsApi->sendSync($this->listaContatos);
		}else{
			$this->whatsApi->sendSync(array($numero));
		}
		$this->whatsApi->sendPresenceSubscription($numero);
	    $this->whatsApi->sendMessageComposing($numero);
	    sleep(1);
	    $this->whatsApi->sendMessagePaused($numero);
	}
}

?>