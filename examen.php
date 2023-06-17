<!DOCTYPE html>
<html>
<head>
    <title>Examen</title>
    <link rel="stylesheet" href="estylo.css"/>
</head>
<body>
    <h1> TABLA PARA INGRESAR PRODUCTOS</h1>
    <?php 

   //conexion a base de datos primer paso a ejecutar.
   $pdo_option[PDO::ATTR_ERRMODE]=PDO::ERRMODE_EXCEPTION;
   $conexion = new PDO("mysql:host=localhost;dbname=Final_NUMERO_CARNET", "root", "", $pdo_option);

   //condiciones para Guardar y actualizar datos

   if( isset ($_POST["accion"])){
    if ($_POST["accion"] == "Crear"){
        $insert = $conexion->prepare("INSERT INTO Producto (Codigo,Nombre,Precio,Existencia)VALUES
        (:Codigo, :Nombre, :Precio, :Existencia)") ;
        $insert->bindValue('Codigo', $_POST['Codigo']);
        $insert->bindValue('Nombre', $_POST['Nombre']);
        $insert->bindValue('Precio', $_POST['Precio']);
        $insert->bindValue('Existencia', $_POST['Existencia']);
        $insert->execute();
       }
     }

    //Ejecutamos la consulta segundo paso a realizar
   $select = $conexion->query("SELECT Codigo,Nombre,Precio,Existencia FROM Producto");
    ?>

 <?php if (isset($_POST["accion"]) && $_POST["accion"] == "Editar") { ?>

    <?php } else { ?>
    <form method="POST" class= "Form">
        <input type="text" name="Codigo" placeholder="Ingrese el Codigo">
        <input type="text" name="Nombre" placeholder="Ingrese Nombre">
        <input type="text" name="Precio" placeholder="Ingrese Precio">
        <input type="text" name="Existencia" placeholder="Ingrese Existencia">
            <input type="hidden" name="accion" value="Crear">
            <button type="submit">Crear</button>
    </form>
    <?php } ?>
 
 <table border "1" id="tabla">
    <thead>
        <tr>
            <th>CODIGO</th>
            <th>NOMBRE</th>
            <th>PRECIO</th>
            <th>EXISTENCIA</th>
        </tr>
    </thead>
    <tbody>
    <?php foreach($select->fetchAll() as $alumno) { ?>
        <tr>
            <td> <?php echo $alumno["Codigo"] ?> </td>
            <td> <?php echo $alumno["Nombre"] ?> </td>
            <td> <?php echo $alumno["Precio"] ?> </td>
            <td> <?php echo $alumno["Existencia"] ?> </td>
            <td> <form method= "POST"> 
            </td>
        </tr>  
    <?php } ?>
    </tbody>
 </table>


</body>
</html>