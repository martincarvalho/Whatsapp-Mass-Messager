<script>
	$(function(){
		swal({   title: "<?php echo $_SESSION['titulo'] ?>",   text: "<?php echo $_SESSION['mensagem'] ?>",   type: "<?php echo $_SESSION['tipo'] ?>",   confirmButtonText: "Ok" });
	});
</script>
<?php unset($_SESSION['titulo']); ?>
<?php unset($_SESSION['mensagem']); ?>
<?php unset($_SESSION['tipo']); ?>
