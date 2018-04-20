<?php
function uploadImage($imagem){
	$target_dir = "uploads/";
	$target_file = $target_dir . basename($imagem["name"]);
	$uploadOk = 1;
	$imageFileType = pathinfo($target_file,PATHINFO_EXTENSION);
// Check if image file is a actual image or fake image
	if(isset($_POST["submit"])) {
		$check = getimagesize($imagem["tmp_name"]);
		if($check !== false) {
			$uploadOk = 1;
		} else {
			$flash_message = "Arquivo não é uma imagem.".
			$uploadOk = 0;
		}
	}
// Check file size
	if ($imagem["size"] > 500000) {
		$flash_message = "Arquivo é muito grande.".
		$uploadOk = 0;
	}
// Allow certain file formats
	if($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg"
		&& $imageFileType != "gif" ) {
		$flash_message = "Formatos suportados: jpg, png, gif.".
	$uploadOk = 0;
}
// Check if $uploadOk is set to 0 by an error
if ($uploadOk == 0) {
	FlashMessages::flash('Ops!', $flash_message, 'warning', 'home');
// if everything is ok, try to upload file
} else {
	if (move_uploaded_file($imagem["tmp_name"], $target_file)) {
		return $target_file;
	}else{
		FlashMessages::flash('Ops!', 'Não foi possível fazer o upload da imagem.', 'warning', 'home');			
	}
}
}
?>