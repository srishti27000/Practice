<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Document</title>
    <script
      src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"
      integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL"
      crossorigin="anonymous"
    ></script>
    <link
      href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css"
      rel="stylesheet"
      integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN"
      crossorigin="anonymous"
    />
    <link rel="stylesheet" href="index.css">
  </head>
  <body>
  <!-- <img src="Free Vector _ Spring background.jpeg">  -->
  


     <div id='nav'>
     <h1> <center> Currency Converter </center></h1>
  </div>

  
    <div id='div1'>
      
    <form method="post">
        <h2>Enter Amount</h2> 
        <input type="number" name="amt" required  /> <br>
        <label>
            <p>From</p>
            <select name="fromCur" required id="">
                <option>Select</option>
                <option>USD</option>
                <option>INR</option>
                <option>GBP</option>
                <option>AED</option>
                <option>CAD</option>
            </select>
        </label>
        <br />
        <br />
        <label>
            <p>To</p>
            <select name="toCurr" required id="">
                <option>Select</option>
                <option>USD</option>
                <option>INR</option>
                <option>GBP</option>
                <option>AED</option>
                <option>CAD</option>
            </select>
        </label><br>
        <input type="submit" name="submit" />
        <?php
    if (isset($_POST['submit'])) {
      $amt = $_POST['amt'];
      $toCurr = $_POST['toCurr'];
      $url = "http://api.exchangeratesapi.io/v1/latest?access_key=8e960f2e2927f5396f518a105187f03b&format=1&base=$fromCur&symbols=$toCur";
      $ch = curl_init();
      curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
      curl_setopt($ch, CURLOPT_URL, $url);
      $result = curl_exec($ch);
      curl_close($ch);
      $result = json_decode($result, true);
      $final_amt = $result['rates'][$toCurr];
      echo $amt * $final_amt;
      print_r($final_amt);
    }
    ?>
        </div>
</body>

</html>
  </body>
</html>


 <!-- af6057c4a79befb16e54b199cd1e03be API  Access key -->