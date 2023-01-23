<!-- the below php script connect the current file to the database-->
<?php
include_once "database.php";
$sql = "SELECT * FROM assess1";
$result = mysqli_query($conn, $sql);

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>juniortest.louis.kapend</title>
    <!-- below are the links for css and bootstrap-->
    
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/css/bootstrap.min.css">
  <script src="https://cdn.jsdelivr.net/npm/jquery@3.6.1/dist/jquery.slim.min.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/js/bootstrap.bundle.min.js"></script>

  <style>
  .footer{
  margin-top: 15px;
  margin-bottom: 15px;
  text-align: center;
}
.card-deck{
  display:grid;
  margin-bottom: 15px;
  margin-top: 15px;

}
#card{
  display: inline-block;
  width:24%;
  
}
.card{
  text-align: center;
  
}



</style>
</head>
<body>

<!-- the below codes holds the page title and the two buttons-->
<div>
<nav class="navbar navbar-expand-lg navbar-fixed-top navbar-dark bg-dark">
  <div class="container-fluid">
    <h3 class="navbar-brand">Product List</h3>
</div>
      <div style="float:right">
       <form  class="d-flex" method="post">
        <a class="btn btn-primary first" type="submit" onclick="location='addproduct.php'" style="display: inline-block; margin-right: 10px">ADD</a>
        <button class='btn btn-primary' type='button' name='btn_delete'  id='delete-product-btn' value='delete selected row'>MASS DELETE</button>
      </form>
    </div>
  
</nav>
</div>
<!--The below php script allows us to fetch data from the database and display it onto our product list -->
<?php

while ($row = $result->fetch_assoc()) {
  products_grid($row["id"], $row["sku"], $row["name"], $row["price"], $row["size"], $row["weight"], $row["height"], $row["width"], $row["length"]);
}

function products_grid($product_id, $SKU, $name, $price, $size, $weight, $height, $width, $length)
{
  $element = "

  <div class='col-md-3 col-sm-6 my-3 my-md-0' id='card' >
    <form action='' method='POST' id='dataForm' class='formData'>
    <div class='card-deck'>
        <div class='card' >
          <div class='card-body bg-warning'>
            <h5 class='card-title'>$SKU</h5>
            <h5 class='card-text'>$name</h5>
            <h5 class='card-text'>$price  $</h5>";
  if (!empty($size)) {
    $element .= "
            <h6 class='card-text'>Size: $size MB</h6>";
  }
  if (!empty($weight)) {
    $element .= "
            <h6 class='card-text'>Weight: $weight Kg</h6>";
  }
  if (!empty($height)) {
    $element .= "
            <h6 class='card-text'>Dimensions: $height x $width x $length</h6>";
  }
  $element .= "
  
              <input class='delete-checkbox' type='checkbox' form='delete_form' name='checkbox' value= '$product_id' id='checkItem'>
              
          </div>
        </div>
      </div>

    </form>
    
  </div>
  
  ";

  echo $element;
};

?>





<footer class="footer">
    <p>Scandiweb Test assignment</p>
</footer>

<!-- the below script will help us delete a product for our product list page -->

<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.1/jquery.min.js"></script>
<script type="text/javascript">

$("#delete-product-btn").on("click",function(){
  $("input:checkbox").each(function(){
    if($(this).is(":checked") ){
      $(this).parent().remove();
    }
  });
});

</script>
</body>
</html>