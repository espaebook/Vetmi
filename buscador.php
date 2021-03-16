<?php
    include 'conexion.php'
?>
<?php
    include 'cabecera.php'
?>

<div class="bd-table">
  <div class="container-fluid text-light text-center font-weight-bold">
    <div class="row">
      <div class="col-sm">Nombre</div>
      <div class="col-sm">Descripcion</div>
      <div class="col-sm-1">Precio</div>
      <div class="col-sm">Imagen</div>
    </div>
  </div>
</div>

  <?php
    $nombre = $_POST['hola'];
    $result = pg_query($conexion, "select count (nombre) FROM productos WHERE nombre ILIKE  '%$nombre%'");
    $data = pg_fetch_array($result);

    $por_pagina = 5;

    if(empty($_GET['pagina'])){
        $pagina = 1;
    }else{
        $pagina = ($_GET['pagina']);
    }
    
    $hasta = ($pagina-1) * $por_pagina;
    $total_paginas = ceil($data[0]/$por_pagina);        

    $result = pg_query($conexion, "SELECT id, nombre, descripcion, precio, imagen FROM productos WHERE nombre ILIKE  '%$nombre%' ORDER BY id ASC LIMIT $por_pagina OFFSET $hasta");
    $result_num = pg_num_rows($result);

  ?>
  <?php
    if ($result_num > 0){
        
        while ($data = pg_fetch_array($result)){
  ?>
          <div class="container-fluid text-center border">
            <div class="row align-items-center pt-1">
              <div class="col-sm pt-2"><?php echo $data[1] ?></div>
              <div class="col-sm text-justify pt-3"><?php echo $data[2] ?></div>
              <div class="col-sm-1 pt-3">$<?php echo number_format($data[3],0)?></div>
              <div class="col-sm pt-3"><img src="<?php echo $data[4] ?>" class="img-fluid" alt="Responsive image"></div>
            </div>
          </div>
  <?php
          }
      }
  ?>





  <!-- Bootstrap core JavaScript -->
  <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
  <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js" integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6" crossorigin="anonymous"></script>
  <!-- Plugin JavaScript -->
  <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-easing/1.4.1/jquery.easing.min.js"></script>

  <!-- Custom JavaScript for this theme -->
  <script src="./js/title_script.js"></script>
  <script src="./js/script.js"></script>

</body>

</html>









