  <?php
// INSERT INTO `inotes` (`sno`, `title`, `description`, `tstamp`) VALUES (NULL, 'Hii Note!!', 'Hello Heljhskgj KLghskffJHgkuh OUK ZXGHiu U iu IUg iu.', current_timestamp());

                  $insert = NULL;
                  $update = NULL;

                  // Connecting to the Database
                  $servername = "localhost";
                  $username = "root";
                  $password = "";
                  $database = "notesapp";

                  // Create a connection
                  $conn = mysqli_connect($servername, $username, $password, $database);

                  // Die if connection was not successful
                  if (!$conn){
                      die("Sorry we failed to connect: ". mysqli_connect_error());
                  }

                  if(isset($_POST['s']))
                  {
                        // Variables To Be Inserted Into Table
                        $title = $_POST['title'];
                        $desc = $_POST['desc'];

                        if($title != NULL)
                        {
                                // Add A New Trip To The Trip Table In The Database
                                $sql = "INSERT INTO `inotes` (`title`, `description`) VALUES ('$title', '$desc')";
                                $result = mysqli_query($conn, $sql);

                                if($result)
                                {
                                    // echo "The Record Has Been Inserted Successfully.<br>";
                                    $insert = true;
                                }
                                else
                                {
                                    $insert = false;
                                }
                        }
                        else
                        {
                                echo "<script> alert('Please Enter Title');</script>";
                        }

                  }

                  if(isset($_POST['u']))
                  {
                        // Update The Record
                        $sno = $_POST['snoEdit'];
                        $title = $_POST['titleEdit'];
                        $desc = $_POST['descEdit'];

                        if($title != NULL)
                        {
                                // Add A New Trip To The Trip Table In The Database
                                $sql = "UPDATE `inotes` SET `title` = '$title', `description` = '$desc' WHERE `sno` = $sno";
                                $result = mysqli_query($conn, $sql);

                                if($result)
                                {
                                    // echo "The Record Has Been Inserted Successfully.<br>";
                                    $update = true;
                                }
                                else
                                {
                                    $update = false;
                                }
                        }
                  }

?>


<!doctype html>
<html lang="en">

<head>
  <!-- Required meta tags -->
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">

  <!-- Bootstrap CSS -->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta3/dist/css/bootstrap.min.css" rel="stylesheet"
    integrity="sha384-eOJMYsd53ii+scO/bJGFsiCZc+5NDVN2yr8+0RDqr0Ql0h+rP48ckxlpbzKgwra6" crossorigin="anonymous">

  <link rel="stylesheet" href="//cdn.datatables.net/1.10.24/css/jquery.dataTables.min.css">

  <script src="https://code.jquery.com/jquery-3.6.0.js" integrity="sha256-H+K7U5CnXl1h5ywQfKtSj8PCmoN9aaq30gDh27Xc0jk=" crossorigin="anonymous"></script>

  <script src="//cdn.datatables.net/1.10.24/js/jquery.dataTables.min.js"></script>

  <script>

            $(document).ready( function () {
                $('#myTable').DataTable();
            } );

  </script>

  <style>

/* tr th {
    border: solid 1px black;
    border-radius: 3px;
} 

tr td {
    border: solid 1px black;
    border-radius: 3px;
}  */

  </style>

  <title>iNotes - Notes Taking Made Easy</title>

</head>

<body>

  <!-- Edit modal -->
<!-- <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#editModal">
  Edit Modal
</button> -->

<!-- Edit Modal -->
<div class="modal fade" id="editModal" tabindex="-1" aria-labelledby="editModalLable" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="editModalLable">Edit This Note</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        <form action="/crud/index.php" method="POST">

          <input type="hidden" name="snoEdit" id="snoEdit">
          <div class="form-group my-3">
            <label for="title">Note Title</label>
            <input type="text" class="form-control" id="titleEdit" name="titleEdit" aria-describedby="emailHelp">
          </div>    
          <div class="form-group my-3">
            <label for="desc">Note Description</label>
            <textarea class="form-control" id="descEdit" name="descEdit" rows="3"></textarea>
          </div>    
          <button type="submit" name="u" class="btn btn-primary mb-4">Update Note</button> 

        </form>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
        <button type="button" class="btn btn-primary">Save changes</button>
      </div>
    </div>
  </div>
</div>

  <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
    <div class="container-fluid">
      <a class="navbar-brand" href="#">iNotes</a>
      <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent"
        aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
      </button>
      <div class="collapse navbar-collapse" id="navbarSupportedContent">
        <ul class="navbar-nav me-auto mb-2 mb-lg-0">
          <li class="nav-item">
            <a class="nav-link active" aria-current="page"
              href="#">Home</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="#">About</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="#">Contact Us</a>
          </li>
        </ul>
        <form class="d-flex">
          <input class="form-control me-2" type="search" placeholder="Search" aria-label="Search">
          <button class="btn btn-outline-success" type="submit">Search</button>
        </form>
      </div>
    </div>
  </nav>

  <?php

          if(isset($_POST['s']))
          {
                if($insert)
                {
                      echo "<div class='alert alert-success alert-dismissible fade show' role='alert'>
                            <strong>Success!</strong> Your note has been inserted successfully.
                            <button type='button' class='btn-close' data-bs-dismiss='alert' aria-label='Close'></button>
                            </div>";
                }
                else
                {
                      echo "<div class='alert alert-danger alert-dismissible fade show' role='alert'>
                            <strong>Error!</strong> Your note has not inserted.
                            <button type='button' class='btn-close' data-bs-dismiss='alert' aria-label='Close'></button>
                            </div>"; 
                }
          }

          if(isset($_POST['u']))
          {
                if($update)
                {
                      echo "<div class='alert alert-success alert-dismissible fade show' role='alert'>
                            <strong>Success!</strong> Your note has been updated successfully.
                            <button type='button' class='btn-close' data-bs-dismiss='alert' aria-label='Close'></button>
                            </div>";
                }
                else
                {
                      echo "<div class='alert alert-danger alert-dismissible fade show' role='alert'>
                            <strong>Error!</strong> Your note has not updated.
                            <button type='button' class='btn-close' data-bs-dismiss='alert' aria-label='Close'></button>
                            </div>"; 
                }
          }

  ?>

  <div class="container mt-3">
    <h2>Add A Note</h2>

    <form action="/crud/index.php" method="POST">

      <div class="form-group my-3">
        <label for="title">Note Title</label>
        <input type="text" class="form-control" id="title" name="title" aria-describedby="emailHelp">
      </div>

      <div class="form-group my-3">
        <label for="desc">Note Description</label>
        <textarea class="form-control" id="desc" name="desc" rows="3"></textarea>
      </div>

      <button type="submit" name="s" class="btn btn-primary mb-4">Add Note</button>

    </form>
  </div>

  <div class="container my-4">


    <table class="table" id="myTable">
      <thead>
        <tr>
          <th scope="col">S.No</th>
          <th scope="col">Title</th>
          <th scope="col">Description</th>
          <th scope="col">Actions</th>
        </tr>
      </thead>
      <tbody>

        <?php

            $sql = "SELECT * FROM `inotes`";
            $result = mysqli_query($conn, $sql);

            $in=1;
            while($row = mysqli_fetch_assoc($result))
            {
                echo "<tr>
                      <th scope='row'>". $in . "</th>
                      <td>". $row['title']. "</td>
                      <td>". $row['description']. "</td>
                      <td> <button class='edit btn btn-sm btn-primary' id=".$row['sno'].">Edit</button> <button class='delet btn btn-sm btn-primary'>Delet</button> </td>
                      </tr>";
                $in++;
            }

        ?>

      </tbody>
    </table>

  </div>

  <hr>

  <!-- Optional JavaScript; choose one of the two! -->

  <!-- Option 1: Bootstrap Bundle with Popper -->
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta3/dist/js/bootstrap.bundle.min.js"
    integrity="sha384-JEW9xMcG8R+pH31jmWH6WWP0WintQrMb4s7ZOdauHnUtxwoG2vI5DkLtS3qm9Ekf"
    crossorigin="anonymous"></script>

  <!-- Option 2: Separate Popper and Bootstrap JS -->
  <!--
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.1/dist/umd/popper.min.js" integrity="sha384-SR1sx49pcuLnqZUnnPwx6FCym0wLsk5JZuNx2bPPENzswTNFaQU1RDvt3wT4gWFG" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta3/dist/js/bootstrap.min.js" integrity="sha384-j0CNLUeiqtyaRmlzUHCPZ+Gy5fQu0dQ6eZ/xAww941Ai1SxSY+0EQqNXNE6DZiVc" crossorigin="anonymous"></script>
    -->
    <script>

        edits = document.getElementsByClassName('edit');
        Array.from(edits).forEach((element)=>{
          element.addEventListener("click", (e)=>{
          console.log("edit", );
          tr = e.target.parentNode.parentNode;
          title = tr.getElementsByTagName("td")[0].innerText;
          description = tr.getElementsByTagName("td")[1].innerText;
          console.log(title, description);
          titleEdit.value = title;          
          descEdit.value = description;
          snoEdit.value = e.target.id;
          console.log(e.target.id);
          $('#editModal').modal('toggle');
          }) 
        })

    </script>
</body>

</html>