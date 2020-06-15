<?php
$action="create";
if($_POST['action']=='create')
{
	$campos  = "name,description";
	$valores = "'$_POST[name]','$_POST[description]'";
	$alert=true;
	if(add("profiles",$campos,$valores,1)){
		$type="success";
		$message = "Registro guardado correctamente";
	}
	else{
		$type="danger";
		$message = "Error al guardar el registro";
	}
}

$itemEdit = array();
if($_GET['item'])
{
	//--------------------Query-------------------
	$action="update";
	$cols="*";
	$table="users";
	$where="id_usuario = ".$_GET["item"];
	$result=query($table,$cols,$where,false);
	if($result)
		$itemEdit=$result[0];
}

if($_POST['action']=='update')
{
	$cadena  = "nombre_completo='".$_POST["name"]."',usuario='".$_POST["user"]."'";
	$where   = "id_usuario = '".$_POST["id_elemento"]."'";
	$alert= true;
	if(update("users",$cadena,$where,0)){
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
      Administrador de Perfiles
      <small>usuarios</small>
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
	
 <!------------------------------------------------------- Panel 1 ------------------------------------------------------->
 <div class="box box-success">
   <div class="box-header with-border">
	 <h3 style="margin:5px !important">
       <i class="fa fa-external-link"></i>  Perfil
     </h3>
     <div class="box-tools pull-right">
       <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i></button>
       <button type="button" class="btn btn-box-tool" data-widget="remove"><i class="fa fa-remove"></i></button>
     </div>
   </div>
   <div class="box-body">
     <div class="row">
      <div class="panel-body">
		<form name="forma" method="post" action="" class="form-horizontal">
			<div class="form-group">
				<label class="col-lg-2 col-sm-2 control-label" for="asunto">Nombre</label>
				<div class="col-lg-8">
					<input type="text" required="required" id="name" name="name" value="<?=$itemEdit["name"]?>" class="form-control">
				</div>
			</div>

			<div class="form-group">
				<label class="col-lg-2 col-sm-2 control-label" for="asunto">Descripción</label>
				<div class="col-lg-8">
					<input type="text" required="required" id="description" name="description" value="<?=$itemEdit["description"]?>" class="form-control">
				</div>
			</div>

			<br>
			<div class="text-center">
				<input type="submit" class="btn btn-primary" value="Guardar" name="crear" onclick="asignarAccion('crear');" />
			</div>
			<br>
			
			<input type="hidden" id="action" name="action" value="<?=$action?>" /> 
			<input type="hidden" name="id_elemento" id="id_elemento" value="<?=$itemEdit["id_usuario"]?>">
			<!--Aqui se almacena el ID del elemento que se este modificando-->
		</form>
	   </div>
     </div>
   </div>
 </div>