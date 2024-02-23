<?php

  include_once('dbcon.php');

  $limit_per_page = 6;

  $page = "";
  if(isset($_POST["page_no"])){
    $page = $_POST["page_no"];
  }else{
    $page = 1;
  }

  $offset = ($page - 1) * $limit_per_page;

  $sql = "SELECT * FROM project LIMIT {$offset},{$limit_per_page}";
  $result = mysqli_query($con,$sql) or die("Query Unsuccessful.");
  $output= "";
  if(mysqli_num_rows($result) > 0){
    $output .= '<section class="popular-places bg-white">
    <div class="container">
        <div class="sec-title">
            <h2><span>Our </span>Gallery</h2>
           
        </div>
        <div class="row">';
      while($row = mysqli_fetch_assoc($result)) {
        // $output .= "<tr>
        //              <td align='center'>{$row["id"]}</td><td>{$row["pname"]} {$row["pprice"]}</td>
        //             </tr>";

        $output .=" <div class='col-sm-6 col-lg-4 col-xl-4'>
        
            <a href='single-property-1.php?cat_id={$row['id']}' class='img-box hover-effect'>
            <img src='admin_section/upload/{$row["front_img"]}' class='img-responsive' alt=''>
            <div class='img-box-content visible'>
            <h4>{$row["pname"]}</h4>         
            </div>
            </a>        
            </div>";


      }
    $output .= " </div>
                 </div>
    </section>";

    $sql_total = "SELECT * FROM project";
    $records = mysqli_query($con,$sql_total) or die("Query Unsuccessful.");
    $total_record = mysqli_num_rows($records);
    $total_pages = ceil($total_record/$limit_per_page);

    
      
   

    $output .='
    <section class="properties-list featured blog  mb-2">
    <div class="container" id="pagination">
    <nav aria-label="..." class="pt-3">
    <ul class="pagination mt-0" style="gap:5px;">
       
                  
                ';

    for($i=1; $i <= $total_pages; $i++){
      if($i == $page){
        $class_name = "active";
      }else{
        $class_name = "";
      }
      $output .= "<li class='page-item' style='list-style-type:none;'>
                         <a class='page-link {$class_name}' id='{$i}' href=''>{$i} </a>
                    </li>";

                   // $output .= "<a class='{$class_name}' id='{$i}' href=''>{$i}</a>";
    
    }
    $output .=' </ul>
    </nav>
    </div>
    </section>';


    



    echo $output;
  }else{
    "<div class='alert alert-danger text-center' role='alert'>
    <b>Gallery Section is Empty...!</b>
  </div>";
  }
