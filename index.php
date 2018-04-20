<?php 
  require_once 'app/config/config.php';
  require __DIR__ . '/vendor/autoload.php';

  if(!empty($_SESSION['envios'])){
    echo $_SESSION['envios'];
  }
?>
<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->
	<title>Mensageiro Whatsapp</title>

	<!-- Latest compiled and minified CSS -->
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/css/bootstrap.min.css">
	<link rel="stylesheet" type="text/css" href="node_modules/sweetalert/dist/sweetalert.css">

	<!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
	<!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
      <script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
      <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
      <![endif]-->
      <META NAME="ROBOTS" CONTENT="NOINDEX, NOFOLLOW">
  </head>
  <body>
  	<div class="container">
  		<div class="header clearfix">
  			<h3 class="text-muted">Mensageiro Whatsapp</h3>
  		</div>
  		<div class="jumbotron">
  			<h1 class="text-center">Envio em massa por <strong>Whatsapp</strong></h1>
  			<div class="panel panel-primary">
  			<div class="panel-heading"><h4>Enviar mensagem individual</h4></div>
  				<div class="panel-body">
  					<form class="form-horizontal" method="POST" action="enviar.php" enctype="multipart/form-data">
  						<input type="hidden" name="form_type" value="individual">
  						<div class="form-group">
  						<label for="numero" class="col-sm-2 control-label">Número</label>
  							<div class="col-sm-10">
  								<input name="numero" type="text" class="form-control"  placeholder="(61)99887766" required>
  							</div>
  						</div>
              <div class="form-group">
                <label for="imagem" class="col-sm-2 control-label">Imagem <small>* Opcional</small></label>
                <div class="col-sm-10">
                  <input name="imagem" type="file" class="form-control">
                </div>
              </div>
  						<div class="form-group">
  							<label for="mensagem" class="col-sm-2 control-label">Mensagem</label>
  							<div class="col-sm-10">
  								<textarea name="mensagem" class="form-control" rows="3" placeholder="Mensagem"></textarea>
  							</div>
  						</div>
  						<div class="form-group">
  							<div class="col-sm-offset-2 col-sm-10">
  								<button type="submit" class="btn btn-primary">Enviar!</button>
  							</div>
  						</div>
  					</form>
  				</div>
  			</div>
  			<div class="panel panel-primary">
  			<div class="panel-heading"><h4>Enviar uma mensagem para uma lista</h4></div>
  				<div class="panel-body">
  					<form class="form-horizontal" method="POST" action="enviar.php" enctype="multipart/form-data">
  						<input type="hidden" name="form_type" value="lista">
  						<div class="form-group">
  						<label for="lista" class="col-sm-2 control-label">Arquivo <small>* Formato .csv</small></label>
  							<div class="col-sm-10">
  								<input name="lista" type="file" class="form-control" required>
  							</div>
  						</div>
              <div class="form-group">
                <label for="imagem" class="col-sm-2 control-label">Imagem <small>* Opcional</small></label>
                <div class="col-sm-10">
                  <input name="imagem" type="file" class="form-control">
                </div>
              </div>
  						<div class="form-group">
  							<label for="mensagem" class="col-sm-2 control-label">Mensagem</label>
  							<div class="col-sm-10">
  								<textarea name="mensagem" class="form-control" rows="3" placeholder="Mensagem"></textarea>
  							</div>
  						</div>
  						<div class="form-group">
  							<div class="col-sm-offset-2 col-sm-10">
  								<button type="submit" class="btn btn-primary">Enviar!</button>
  							</div>
  						</div>
  					</form>
  				</div>
  			</div>
  		</div>

  		<footer class="footer">
  			<p>&copy; Mensageiro 2015</p>
        <p><a href="http://www.martincarvalho.com" target="_blank">Martin Carvalho</a></p>
  		</footer>

  	</div> <!-- /container -->

  	<!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
  	<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
  	<!-- Latest compiled and minified JavaScript -->
  	<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/js/bootstrap.min.js"></script>
	<script src="node_modules/sweetalert/dist/sweetalert.min.js"></script> 

  <?php 
    if(!empty($_SESSION['mensagem'])){
      include 'partials/flash.php';
    }
   ?>
  </body>
  </html>