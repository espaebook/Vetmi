<?php
  include 'conexion.php'
?>  
<?php
    include 'cabecera.php'
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">

</head>
<body>

  <?php
    $result = pg_query($conexion, "select count (*) from productos");
    $data = pg_fetch_array($result);
  ?>

  <?php
    $por_pagina = 5;

    if(empty($_GET['pagina'])){
        $pagina = 1;
    }else{
        $pagina = ($_GET['pagina']);
    }
    
    $hasta = ($pagina) * $por_pagina;
    --$hasta;
    $total_paginas = ceil($data[0]/$por_pagina);        

    $result = pg_query($conexion, "select * from productos ORDER BY id ASC LIMIT $por_pagina OFFSET $hasta");
    $result_num = pg_num_rows($result);

  ?>

  <?php
    if ($result_num > 0){
        
        while ($data = pg_fetch_array($result)){
  ?>

    <div class="container-fluid text-center border font-weight-bold">
      <div class="row align-items-center pt-1">
        <div class="col-sm-7 " >
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
            if($data[4]==false){
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

  <?php
    if(empty($_GET['pagina'])){
        $pagina = 1;
    }else{
        $pagina = ($_GET['pagina']);
    }
  ?>



  <?php
    // calculamos la primera y última página a mostrar
    $primera = $pagina - ($pagina % 10) + 1;
    if ($primera > $pagina) { $primera = $primera - 10; }
    $ultima = $primera + 9 > $total_paginas ? $total_paginas : $primera + 9; 
  ?>

  <div class="container pt-3">
    <nav aria-label="Page navigation" class="text-center">
      <ul class="pagination justify-content-center">
        <?php
        if ($total_paginas > 1) {
            // comprobamos $primera en lugar de $pagina
            if ($primera != 1)
                echo '<li class="page-item"><a class="page-link" href="?pagina='.($primera-1).'">Previous</a></li>';

            // mostramos de la primera a la última
            for ($i = $primera; $i <=$ultima; $i++){
                if ($pagina == $i)
                    echo '<li class="page-item active"><a class="page-link" href="#">'.$pagina.'</a></li>';
                else
                    echo '<li class="page-item"><a class="page-link" href="?pagina='.$i.'">'.$i.'</a></li>';
            }

            if ($i <= $total_paginas)
                echo '<li class="page-item" ><a class="page-link" href="?pagina='.($i).'">Next</a></li>';
        }
        ?>
      </ul>
    </nav>
    
  </div>

  
</body>
</html>
