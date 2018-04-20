<?php 

namespace Mensageiro\Helpers;

trait Listador{
	protected $arquivo;
	protected $mensageiro;
	protected $numeros = array();

	public function prepararNumeros($arquivoLista)
	{
		$file = fopen($arquivoLista, 'r');
		while (($line = fgetcsv($file)) !== FALSE) {
			$numero = $this->formataNumero($line[0]);
			if($numero){
				$this->numeros[] = $numero;
			}
		}
		fclose($file);		
		return $this->numeros;
	}

	public function formataNumero($numero)
	{
		// O número + DDD deve ter no mínimo 10 digitos
		if(strlen($numero) > 9){
			// Remove espacos em branco e caracteres
			$numero = preg_replace('/\D/', '', $numero);
			$numero = '55' . $numero;
			return $numero;
		}else{
			return false;
		}
	}

}

?>