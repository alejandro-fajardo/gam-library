<?php
/*
DROP TABLE IF EXISTS `libros`;
CREATE TABLE IF NOT EXISTS `libros` (
  `libro_id` int(11) NOT NULL AUTO_INCREMENT,
  `libro_name` varchar(250) NOT NULL DEFAULT '0',
  `autor_name` varchar(250) NOT NULL DEFAULT '0',
  `date_create` datetime NOT NULL DEFAULT '0',
  `editorial_name` varchar(250) NOT NULL DEFAULT '0',
  PRIMARY KEY (`libro_id`)
) ENGINE=InnoDB AUTO_INCREMENT=22 DEFAULT CHARSET=utf8;
*/


$tabla="libros";
$campos="libro_id, libro_name, autor_name, editorial_name";
$where="1 ORDER BY libro_name ASC";
$Objetc=query($tabla,$campos,$where,true);

?>
<h2> Libros </h2>
<!-- ADD LIBRO -->
<table id="generalDataTable" class="table table-bordered table-striped">
	       <thead>
	         <tr>
				<td class="text-center"><b>Libro</b></td>
				<td class="text-center"><b>Autor</b></td>
                <td class="text-center"><b>Editorial</b></td>
                <td class="text-center"><b>Accion</b></td>
			 </tr>
	       </thead>
	       <tbody>
		   <?php
			   if($Objetc)
			   {
					foreach ($Objetc as $Obj) {
					?>
						<tr>
							<td class="text-center"><?=$Obj["libro_name"]?></td>
							<td class="text-center"><?=$res["autor_name"]?></td>
                            <td class="text-center"><?=$Obj["editorial_name"]?></td>
                            <td class="text-center"> <a href="#">Actualizar </a> | <a href="#">Eliminar </a> </td>
						</tr>
					<?php
					}
			   }
		   ?>
	       </tbody>
	     </table>


