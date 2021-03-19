<?php
    include 'conexion.php'
?>
<?php
    include 'cabecera.php'
?>

  <?php
    $nombre = $_POST['hola'];
    $result = pg_query($conexion, "select count (nombre) FROM productos WHERE nombre ILIKE  '%$nombre%'");
    $data = pg_fetch_array($result);

    ?>
    
    <?php
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

    <div id="download" class="container-fluid text-center border font-weight-bold">
      <div class="row align-items-center pt-1">
        <div class="col-sm-1 nom" ><?php echo $data[0] ?></div>
        <div class="col-sm-6 " >
          <div class="row h-25">
            <div class="col nom" ><?php echo $data[1] ?></div>
          </div>
          <div class="row h-25 text-justify">
            <div class="col prec" >$<?php echo number_format($data[3],0)?></div>
          </div>
          <div class="row h-50 text-justify">
            <div class="col text-center des" ><p><?php echo $data[2] ?></p></div>
          </div>
        </div>
        <div class="col-sm-5">
          <?php 
            if(empty($data[4]) == true){
              echo '<img src="./img/no.png" class="img-fluid" alt="Responsive image">';
            }else{
              echo '<img src="'.$data[4].'" class="img-fluid" alt="Responsive image">';
            }
          ?> 
        </div>
      </div>
    </div>
  <?php
        }
    }
  ?>

</body>

</html>









