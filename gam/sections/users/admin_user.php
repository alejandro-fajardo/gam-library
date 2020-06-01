<?php
$action="create";
if($_POST['action']=='create')
{
	$campos  = "name_trivia,date_ini,date_end";
	$valores = "'$_POST[nombre]','$_POST[date_ini]','$_POST[date_end]'";
	$alert=true;
	if(add("trivias",$campos,$valores,0)){
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
	$where   = "id_trivia = '".$_POST["idElemento"]."'";
	$alert= true;
	if(update("trivias",$cadena,$where,false)){
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
	$where   = "id_trivia = '".$_POST["idElemento"]."'";
	$alert= true;
	if(update("trivias",$cadena,$where,0)){
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
	$table="trivias";
	$where="id_trivia = ".$_GET["item"];
	$result=query($table,$cols,$where,false);
	if($result)
		$itemEdit=$result[0];
}

if($_POST['action']=='update')
{
	$cadena  = "name_trivia='".$_POST["nombre"]."',date_ini='".$_POST["date_ini"]."',date_end='".$_POST["date_end"]."'";
	$where   = "id_trivia = '".$_POST["id_elemento"]."'";
	$alert= true;
	if(update("trivias",$cadena,$where,0)){
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
      Administrador de Trivias
      <small>trivias</small>
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
       <i class="fa fa-external-link"></i>  Trivia
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
					<input type="text" required="required" id="nombre" name="nombre" value="<?=$itemEdit["name_trivia"]?>" class="form-control">
				</div>
			</div>

			<div class="form-group">
				<label class="col-lg-2 col-sm-2 control-label" for="asunto">Fecha inicio</label>	
				<div class="col-lg-3">
					<div class="input-group">
						<div class="input-group-addon">
						<i class="fa fa-calendar"></i>
						</div>
							<input type="text" id="date_ini" name="date_ini" class="form-control" value="<?=$itemEdit["date_ini"]?>" readonly="readonly" required="required">
					</div>				
				</div>
				<label class="col-lg-2 col-sm-2 control-label" for="asunto">Fecha Fin</label>
				<div class="col-lg-3">
					<div class="input-group">
						<div class="input-group-addon">
						<i class="fa fa-calendar"></i>
						</div>
							<input type="text" id="date_end" name="date_end" class="form-control" value="<?=$itemEdit["date_end"]?>" readonly="readonly" onkeypress="return false;" required="required">
					</div>				
				</div>
			</div>
			<script>
				$(document).ready(function() 
				{
					campoFecha("date_ini");
					campoFecha("date_end");
				});
			</script>
			<br>
			<div class="text-center">
				<input type="submit" class="btn btn-primary" value="Guardar" name="crear" onclick="asignarAccion('crear');" />
			</div>
			<br>
			
			<input type="hidden" id="action" name="action" value="<?=$action?>" /> 
			<input type="hidden" name="id_elemento" id="id_elemento" value="<?=$itemEdit["id_trivia"]?>">
			<!--Aqui se almacena el ID del elemento que se este modificando-->
		</form>
	   </div>
     </div>
   </div>
 </div>

<!---------------------------------------------------------------- LISTADO ----------------------------------------------------->
<?php
//--------------------Query-------------------
$id="id_trivia";
$cols="*";
$table="trivias";
$where="1 ORDER BY date_ini ASC";
$result=query($table,$cols,$where,false);
?>
<div class="box box-warning">
   <div class="box-header with-border">     
     <h3 style="margin:5px !important">
       <i class="fa fa-list"></i>  Trivias
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
				<td class="text-center"><b>Nombre</b></td>
				<td class="text-center"><b>Fecha inicio</b></td>
				<td class="text-center"><b>Fecha fin</b></td>
				<td class="text-center"><b>Administrar</b></td>
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
							<td class="text-center"><?=$res["name_trivia"]?></td>
							<td class="text-center"><?=$res["date_ini"]?></td>
							<td class="text-center"><?=$res["date_end"]?></td>
							<td class="text-center">
								<a class="adminT" href="sections/trivia/modal_trivias.php?id_trivia=<?=$res["id_trivia"]?>">
									<input type="button" value="Administrar" class="btn btn-info btn-xs"/> 
								</a>
							</td>
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
								<a href="?section=trivia&module=admin_trivia&item=<?=$res["id_trivia"]?>" >
									<input type="button" value="Editar" class="btn btn-primary btn-xs" />									
								</a>
								<?php
								if($res["estado"]==0)
								{
								?>
									<input type="button" name="activar" id="activar" value="Activar" class="btn btn-success btn-xs" onclick="asignarAccion1('activar',<?=$res['id_trivia']?>)"/> 
								<?php	
								}
								else
								{
								?>
									<input type="button" name="desactivar" id="desactivar" value="Desactivar" class="btn btn-danger btn-xs" onclick="asignarAccion1('desactivar',<?=$res['id_trivia']?>)" />
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