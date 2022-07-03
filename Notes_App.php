<!DOCTYPE html>
<html lang="en">

<head>
        <title>Notes App | By Hardip Mer...</title>

        <link rel="stylesheet" type="text/css" href="Note.css?v=<?php echo time(); ?>">

        <script>
        </script>

</head>

<body>

        <?php
        $conn = mysqli_connect("localhost", "root", "") or die("<h1>Sorry, failed to connect database</h1>");
?>

        <div class="title">
                <font>Welcome To The Notes App!</font> <br>
        </div>
        <div class="form">
                <form method="POST">

                        <h2>Please Enter Title And Description</h2>
                        <label>Enter Title</label> <br>
                        <input type=text name="title" id="title" placeholder="Title" autofocus> <br>
                        <label>Enter Description</label> <br>
                        <textarea name="desc" id="desc" placeholder="Descreption"></textarea> <br>
                        <div id="sub" style="width:80px;"><input type=submit name=s value="Save"></div>

                </form>
        </div>

        <?php                       
        if(isset($_POST['s']))
        {
                $title = trim($_POST['title']);
                $desc = trim($_POST['desc']);
                $match = FALSE;

                $result = mysqli_query($conn, "SELECT * FROM `notesapp`.`note`");
                while($row = mysqli_fetch_array($result))
                {
                        if($title == $row['title'] && $desc == $row['disc'])
                        {
                                $match = TRUE;
                        }
                }

                if($match != TRUE)
                {

                        if($title != NULL)
                        {
                                $cinsert = mysqli_query($conn, "INSERT INTO `notesapp`.`note` (`title` , `disc`) VALUES ('$title' , '$desc')");

                                if(!$cinsert)
                                {
                                        $ierror = mysqli_error($conn);
                                        echo "<script> alert('Sorry, -> $ierror'); </script>";
                                }
                        }
                        else
                        {
                                echo "<script> alert('Please enter the title before saving the notes');</script>";
                        }

                }
                else
                {
                        echo "<script> alert('Record Has Already Exist');</script>";
                }
        }       

        if(isset($_GET['i']))
        {
                $sno = $_GET['i'] - 159;
                $qu = mysqli_query($conn, "SELECT * FROM `notesapp`.`note` WHERE sno='$sno'");
                $r = mysqli_fetch_array($qu);
                $et = $r['title'];
                $ed = $r['disc'];
?>

        <script>
                document.getElementById("sub").innerHTML = "<input type=submit name=u value=Save>";
                document.getElementById("title").value = "<?php echo $et ?>";
                document.getElementById("desc").value = "<?php echo $ed ?>";
        </script>

        <?php   
        }

        if(isset($_POST['u']))
        {
                $title = trim($_POST['title']);
                $desc = trim($_POST['desc']);
                $match = FALSE;

                $result = mysqli_query($conn, "SELECT * FROM `notesapp`.`note`");
                while($row = mysqli_fetch_array($result))
                {
                        if($title == $row['title'] && $desc == $row['disc'])
                        {
                                $match = TRUE;
                        }
                }

                
                if($match != TRUE)
                {

                        if($title != NULL)
                        {
                                $in = mysqli_query($conn, "UPDATE `notesapp`.`note` SET title='$title', disc='$desc' WHERE sno='$sno'");

                                if(!$in)
                                {
                                        $ierror = mysqli_error($conn);
                                        echo "<script> alert('Sorry, -> $ierror'); </script>";
                                }

                        }
                        else
                        {
                                echo "<script> alert('Please enter the title before saving the notes');</script>";
                        }

                }
                else
                {
                        echo "<script> alert('Record Has Already Exist');</script>";
                }
                header("location:Notes_App.php");
        }   
        
        if(isset($_GET['di']))
        {
                $sno = $_GET['di'] - 159;
                mysqli_query($conn, "DELETE FROM`notesapp`.`note` WHERE sno = '$sno'");
                header("location:Notes_App.php");
        }
?>

<div class="table">

        <table class="tbl" cellspacing="0">
                <thead>
                        <tr>
                                <th class="tsno">S. No</th>
                                <th class="ttitle">Title</th>
                                <th class="tdesc">Description</th>
                                <th class="taction">Actions</th>
                        </tr>
                </thead>

                <tbody>
                        <?php
        $result = mysqli_query($conn, "SELECT * FROM `notesapp`.`note`");

        $sno=0;
        while($row = mysqli_fetch_array($result))
        {
                $sno++;
                $sn = $row['sno'] + 159;
                echo "<tr>
                        <td><b> $sno </b></td>
                        <td>". $row['title'] ."</td>
                        <td><pre class='pre-desc'>". $row['disc'] ."</pre></td>
                        <td class=bttn><a href=Notes_App.php?i=".$sn."><input type='button' class='edit' value='Edit'></a>
                        <a href=Notes_App.php?di=".$sn."><input type='button' class='delete' value='Delete'></a> </td>
                        </tr>";
        }
?>
                </tbody>
        </table>

</div>

</body>

</html>


