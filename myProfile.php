<?php
    require "header.php";

    require_once './src/login.php';

    $conn= new mysqli($hostName, $username, $pw, $db);
    if ($conn->connect_error) die('database could not be accessed');
    
    $firstName=$_SESSION['firstName'];
    $lastName=$_SESSION['lastName'];
    $user = $_SESSION['id'];

    echo "<h1 class = 'text-center text-info'>$firstName $lastName</h1><br /><br />";

    if (isset($_FILES['image']['name']))
    {
        $saveTo = "$user.jpg";
        move_uploaded_file($_FILES['image']['tmp_name'], $saveTo);
        $typeOk = TRUE;

        switch($_FILES['image']['type'])
        {
            case "image/gif": $src = imagecreatefromgif($saveTo); break;
            case "image/jpeg": 
            case "image/pjpeg": $src = imagecreatefromjpeg($saveTo); break;
            case "image/png": $src = imagecreatefrompng($saveTo); break;
            default:          $typeOk = FALSE; break;
        }

        if ($typeOk)
        {
            list($w, $h) = getimagesize($saveTo);

            $max = 200;
            $tw = $w;
            $th = $h;

            if ($w > $h && $max < $w)
            {
                $th = $max / $w * $h;
                $tw = $max;
            }
            elseif ($h > $w && $max < $h)
            {
                $tw = $max / $h * $w;
                $th = $max;
            }
            elseif ($max < $w)
            {
                $tw = $th = $max;
            }

            $tmp = imagecreatetruecolor($tw, $th);
            imagecopyresampled($tmp, $src, 0, 0, 0, 0, $tw, $th, $w, $h);
            imageconvolution($tmp, array(array(-1,-1,-1),
                                    array(-1,18,1), array(-1,-1,-1)), 8, 0);
            imagejpeg($tmp, $saveTo);
            imagedestroy($tmp);
            imagedestroy($src);

        }
    }

        echo "<div class='container text-center'>";

        if (file_exists("$user.jpg"))
                echo "<img class='rounded-circle' src='$user.jpg'><br/><br />";


                echo "<form method='post' action='myProfile.php' enctype='multipart/form-data'>
                    <div class='custom-file'>
                        <input type='file' class='file-input' id='customFile' name='image'>
                        <label class='custom-file-label w-100' for='customFile'>Profile Picture</label>
                    </div><br /><br />
                    <div class='form-group'>
                        <h3 class='text-center'>About Me</h3>
                        <label for 'aboutMe'>Enter a brief Bio here</label>
                        <textarea class='form-control' id='aboutMe' rows='6' name='aboutMe'></textarea>
                    </div>
                    <input type='submit'class='btn btn-primary text-center' value='Save Profile'/>
                </form>
            </div><br>";

        if (isset($_POST['aboutMe']))
        {
            $bio = $_POST['aboutMe'];

            $query2 = "SELECT count(1) FROM bio WHERE user_id = $user ORDER BY id DESC LIMIT 1";
            $resultCount = $conn->query($query2);
            $rows = $resultCount->num_rows;
            $r = $resultCount->fetch_array(MYSQLI_NUM);
            if ($r[0] > 0){
                //$query = "INSERT INTO bio VALUES(NULL, '$user', '$bio')";
                $query = "REPLACE INTO bio VALUES(NULL, '$user', '$bio')";
            }else {
                $query = "INSERT INTO bio VALUES(NULL, '$user', '$bio')";
            }
            
            $result = $conn->query($query);
            
            if (!$result) die ("<h3 class='text-center'>Please fill out the About Me section</h3>");
        }
            $query2 = "SELECT bio FROM bio WHERE user_id = $user ORDER BY id DESC LIMIT 1";
            $result2 = $conn->query($query2);

            if(!$result2) die('Bio does Not exist');

            $rows = $result2->num_rows;

            for($i=0; $i<$rows; ++$i)
            {
                $r = $result2->fetch_array(MYSQLI_ASSOC);

                $about = $r['bio'];
                // $id = $r[0];
            
                // if (isset($_POST['aboutMe']))
                // {
                //  $bio =$_POST['aboutMe'];
                //     if($id > 0)
                //     {
                //         $query3 = "UPDATE bio SET bio= '$bio' WHERE user_id = $user";   
                //         $result3 = $conn->query($query3);
                        
                //         if(!$result3) die ('ok now');
                //     }else
                //     {
                //         $query = "INSERT INTO bio VALUES(NULL, $user, $bio)";
                //         $result = $conn->query($query);
            
                //         if (!$result) die ("<h3 class='text-center'>Please fill out the About Me section</h3>");
                //     }
                 
                // } 

                echo "<h3 class='text-center'>$about</h3>";
            }
?>