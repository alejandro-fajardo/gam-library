<?php
$action="create";
if($_POST['action']=='create'){

	$password = encrypt($_POST["password"]);
	$campos  = "libro_name,autor_name,editorial_name,genero_lib";
	$valores = "'$_POST[nombre_li]','$_POST[autor_li]','$_POST[editorial_li]','$_POST[gener_li]'";
	$alert=true;
	if(add("libros",$campos,$valores,false)){
		$type="success";
		$message = "Registro guardado correctamente";
	}
	else{
		$type="danger";
		$message = "Error al guardar el registro";
	}
}
if($_POST['accionEdit']=='desactivar')
{
	$cadena  = "estado=0";
	$where   = "libro_id = '".$_POST["idElemento"]."'";
	$alert= true;
	if(update("libros",$cadena,$where,false)){
		$type="success";
		$message = "Registro actualizado correctamente";
	}
	else{
		$type="danger";
		$message = "Error al guardar el registro";
	}
}
if($_POST['accionEdit']=='activar')
{	
	$cadena  = "estado=1";
	$where   = "libro_id = '".$_POST["idElemento"]."'";
	$alert= true;
	if(update("libros",$cadena,$where,0)){
		$type="success";
		$message = "Registro actualizado correctamente";
	}
	else{
		$type="danger";
		$message = "Error al guardar el registro";
	}
}
if($_POST['action']=='edit')
{
	$campos  = "name,date_ini,date_end";
	$valores = "'$_POST[name]','$_POST[date_ini]','$_POST[date_end]'";
	$alert=true;
	if(add("trivias",$campos,$valores,0)){
		$type="success";
		$message = "Registro guardado correctamente";
	}
	else{
		$type="danger";
		$message = "Error al guardar el registro";
	}
	$action="update";
}


$itemEdit = array();
if($_GET['item'])
{
	//--------------------Query-------------------
	$action="update";
	$cols="*";
	$table="libros";
	$where="libro_id = ".$_GET["item"];
	$result=query($table,$cols,$where,false);
	if($result)
		$itemEdit=$result[0];
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
$where="1 ORDER BY libro_name ASC";
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
								<a href="?section=libros&module=viewlibros&item=<?=$res["libro_id"]?>" >
                                <input type="button" name="activar" id="activar" value="Solicitar prestado" class="btn btn-success btn-xs" onclick="asignarAccion1('activar',<?=$res['libro_id']?>)"/> 
								</a>
																							
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
$id="libros_id";
$cols="*";
$table="libros";
$where="1 ORDER BY libro_name ASC";
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
	    <form name="forma1" method="post" action="">
	     <table id="generalDataTable" class="table table-bordered table-striped">
	       <thead>
	         <tr>
				<td class="text-center"><b>Genero Literario</b></td>
				<td class="text-center"><b>Nombre</b></td>
				<td class="text-center"><b>Autor</b></td>
				<td class="text-center"><b>Editorial</b></td>
				<td class="text-center"><b>Estado</b></td>
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

							<?php
							if($res["estado"]==0)
							{
							?>
								<td class="text-center"><font color="red">Inactivo</font></td>
							<?php
							}
							else
							{
							?>
								<td class="text-center"><font color="green">Activo</font></td>
							<?php	
							}
							?>
							<td class="text-center">
								<a href="?section=libros&module=viewlibros&item=<?=$res["libro_id"]?>" >
									<input type="button" value="Editar" class="btn btn-primary btn-xs" />									
								</a>
								<?php
								if($res["estado"]==0)
								{
								?>
									<input type="button" name="activar" id="activar" value="Activar" class="btn btn-success btn-xs" onclick="asignarAccion1('activar',<?=$res['libro_id']?>)"/> 
								<?php	
								}
								else
								{
								?>
									<input type="button" name="desactivar" id="desactivar" value="Desactivar" class="btn btn-danger btn-xs" onclick="asignarAccion1('desactivar',<?=$res['libro_id']?>)" />
								<?php	
								}
								?>																	
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
 
</div><!-- Contenedor general -->
<br>