<?php
    include 'conexion.php'
?>
<?php
    include 'cabecera.php'
?>
 
<body>
<div class='container mt-5'>
    <div class='row'>
        <div class='mx-auto text-center'>
        <h1>Buscar Producto</h1>
        </div>
    </div>
    <form action="buscador.php" method="post">
    <div class='row justify-content-center p-3 text-align:center'>
        <div class="input-group input-group-lg">
            <input name="hola" placeholder="Nombre del Producto" type="text" class="form-control" aria-label="Large" aria-describedby="inputGroup-sizing-sm">
        </div>
    </div>
    </form>
    <div class='row mt-3'>
        <div class='mx-auto'>
            <a class="shop" href="lista2.0.php"><p class='lead'><i class="fa fa-shopping-cart fa-lg" aria-hidden="true"></i>Todos los Productos</p></a>
            
            
        </div>
    </div>
</div>
<!-- partial:index.partial.html -->

<!-- partial -->
  
</body>
</html>