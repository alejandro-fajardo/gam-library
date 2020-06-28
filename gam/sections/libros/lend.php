<?php
$action="create";
if($_POST['accionEdit']=='desactivar')
{
	$cadena  = "status_lend=0";
	$where   = "libro_id = '".$_POST["idElemento"]."'";
	$alert= true;
	if(update("libros",$cadena,$where,false)){
		$id_user = $_SESSION["userLog"]["id_usuario"];
		$where = "id_user = '$id_user' AND id_book='$_POST[idElemento]'";
		if(delete("users_books",$where,false)){
			$type="success";
			$message = "Libro devuelto corrctamente";
		}
		else{
			$type="danger";
			$message = "Error al guardar el registro";
		}
	}
	else{
		$type="danger";
		$message = "Error al guardar el registro";
	}
}
if($_POST['accionEdit']=='activar')
{	
	$cadena  = "status_lend=1";
	$where   = "libro_id = '".$_POST["idElemento"]."'";
	$alert= true;
	if(update("libros",$cadena,$where,false)){
		$campos  = "id_book,id_user";
		$id_user = $_SESSION["userLog"]["id_usuario"];
		$valores = "'$_POST[idElemento]','$id_user'";
		if(add("users_books",$campos,$valores,false)){
			$type="success";
			$message = "Prestamos hecho correctamente";
		}
		else{
			$type="danger";
			$message = "Error al guardar el registro";
		}
	}
	else{
		$type="danger";
		$message = "Error al guardar el registro";
	}
}

if($_POST['action']=='update')
{
	$cadena  = "libro_name='".$_POST["nombre_li"]."',autor_name='".$_POST["autor_li"]."',editorial_name='".$_POST["editorial_li"]."',genero_lib='".$_POST["gener_li"]."'";
	$where   = "libro_id = '".$_POST["id_elemento"]."'";
	$alert= true;
	if(update("libros",$cadena,$where,false)){
		$type="success";
		$message = "Registro actualizado correctamente";
	}
	else{
		$type="danger";
		$message = "Error al guardar el registro";
	}
	$itemEdit = array();
}
?>

<!--------------------------------------------------------- SCRIPTS ---------------------------------------------------------------->
<script>
	function asignarAccion(action)
	{
		$("#accion").val(action);
	}
	function asignarAccion1(action,id)
	{
		$("#accionEdit").val(action);
		$("#idElemento").val(id);
		document.forma1.submit();
	}
	function filtro(filtro)
	{
		$("#filtro").val(filtro);
		document.forma1.submit();
	} 
	generarModal("adminT",90,700,0,false,"");
</script>

<!-------------------------------------------------------- FORMULARIO PRINCIPAL ---------------------------------------------------->
<!-- Titulo de cabecera -->
<br>
<section class="content-header">
    <h1>   
      Prestamos
    </h1>
    <ol class="breadcrumb">
      <li><a href=""><i class="fa fa-dashboard"></i>Inicio</a></li>
    </ol>
 </section>
<br>

<!------------ Contenedor general ----------------->
<div style="padding-left:2% !important; padding-right:2% !important"> 

<?php
if($alert)
{
?>
<script>	
	document.write(alerts('<?=$type?>','<?=$message?>'));		
</script>
<?php
}
?>

<!---------------------------------------------------------------- DIAPOBLENS ----------------------------------------------------->
<?php
//--------------------Query-------------------
$id="libros_id";
$cols="*";
$table="libros";
$where="1 AND status_lend= 0 AND estado = 1 ORDER BY libro_name ASC";
$result=query($table,$cols,$where,false);
?>
<div class="box box-warning">
   <div class="box-header with-border">     
     <h3 style="margin:5px !important">
       <i class="fa fa-list"></i>  Libros disponibles.
     </h3>
     <div class="box-tools pull-right">
       <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i></button>
       <button type="button" class="btn btn-box-tool" data-widget="remove"><i class="fa fa-remove"></i></button>
     </div>
   </div>
   <div class="box-body"> 
   <br><br> 
    <div style="overflow-x:scroll">
	    <form name="forma1" method="post" action="">
	     <table id="generalDataTable" class="table table-bordered table-striped">
	       <thead>
	         <tr>
				<td class="text-center"><b>Genero Literario</b></td>
				<td class="text-center"><b>Nombre</b></td>
				<td class="text-center"><b>Autor</b></td>
				<td class="text-center"><b>Editorial</b></td>
				<td class="text-center"><b>Acciones</b></td>
			 </tr>
	       </thead>
	       <tbody>
		   <?php
			   if($result)
			   {
					foreach ($result as $res) {
					?>
						<tr>
						    <td class="text-center"><?=$res["genero_lib"]?></td>
							<td class="text-center"><?=$res["libro_name"]?></td>
							<td class="text-center"><?=$res["autor_name"]?></td>
							<td class="text-center"><?=$res["editorial_name"]?></td>

						
							<td class="text-center">
                                <input type="button" name="activar" id="activar" value="Solicitar prestado" class="btn btn-success btn-xs" onclick="asignarAccion1('activar',<?=$res['libro_id']?>)"/> 
																		
							</td>
						</tr>
					<?php
					}
			   }
		   ?>
	       </tbody>
	     </table>
	     <input type="hidden" id="accionEdit" name="accionEdit" />
	     <input type="hidden" id="filtro" name="filtro" />
		 <input type="hidden" id="idElemento" name="idElemento" />
		</form><!-- Form -->
		<br>
	</div><!-- Scroll -->
   </div>
</div> <!-- Listado -->	

<!---------------------------------------------------------------- LISTADO ----------------------------------------------------->
<?php
//--------------------Query-------------------
$userid = $_SESSION["userLog"]["id_usuario"];
$id="libros_id";
$cols="*";
$table="libros RIGHT JOIN users_books ON id_book = libro_id";
$where="1 AND id_user = $userid ORDER BY libro_name ASC";
$result=query($table,$cols,$where,false);
?>
<div class="box box-warning">
   <div class="box-header with-border">     
     <h3 style="margin:5px !important">
       <i class="fa fa-list"></i>  Mis libros.
     </h3>
     <div class="box-tools pull-right">
       <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i></button>
       <button type="button" class="btn btn-box-tool" data-widget="remove"><i class="fa fa-remove"></i></button>
     </div>
   </div>
   <div class="box-body"> 
   <br><br> 
    <div style="overflow-x:scroll">
	    <form name="forma2" method="post" action="">
	     <table id="generalDataTable" class="table table-bordered table-striped">
	       <thead>
	         <tr>
				<td class="text-center"><b>Genero Literario</b></td>
				<td class="text-center"><b>Nombre</b></td>
				<td class="text-center"><b>Autor</b></td>
				<td class="text-center"><b>Editorial</b></td>
				<td class="text-center"><b>Acciones</b></td>
			 </tr>
	       </thead>
	       <tbody>
		   <?php
			   if($result)
			   {
					foreach ($result as $res) {
					?>
						<tr>
						    <td class="text-center"><?=$res["genero_lib"]?></td>
							<td class="text-center"><?=$res["libro_name"]?></td>
							<td class="text-center"><?=$res["autor_name"]?></td>
							<td class="text-center"><?=$res["editorial_name"]?></td>


							<td class="text-center">
								<input type="button" name="desactivar" id="desactivar" value="Devolver" class="btn btn-danger btn-xs" onclick="asignarAccion1('desactivar',<?=$res['libro_id']?>)" />																
							</td>
						</tr>
					<?php
					}
			   }
		   ?>
	       </tbody>
	     </table>
	     <input type="hidden" id="accionEdit2" name="accionEdit2" />
	     <input type="hidden" id="filtro2" name="filtro2" />
		 <input type="hidden" id="idElemento2" name="idElemento2" />
		</form><!-- Form -->
		<br>
	</div><!-- Scroll -->
   </div>
</div> <!-- Listado -->
 
</div><!-- Contenedor general -->
<br>