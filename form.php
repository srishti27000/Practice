<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Document</title>
    <link
      href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css"
      rel="stylesheet"
      integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN"
      crossorigin="anonymous"
    />
    <script
      src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"
      integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL"
      crossorigin="anonymous"
    ></script>
    <style>
      body{
       background-image: url("https://images.pexels.com/photos/4391612/pexels-photo-4391612.jpeg?auto=compress&cs=tinysrgb&w=1260&h=750&dpr=1");
       background-repeat: no-repeat;
       background-size:100%;
       
      }
        .container {
            border: solid  #f0c5f1 9px;
            padding:10px;
            margin:auto;  
            width:40%;
            background-color: rgb(250 226 251);
            margin-top:200px;
            position:relative;
        }
    </style>
  </head>
  <body>
    
    <div class="container">
        <h1>Enter your Details</Details></h1>
        <?php echo $statusMessage; ?>
        <form action="<?= $_SERVER['PHP_SELF'] ?>" method="post">
        <div class="form-floating mb-3">
          <input type="text" class="form-control" id="firstName" name="firstName" required/>
          <label for="firstName">Firstname</label>
        </div>
        <div class="form-floating mb-3">
          <input type="text" class="form-control" id="surname" name="surname" required/>
          <label for="surname">Surname</label>
        </div>
        <div class="form-floating mb-3">
            <input type="number" class="form-control" id="number" name="number" required>
            <label for="number">Number</label>
        </div>
        <div class="form-floating mb-3">
            <input type="textarea" class="form-control" id="address" name="address" required>
            <label for="address">Address</label>
        </div>
        <div class="form-floating mb-3">
            <input type="textarea" class="form-control" id="info" name="info" required>
            <label for="info">Any other information</label>
        </div>
        <button class="btn btn-light">Submit</button>
      </form>
    </div>
    
    <?php
    
    // database configuration
    $servername ='localhost';
    $username ='root';
    $password= 'Welcome@123';
    $dbname=  'sample_schema';


    // database connection
    $conn = new mysqli($servername, $username, $password, $dbname);

    if($conn->connect_error) {
      die("Connection failed:".$conn->connect_error);
    }

    // Initialize a variable to store the status message
    $statusMessage="";

    //check if form has been submitted
    if ($_SERVER["REQUEST_METHOD"]== "POST"){
      $firstName = $_POST["firstName"];
      $surname = $_POST["surname"];
      $number = $_POST["number"];
      $address = $_POST["address"];
      $info = $_POST["info"];

      $sql = "INSERT INTO Personal_data(First_Name, Surname, `Number` , `Address`, Information )VALUES(?,?,?,?,?)";
      $stmt = $conn->prepare($sql); //stmt = prepared statement
      $stmt->bind_param("sssss", $firstName, $surname, $number, $address, $info);

      if($stmt->execute()){
        $statusMessage= "Data inserted successfully!";

        //Redirect to the same page to clear the form 
        header("Location: ".$_SERVER['PHP_SELF']);
        exit(); // Stop script execution after redirect
      } 
      else {
        $statusMessage="Error: " .$stmt->error;
      }

      //Close the prepared statement
      $stmt->close();
    }
   
    // Close the database connection
    $conn->close();

    ?>
   
  </body>
</html> 
