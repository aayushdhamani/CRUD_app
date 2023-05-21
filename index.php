<!-- INSERT INTO `notes` (`sno`, `title`, `description`, `TimeStamp`) VALUES (NULL, 'buy fruits', 'I want to buy fruits for eating', current_timestamp()); -->

<?php
$insert=false;
$update=false;
$delete=false;
    $server_nmae="localhost";
    $user_name="root";
    $password="";
    $database="notes";

    $conn=mysqli_connect($server_nmae,$user_name,$password,$database);
    if(!$conn){
      die("connection is not successfulyy:". mysqli_connect_error());
    }
    
    if(isset($_GET['delete'])){
      $sno=$_GET['delete'];
      $delete=true;
      $sql="DELETE FROM `notes` WHERE `sno`='$sno'";
      $result=mysqli_query($conn,$sql);
    }
    if($_SERVER['REQUEST_METHOD']=='POST'){
      if(isset($_POST['snoEdit'])){
        $sno=$_POST["snoEdit"];
        $title=$_POST["edittitle"];
        $description=$_POST["editdescription"];
     
        $sql="UPDATE `notes` SET `title` = ' $title' , `description` = ' $description' WHERE `notes`.`sno` = $sno;";
        $result=mysqli_query($conn,$sql);
        if($result){
         $update=true;
        }
        else{
            echo "Not updated successfully because of ".mysqli_error($conn);
        }
      }
      
      else{
        
        $title=$_POST["title"];
        $description=$_POST["description"];
        $sql="INSERT INTO `notes` ( `title`, `description`) VALUES ('$title', ' $description')";
   
    $result=mysqli_query($conn,$sql);
    if($result){
      $insert=true;
    }
    else{
        echo "Not Inserted successfully because of ".mysqli_error($conn);
    }
    }
  }
    ?>

<!doctype html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>iNotes-notes making made easy</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css" rel="stylesheet"
    integrity="sha384-KK94CHFLLe+nY2dmCWGMq91rCGa5gtU4mk92HdvYe+M/SXH301p5ILy+dN9+nJOZ" crossorigin="anonymous">

  <link rel="stylesheet" href="//cdn.datatables.net/1.13.4/css/jquery.dataTables.min.css">

  <script src="https://code.jquery.com/jquery-3.6.4.js" integrity="sha256-a9jBBRygX1Bh5lt8GZjXDzyOB+bWve9EiO7tROUtj/E="
    crossorigin="anonymous"></script>


</head>

<body>
  <!-- edit modal -->
  <!-- <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#editModal">
  Edit Modal
</button> -->

  <!-- edit Modal -->
  <div class="modal fade" id="editModal" tabindex="-1" aria-labelledby="editModalLabel" aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <h1 class="modal-title fs-5" id="editModalLabel">Edit this Note</h1>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
          <form action="/CRUD/index.php" method="post">
            <input type="hidden" name="snoEdit" id="snoEdit">

            <div class="mb-3">
              <label for="title" class="form-label">Note Title</label>
              <input type="text" class="form-control" id="edittitle" name="edittitle" aria-describedby="emailHelp">

            </div>
            <div class="mb-3">
              <label for="description" class="form-label">Note description</label>
              <textarea class="form-control" name="editdescription" id="editdescription" cols="30" rows="10"></textarea>

            </div>


            
        </div>
        <div class="modal-footer d-block mr-auto">
          <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
          <button type="submit" class="btn btn-primary">Save changes</button>
        </div>
        </form>
      </div>
    </div>
  </div>


  <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
    <div class="container-fluid">
      <a class="navbar-brand" href="#"><img src="/CRUD/php.svg" alt=""></a>
      <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent"
        aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
      </button>
      <div class="collapse navbar-collapse" id="navbarSupportedContent">
        <ul class="navbar-nav me-auto mb-2 mb-lg-0">
          <li class="nav-item">
            <a class="nav-link active" aria-current="page" href="#">Home</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="#">About</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="#">Conatct Us</a>
          </li>

        </ul>


        <form class="d-flex" role="search">
          <input class="form-control me-2" type="search" placeholder="Search" aria-label="Search">
          <button class="btn btn-outline-success" type="submit">Search</button>
        </form>
      </div>
    </div>
  </nav>
  <?php
if($insert){
  echo '<div class="alert alert-success alert-dismissible fade show" role="alert">
  <strong>success!</strong> Your note has been submitted successfully!
  <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
</div>';
}
if($update){
  echo '<div class="alert alert-success alert-dismissible fade show" role="alert">
  <strong>success!</strong> Your note has been submitted successfully!
  <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
</div>';
}
if($delete){
  echo '<div class="alert alert-success alert-dismissible fade show" role="alert">
  <strong>success!</strong> Your note has been deleted successfully!
  <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
</div>';
}

?>
  <div class="container my-3">
    <form action="/CRUD/index.php" method="post">
      <h2>Add a note</h2>
      <div class="mb-3">
        <label for="title" class="form-label">Note Title</label>
        <input type="text" class="form-control" id="title" name="title" aria-describedby="emailHelp">

      </div>
      <div class="mb-3">
        <label for="description" class="form-label">Note description</label>
        <textarea class="form-control" name="description" id="description" cols="30" rows="10"></textarea>

      </div>


      <button type="submit" class="btn btn-primary my-3">Add note</button>
    </form>

  </div>
  <div class="container my-3">

    <table class="table" id="myTable">
      <thead>
        <tr>
          <th scope="col">Sno</th>
          <th scope="col">title</th>
          <th scope="col">description</th>
          <th scope="col">Action</th>
        </tr>
      </thead>
      <tbody>

        <?php
   $sql="SELECT * FROM `notes`";
   $result=mysqli_query($conn,$sql);
   $no=1;
   while($row=mysqli_fetch_assoc($result)){
    echo "<tr>
      <th scope='row'>". $no ."</th>
      <td>".$row['title']."</td>
      <td>".$row['description']."</td>
      <td><button class='edit btn btn-sm btn-primary' id=" .$row['sno']. ">Edit</button> <button class='delete btn btn-sm btn-primary' id=d" .$row['sno']. ">Delete</button></td>
    </tr>";
    $no++;
    
  }
   ?>
      </tbody>
    </table>
    <hr>
  </div>

  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/js/bootstrap.bundle.min.js"
    integrity="sha384-ENjdO4Dr2bkBIFxQpeoTz1HIcje39Wm4jDKdf19U8gI4ddQ3GYNS7NTKfAdVQSZe"
    crossorigin="anonymous"></script>
  <script src="//cdn.datatables.net/1.13.4/js/jquery.dataTables.min.js"></script>

  <script>

    let table = new DataTable('#myTable');
  </script>
  <script>
    edits = document.getElementsByClassName('edit');
    Array.from(edits).forEach((element) => {
      element.addEventListener("click", (e) => {
        console.log("edit");
        tr = e.target.parentNode.parentNode;
        title = tr.getElementsByTagName("td")[0].innerText;
        description = tr.getElementsByTagName("td")[1].innerText;
        console.log(title, description);
        edittitle.value = title;
        editdescription.value = description;
        snoEdit.value = e.target.id;
        console.log(e.target.id);
        $('#editModal').modal('toggle');

      })
    })
    deletes = document.getElementsByClassName('delete');
    Array.from(deletes).forEach((element) => {
      element.addEventListener("click", (e) => {
        sno = e.target.id.substr(1,);

        if (confirm("are you sure to delete it!")) {
          console.log("yes");
          window.location = `/crud/index.php?delete=${sno}`;
        }
        else {
          console.log("No");
        }

      })
    })



  </script>
</body>

</html>