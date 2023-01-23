<!-- the below php script connect the current file to the database-->
<?php
include_once "database.php";
?>

<!DOCTYPE html>
<html>
<head>
    <meta charset='utf-8'>
    <meta http-equiv='X-UA-Compatible' content='IE=edge'>
    <title>Page Title</title>
    <meta name='viewport' content='width=device-width, initial-scale=1'>
    <link rel='stylesheet' type='text/css' media='screen' href='main.css'>
    <script src='main.js'></script>
<!-- below are the links for css and bootstrap-->
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet">
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js"></script>
<style>

.error{
  color: red;
}
.footer{
  margin-top: 15px;
  margin-bottom: 15px;
  text-align: center;
}
</style>
   

</head>
<body>
   <?php
//define variables and set them all to empty and then the codes that follow are for the validation of the form
$skuErr = $nameErr = $priceErr  = $switchErr=$sizeErr=$weightErr=$lengthErr =$widthErr =$heightErr ="";
$sku = $name = $price  = $switch= $size=$weight=$length=$width=$height="";
   if ($_SERVER['REQUEST_METHOD'] == 'POST') {
     if (empty($_POST['sku'])) {
       $skuErr = "Please enter required data";
     } else {
       $sku = test_input($_POST['sku']);
     }
     if (empty($_POST['name'])) {
      $nameErr = "Please enter required data";
    } else {
      $name = test_input($_POST['name']);
      if (!preg_match("/^[a-zA-Z-' ]*$/",$name)) {
        $nameErr = "Only letters and white space allowed";
      }
    }
    if (empty($_POST['price'])) {
      $priceErr = "Please enter required data";
    } else {
      $price = test_input($_POST['price']);
    }
    
    if (empty($_POST['swicth'])) {
      $switchErr = "Please make selection";
    } else {
      $switch = test_input($_POST['switch']);
    }
    if (empty($_POST['size'])) {
      $sizeErr = "Please provide DVD size in MB";
    } else {
      $size= test_input($_POST['size']);
    }
    if (empty($_POST['weight'])) {
      $weightErr = "Please provide Book weight in KG";
    } else {
      $weight= test_input($_POST['weight']);
    }
    if (empty($_POST['width'])) {
      $widthErr = "Please provide width in CM";
    } else {
      $width= test_input($_POST['width']);
    }
    if (empty($_POST['length'])) {
      $lengthErr = "Please provide  length in CM";
    } else {
      $length= test_input($_POST['length']);
    }
    if (empty($_POST['height'])) {
      $heightErr = "Please provide height in CM";
    } else {
      $height= test_input($_POST['height']);
    }
    

   }
function test_input($data){
  $data = trim($data);
  $data = stripslashes($data);
  $data = htmlspecialchars($data);
  return $data;
}

   ?>
 <!-- the below codes holds the page title and the cancel button-->
 <div>
 <nav class="navbar navbar-expand-lg navbar-fixed-top navbar-dark bg-dark">
  <div class="container-fluid">
    <h3 class="navbar-brand">Product Add</h3>
    </div>
    <div style="float:right">
        <button class="btn btn-primary" type="submit" style="display: inline-block; margin-right: 10px" onclick="document.location='index.php'">CANCEL</button>
    </div>
</nav>
</div>
<!--below is the form that receive input data from the user to be sent to the database then display on the front page of the website -->
<div class="container" style="margin-top:20px;">
<p><span class="error">*Required field</span></p>
<form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>" method="post" >

<div class="form-group row" >
    <label for="SKU" class="col-sm-1 col-form-label">SKU</label>
    <div class="col-sm-3">
      <input  type="text" class="form-control" name="sku" id="#sku" >
      <span class="error">* <?php echo $skuErr;?></span>
    </div>
  </div><br>
  <div class="form-group row">
    <label for="NAME" class="col-sm-1 col-form-label">NAME</label>
    <div class="col-sm-3">
      <input  type="text" class="form-control" name="name" id="#name" >
      <span class="error">* <?php echo $nameErr;?></span>
    </div>
  </div><br>
  <div class="form-group row">
    <label for="PRICE" class="col-sm-1 col-form-label">PRICE ($)</label>
    <div class="col-sm-3">
      <input  id="#prices" type="number" min="1" max="10000.00" step="1" class="form-control" name="price" >
      <span class="error">* <?php echo $priceErr;?></span>
    </div>
  </div><br>
  
  <div class="form-group row">
    <label for="typeswitcher" id="#productType" class="col-sm-1 col-form-label">Type Switcher</label>
    <span class="error">* <?php echo $switchErr;?></span>
    <div class="col-sm-3">
    <select id="product"class="form-select" >
            <option value="" disabled selected> select</option>
            <span class="error">* <?php echo $switchErr;?></span>
            <option value="dvd"> DVD</option>
            <option value="book" > Book</option>
            <option value="furniture" > Furniture</option>
          </select>

          <div>
            <div id="book" style="display: none;" class="myDiv">
                <label for="weight">Weight (KG) </label>
                <input type="number" step="any" min="0"  class="form-control" name="weight" id="weight">
                <span class="error">* <?php echo $weightErr;?></span>
            </div>
            <div id="furniture" style="display: none;"class="myDiv">
                <label for="length">Length (CM) </label><span class="error">* <?php echo $lengthErr;?></span>
                <input type="number" step="any" min="0"  class="form-control" name="length" id="length"><br>
                
                <label for="width">Width (CM) </label><span class="error">* <?php echo $widthErr;?></span>
                <input type="number" step="any" min="0"  class="form-control" name="width" id="width"><br>
                
                <label for="height">Height (CM) </label><span class="error">* <?php echo $heightErr;?></span>
                <input type="number" step="any" min="0"  class="form-control" name="height" id="height"><br>
                
            </div>
            <div id="dvd" style="display: none;" class="myDiv">
                <label for="size">Size (MB) </label>
                <input type="number" step="any" min="0" class="form-control" name="size" id="size"> 
                <span class="error">* <?php echo $sizeErr;?></span>
            </div>
            </div>
    </div>
  </div><br><br><br>

  <button class="btn btn-lg btn-primary" type="submit" value="Submit" name="submit" >SAVE</button>
   
</form>
</div>

<!--the below php script allows us to send and store data from the above form to the database -->

<?php
include_once "database.php";

if(isset($_POST['submit'])){

    $sku = $_POST['sku'];
    $name = $_POST['name'];
    $price = $_POST['price'];
    $weight = $_POST['weight'];
    $length = $_POST['length'];
    $width = $_POST['width'];
    $height = $_POST['height'];
    $size = $_POST['size'];
    
    $sql = "INSERT INTO assess1 (sku,name,price,weight,length,width,height,size)
    VALUES('$sku','$name','$price','$weight','$length','$width','$height','$size')";
   
   if(mysqli_query($conn, $sql)){
    echo "New record has been added successfully !";
   }else{
    echo "Error: " . $sql . ":-" . mysqli_error($conn);
   }
   mysqli_close($conn);
}


?>

<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.1/jquery.min.js"></script>
<script>
//  the below lines of codes provide the dinamyc change for difference product type upon selection
$(document).ready(function(){
  $("#product").on('change',function(){
$("div.myDiv").hide();
$("#"+ $(this).val()).show();
  });
});   
</script>



<footer class="footer">
    <p>Scandiweb Test assignment</p>
</footer>
</body>
</html>