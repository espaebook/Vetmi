<?php
  include 'conexion.php';

include 'cabecera.php';



// Pagination Function
function pagination($query,$per_page=10,$page=1,$url='?'){
    global $conexion;   
    // $query = "SELECT COUNT(*) as 'num' FROM productos";
    // $row = mysqli_fetch_array(mysqli_query($conDB,$query));
    
    $result = pg_query($conexion, "select count (*)  as nume FROM productos");
    $row = pg_fetch_array($result);
    
    $total = $row['nume'];
    $adjacents = "2"; 
     
    $prevlabel = "Prev";
    $nextlabel = "Next";
	$lastlabel = "Last";
     
    $page = ($page == 0 ? 1 : $page);  
    $start = ($page - 1) * $per_page;                               
     
    $prev = $page - 1;                          
    $next = $page + 1;
     
    $lastpage = ceil($total/$per_page);
     
    $lpm1 = $lastpage - 1; // //last page minus 1
     
    $pagination = "";
    if($lastpage > 1){   
        $pagination .= "<ul class='pagination justify-content-center pt-3'>";
        $pagination .= "<li class='page_info font-weight-bold pt-2'>Page {$page} of {$lastpage}</li>";
             
            if ($page > 1) $pagination.= "<li><a href='{$url}page={$prev}'>{$prevlabel}</a></li>";
             
        if ($lastpage < 7 + ($adjacents * 2)){   
            for ($counter = 1; $counter <= $lastpage; $counter++){
                if ($counter == $page)
                    $pagination.= "<li><a class='current'>{$counter}</a></li>";
                else
                    $pagination.= "<li><a href='{$url}page={$counter}'>{$counter}</a></li>";                    
            }
         
        } elseif($lastpage > 5 + ($adjacents * 2)){
             
            if($page < 1 + ($adjacents * 2)) {
                 
                for ($counter = 1; $counter < 4 + ($adjacents * 2); $counter++){
                    if ($counter == $page)
                        $pagination.= "<li><a class='current'>{$counter}</a></li>";
                    else
                        $pagination.= "<li><a href='{$url}page={$counter}'>{$counter}</a></li>";                    
                }
                $pagination.= "<li class='dot'>...</li>";
                $pagination.= "<li><a href='{$url}page={$lpm1}'>{$lpm1}</a></li>";
                $pagination.= "<li><a href='{$url}page={$lastpage}'>{$lastpage}</a></li>";  
                     
            } elseif($lastpage - ($adjacents * 2) > $page && $page > ($adjacents * 2)) {
                 
                $pagination.= "<li><a href='{$url}page=1'>1</a></li>";
                $pagination.= "<li><a href='{$url}page=2'>2</a></li>";
                $pagination.= "<li class='dot'>...</li>";
                for ($counter = $page - $adjacents; $counter <= $page + $adjacents; $counter++) {
                    if ($counter == $page)
                        $pagination.= "<li><a class='current'>{$counter}</a></li>";
                    else
                        $pagination.= "<li><a href='{$url}page={$counter}'>{$counter}</a></li>";                    
                }
                $pagination.= "<li class='dot'>..</li>";
                $pagination.= "<li><a href='{$url}page={$lpm1}'>{$lpm1}</a></li>";
                $pagination.= "<li><a href='{$url}page={$lastpage}'>{$lastpage}</a></li>";      
                 
            } else {
                 
                $pagination.= "<li><a href='{$url}page=1'>1</a></li>";
                $pagination.= "<li><a href='{$url}page=2'>2</a></li>";
                $pagination.= "<li class='dot'>..</li>";
                for ($counter = $lastpage - (2 + ($adjacents * 2)); $counter <= $lastpage; $counter++) {
                    if ($counter == $page)
                        $pagination.= "<li><a class='current'>{$counter}</a></li>";
                    else
                        $pagination.= "<li><a href='{$url}page={$counter}'>{$counter}</a></li>";                    
                }
            }
        }
         
            if ($page < $counter - 1) {
				$pagination.= "<li><a href='{$url}page={$next}'>{$nextlabel}</a></li>";
				$pagination.= "<li><a href='{$url}page=$lastpage'>{$lastlabel}</a></li>";
			}
         
        $pagination.= "</ul>";        
    }
     
    return $pagination;
}
?>
<!DOCTYPE HTML>
<html>
<head>
<meta charset="utf-8">
<style type="text/css">
/* For this page only */

ul.pagination {
    text-align:center;
    color:#212529;
}
ul.pagination li {
    display:inline;
    padding:0 3px;
}
ul.pagination a {
    color:#343a40;
    display:inline-block;
    padding:5px 10px;
    border:1px solid #cde0dc;
    text-decoration:none;
}
ul.pagination a:hover,
ul.pagination a.current {
    background:#343a40;
    color:#fff;
}
</style>
</head>
<body>
<div class="wrap">

<?php
$page = (int)(!isset($_GET["page"]) ? 1 : $_GET["page"]);
if ($page <= 0) $page = 1;

$per_page = 5; // Set how many records do you want to display per page.

$startpoint = ($page * $per_page) - $per_page;
// $startpoint = 0;

$statement = "productos ORDER BY id ASC"; // Change `records` according to your table name.
 
// $results = mysqli_query($conDB,"SELECT * FROM {$statement} LIMIT {$startpoint} , {$per_page}");

$results = pg_query($conexion, "select * from productos ORDER BY id ASC LIMIT $per_page OFFSET $startpoint");


        
    while ($data = pg_fetch_array($results)){
?>

    <div class="container-fluid text-center border font-weight-bold">
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
?>

<div class="container">
  <div class="row">
    <div class="col">
        <?php echo pagination($statement,$per_page,$page,$url='?'); ?>
    </div>

  </div>
</div>


</div>
</body>
</html>