<?php
  require "header.php";
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>What to Eat</title>
</head>
<body>
    <h1 class='text-center'>What to Eat!?</h1>   
    <h3 class='text-center'>Weekly dinner planner</h3>

  <?php
    
if (isset($_SESSION['isLoggedIn']) == true){

      require_once "./src/login.php";
      $conn = new mysqli($hostName, $username, $pw, $db);
      if($conn->connect_error) die('Could not connect to the database');

      echo "<br /><br>
      <div class='container'>
          <div class='row mx-auto mb-5'>
          <div class='card bg-light mb-5 mt-5 mx-auto' style='width: 45rem; margin-top:200px;'>";


      $query = "SELECT * FROM instruction inc
                LEFT JOIN community c ON inc.entree_id=c.entree_id
                OR inc.breakfast_id=c.breakfast_id
                OR inc.lunch_id=c.lunch_id
                OR inc.app_id=c.app_id
                OR inc.dessert_id=c.dessert_id
                OR inc.other_id=c.other_id
                LEFT JOIN users u ON c.user_id=u.id
                WHERE c.id != 0 ORDER BY c.id DESC";
      $result = $conn->query($query);

      if(!$result) die ('Error, please try again');

      $rows=$result->num_rows;

      for ($i=0; $i<$rows; ++$i)
      {
        $row=$result->fetch_array(MYSQLI_NUM);

        $instruction = $row[2];
        $item = $row[10];
        $item_id = $row[17];
        $firstName = $row[19];
        $lastName= $row[20];
        $breakfast_id = $row[3];
        $lunch_id = $row[4];
        $entree_id=$row[1];
        $app_id =$row[5];
        $dessert_id = $row[6];
        $other_id = $row[7];
        $user = $row[9];
        $bid = $row[11];
        $lid = $row[12];
        $eid = $row[13];
        $aid = $row[14];
        $did = $row[15];
        $oid = $row[16];
        
        echo "<div class='card-title  bg-info text-light'>
                <a href = './profile/$user'>
                  <img src='$user.jpg' class='rounded-circle float-left mt-3 ml-5 mr-5' style = 'width:100px; height:80px;'/>
                </a><br/>
                <h3 class='float-left '>$item</h3><br/><br/>
                <p class='float-left mr-5'>by: $firstName $lastName</p>";
       
        if ($breakfast_id!=null) echo "<input type='submit' onclick='return saveBreakfast($item_id, \"$item\");' class='btn btn-primary mb-3' name='share' value='Save to My Cookbook'/></div><br/>";
        else if($lunch_id!=null) echo "<input type='submit' onclick='return saveLunch($item_id, \"$item\");' class='btn btn-primary mb-3' name='share' value='Save to My Cookbook'/></div><br/>";
        else if($entree_id!=null) echo "<input type='submit' onclick='return saveEntree($item_id, \"$item\");' class='btn btn-primary mb-3' name='share' value='Save to My Cookbook'/></div><br/>";
        else if($app_id!=null) echo "<input type='submit' onclick='return saveApp($item_id, \"$item\");' class='btn btn-primary mb-3' name='share' value='Save to My Cookbook'/></div><br/>";
        else if($dessert_id!=null) echo "<input type='submit' onclick='return saveDessert($item_id, \"$item\");' class='btn btn-primary mb-3' name='share' value='Save to My Cookbook'/></div><br/>";
        else if($other_id!=null) echo "<input type='submit' onclick='return saveOther($item_id, \"$item\");' class='btn btn-primary mb-3' name='share' value='Save to My Cookbook'/></div><br/>";
        else echo "where did this button go??";

        if($breakfast_id == $item_id)
        {
          $query2 = "SELECT * FROM ingredients i
                     LEFT JOIN community c ON i.breakfast_id = c.breakfast_id
                     WHERE i.breakfast_id = c.breakfast_id";

          $result2 = $conn->query($query2);

          $rs = $result2->num_rows;

          for($j=0; $j<$rs; ++$j)
          {
            $r = $result2->fetch_array(MYSQLI_NUM);

            $amount = $r[3];
            $measure = $r[2];
            $ingredient = $r[4];
            $name = $r[12];
            
            if($name == $item && $bid == $breakfast_id)
            {
              echo "<div class='text-center card-text'>
                    <div class='row mx-auto'>
                      <div id='amount' class='col-4'>
                         <p>$amount</p>
                      </div>
                      <div id='meaure' class='col-4'>
                        <p>$measure</p>
                      </div>
                      <div id='ingredient' class='col-4'>
                        <p>$ingredient</p>
                      </div>
                    </div><br/>";
            }
          }
        } else if($lunch_id == $item_id)
        {
          $query2 = "SELECT * FROM ingredients i
                     LEFT JOIN community c ON i.lunch_id = c.lunch_id
                     WHERE i.lunch_id = c.lunch_id";

          $result2 = $conn->query($query2);

          $rs = $result2->num_rows;

          for($j=0; $j<$rs; ++$j)
          {
            $r = $result2->fetch_array(MYSQLI_NUM);

            $amount = $r[3];
            $measure = $r[2];
            $ingredient = $r[4];
            $name = $r[12];
            
            if($name == $item && $lid == $lunch_id)
            {
              echo "<div class='text-center card-text'>
                    <div class='row mx-auto'>
                      <div id='amount' class='col-4'>
                         <p>$amount</p>
                      </div>
                      <div id='meaure' class='col-4'>
                        <p>$measure</p>
                      </div>
                      <div id='ingredient' class='col-4'>
                        <p>$ingredient</p>
                      </div>
                    </div><br/>";
            }
          }
        }else if($entree_id == $item_id)
        {
          $query2 = "SELECT * FROM ingredients i
                     LEFT JOIN community c ON i.entree_id = c.entree_id
                     WHERE i.entree_id = c.entree_id";

          $result2 = $conn->query($query2);

          $rs = $result2->num_rows;

          for($j=0; $j<$rs; ++$j)
          {
            $r = $result2->fetch_array(MYSQLI_NUM);

            $amount = $r[3];
            $measure = $r[2];
            $ingredient = $r[4];
            $name = $r[12];
            
            if($item_id == $entree_id && $name == $item)
            {
              echo "<div class='text-center card-text'>
                    <div class='row mx-auto'>
                      <div id='amount' class='col-4'>
                         <p>$amount</p>
                      </div>
                      <div id='meaure' class='col-4'>
                        <p>$measure</p>
                      </div>
                      <div id='ingredient' class='col-4'>
                        <p>$ingredient</p>
                      </div>
                    </div><br/>";
            }
          }
        } else if($app_id == $item_id)
        {
          $query2 = "SELECT * FROM ingredients i
                     LEFT JOIN community c ON i.app_id = c.app_id
                     WHERE i.app_id = c.app_id";

          $result2 = $conn->query($query2);

          $rs = $result2->num_rows;

          for($j=0; $j<$rs; ++$j)
          {
            $r = $result2->fetch_array(MYSQLI_NUM);

            $amount = $r[3];
            $measure = $r[2];
            $ingredient = $r[4];
            $name = $r[12];
            
            if($name == $item && $aid == $app_id)
            {
              echo "<div class='text-center card-text'>
                    <div class='row mx-auto'>
                      <div id='amount' class='col-4'>
                         <p>$amount</p>
                      </div>
                      <div id='meaure' class='col-4'>
                        <p>$measure</p>
                      </div>
                      <div id='ingredient' class='col-4'>
                        <p>$ingredient</p>
                      </div>
                    </div><br/>";
            }
          }
        } else if($dessert_id == $item_id)
        {
          $query2 = "SELECT * FROM ingredients i
                     LEFT JOIN community c ON i.dessert_id = c.dessert_id
                     WHERE i.dessert_id = c.dessert_id";

          $result2 = $conn->query($query2);

          $rs = $result2->num_rows;

          for($j=0; $j<$rs; ++$j)
          {
            $r = $result2->fetch_array(MYSQLI_NUM);

            $amount = $r[3];
            $measure = $r[2];
            $ingredient = $r[4];
            $name = $r[12];
            
            if($name == $item && $did == $dessert_id)
            {
              echo "<div class='text-center card-text'>
                    <div class='row mx-auto'>
                      <div id='amount' class='col-4'>
                         <p>$amount</p>
                      </div>
                      <div id='meaure' class='col-4'>
                        <p>$measure</p>
                      </div>
                      <div id='ingredient' class='col-4'>
                        <p>$ingredient</p>
                      </div>
                    </div><br/>";
            }
          }
        }else if($other_id == $item_id)
        {
          $query2 = "SELECT * FROM ingredients i
                     LEFT JOIN community c ON i.other_id = c.other_id
                     WHERE i.other_id = c.other_id";

          $result2 = $conn->query($query2);

          $rs = $result2->num_rows;

          for($j=0; $j<$rs; ++$j)
          {
            $r = $result2->fetch_array(MYSQLI_NUM);

            $amount = $r[3];
            $measure = $r[2];
            $ingredient = $r[4];
            $name = $r[12];
            
            if($name == $item && $item_id == $other_id)
            {
              echo "<div class='text-center card-text'>
                    <div class='row mx-auto'>
                      <div id='amount' class='col-4'>
                         <p>$amount</p>
                      </div>
                      <div id='meaure' class='col-4'>
                        <p>$measure</p>
                      </div>
                      <div id='ingredient' class='col-4'>
                        <p>$ingredient</p>
                      </div>
                    </div><br/>";
            }
          }
        }

        // $query2= "SELECT * FROM ingredients i
        //           LEFT JOIN community c ON i.entree_id = c.item_id
        //                                 OR i.breakfast_id = c.item_id
        //                                 OR i.lunch_id = c.item_id
        //                                 OR i.app_id = c.item_id
        //                                 OR i.dessert_id = c.item_id
        //                                 OR i.other_id = c.item_id
        //                                 WHERE c.id !=0";
                        
        // $result2 = $conn->query($query2);

        // if(!$result2) die('error, please try again');

        // $rs = $result2->num_rows;

        // for ($j=0; $j<$rs; ++$j)
        // {
        //   $r = $result2->fetch_array(MYSQLI_NUM);

        //   $measure = $r[2];
        //   $amount = $r[3];
        //   $ingredient = $r[4];
        //   $breakfast_id = $r[6];
        //   $lunch_id = $r[7];
        //   $entree_id = $r[1];
        //   $app_id = $r[5];
        //   $dessert_id = $r[8];
        //   $other_id = $r[9];
        //   $name = $r[12];
        //   $b_id= $r[13];
        //   $l_id = $r[14];
        //   $e_id = $r[15];
        //   $a_id = $r[16];
        //   $d_id = $r[17];
        //   $o_id = $r[18];

        //   if(($name == $item))
        //   {
        //     echo "<div class='text-center card-text'>
        //   <div class='row mx-auto'>
        //       <div id='amount' class='col-4'>
        //           <p>$amount</p>
        //       </div>
        //       <div id='meaure' class='col-4'>
        //           <p>$measure</p>
        //       </div>
        //       <div id='ingredient' class='col-4'>
        //           <p>$ingredient</p>
        //       </div>
        //   </div><br/>";
        //   }

        // }

        echo "   <div class='row mx-auto'>
                    <div id='instruction' class='col-12'>
                        <p class='text-center p-5'>$instruction</p>
                    </div><br/><br/>
                </div>";
                
        
      }
    }
    else echo "Please login";
    
  ?>

<script>
  function saveBreakfast(itemId, item){
    $.ajax({
            url: './src/saveBreakfast.php',
            type: 'POST',
            data: {itemId,
                   item}
        });
  };

  function saveLunch(itemId, item){
    $.ajax({
            url: './src/saveLunch.php',
            type: 'POST',
            data: {itemId,
                   item}
        });
  };

  function saveEntree(itemId, item){

        $.ajax({
            url: './src/saveDinner.php',
            type: 'POST',
            data: {itemId,
                   item}
        });
  };

  function saveApp(itemId, item){
    $.ajax({
            url: './src/saveApp.php',
            type: 'POST',
            data: {itemId,
                   item}
        });
  };
  

  function saveDessert(itemId, item){
    $.ajax({
            url: './src/saveDessert.php',
            type: 'POST',
            data: {itemId,
                   item}
        });
  };

  function saveOther(itemId, item){
    $.ajax({
            url: './src/saveOther.php',
            type: 'POST',
            data: {itemId,
                   item}
        });
  };
</script>
</body>
</html>