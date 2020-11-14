<?php 
$insert = false;
$update= false;
$delete= false;
//INSERT INTO `notes` (`sno`, `title`, `description`, `tstamp`) VALUES ('1', 'eat food', 'eat food and delete this task', current_timestamp());
$servername = "localhost";
$username = "root";
$password = "";
$database = "notes";

// Create a connection
$conn = mysqli_connect($servername, $username, $password, $database);

// Die if connection was not successful
if (!$conn){
    die("Sorry we failed to connect: ". mysqli_connect_error());
  //error handling in php 
  }

if(isset($_GET['delete'])){ //agar url ma delte set ha
  $sno = $_GET['delete'];//yani delete url se mangwa rha
  $sql = "DELETE FROM `notes` WHERE `sno` = $sno ";
  $result = mysqli_query($conn, $sql);
  if($result){
    $delete = true;
  }

}

if($_SERVER['REQUEST_METHOD']== "POST"){

  if(isset( $_POST['snoEdit'])){

    $sno = $_POST["snoEdit"];
    $title = $_POST["titleEdit"];
    $description = $_POST["descriptionEdit"];

   $sql =  "UPDATE `notes` SET `title` = '$title', `description` = '$description' WHERE `notes`.`sno` = $sno";
   $result = mysqli_query($conn , $sql);
   if($result){
    $update = true;
  }


  }



  else{
    $title = $_POST["title"];
    $description = $_POST["description"];
  
    $sql = "INSERT INTO `notes` (`title`,`description`) VALUES ('$title', '$description')";
    $result = mysqli_query($conn , $sql);
  
    if($result){
      $update = true;
    }

  }
  
}

?>
<!doctype html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
    <link rel="stylesheet" href="//cdn.datatables.net/1.10.20/css/jquery.dataTables.min.css">

    <title>PHP CURD APP MyTask </title>
  </head>

<div class="modal fade" id="editModal" tabindex="-1" role="dialog" aria-labelledby="editModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="editModalModalLabel">Edit Task</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <form action="/work/crud.php"  method="POST">
      <div class="modal-body">
        <input type="hidden" name="snoEdit" id="snoEdit"> 
          <!-- //hidden input tag ha isme sno leke arhe ham or phr uss sno ko use krke db ma rec update krenge    -->
          <div class="form-group">
            <label for="title">Task Title</label>
            <input type="text" id="titleEdit" name="titleEdit" class="form-control" aria-describedby="emailHelp" placeholder="Enter Your Task">
          </div>
          <div class="form-group">
            <label for="desc">Task Description</label>
              <textarea class="form-control" id="descriptionEdit" name="descriptionEdit" rows="3"></textarea>
            </div>
          <!-- <button type="submit" class="btn btn-primary">Update Task</button> -->
          
        </div>
        <div class="modal-footer d-block mr-auto">
          <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
          <button type="submit" class="btn btn-primary">Save changes</button>
        </div>
      </form>
    </div>
  </div>
</div>
    <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
        <a class="navbar-brand" href="#">MyTask - CRUD</a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
          <span class="navbar-toggler-icon"></span>
        </button>
      
        <div class="collapse navbar-collapse" id="navbarSupportedContent">
          <ul class="navbar-nav mr-auto">
            <li class="nav-item active">
              <a class="nav-link" href="#">Home <span class="sr-only">(current)</span></a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="#">Link</a>
            </li>
            <li class="nav-item dropdown">
              <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                Dropdown
              </a>
              <div class="dropdown-menu" aria-labelledby="navbarDropdown">
                <a class="dropdown-item" href="#">Action</a>
                <a class="dropdown-item" href="#">Another action</a>
                <div class="dropdown-divider"></div>
                <a class="dropdown-item" href="#">Something else here</a>
              </div>
            </li>
            <li class="nav-item">
              <a class="nav-link disabled" href="#" tabindex="-1" aria-disabled="true">Disabled</a>
            </li>
          </ul>
          <form class="form-inline my-2 my-lg-0">
            <input class="form-control mr-sm-2" type="search" placeholder="Search" aria-label="Search">
            <button class="btn btn-outline-success my-2 my-sm-0" type="submit">Search</button>
          </form>
        </div>
      </nav>

      <?php 
      if($insert){
        echo "      <div class='alert alert-warning alert-dismissible fade show' role='alert'>
        <strong>Success!</strong> Your task has been inserted successfully.
        <button type='button' class='close' data-dismiss='alert' aria-label='Close'>
          <span aria-hidden='true'>&times;</span></div>
        </button>";
      }
      
    
      ?>
  <?php 
      if($update){
        echo "      <div class='alert alert-warning alert-dismissible fade show' role='alert'>
        <strong>Success!</strong> Your task has been updtaed successfully.
        <button type='button' class='close' data-dismiss='alert' aria-label='Close'>
          <span aria-hidden='true'>&times;</span></div>
        </button>";
      }
      
    
      ?>
        <?php 
      if($delete){
        echo "      <div class='alert alert-warning alert-dismissible fade show' role='alert'>
        <strong>Success!</strong> Your task has been delete successfully.
        <button type='button' class='close' data-dismiss='alert' aria-label='Close'>
          <span aria-hidden='true'>&times;</span></div>
        </button>";
      }
      
    
      ?>
      <div  class="container my-4">
        <h2>Add a Task</h2>
        <form action="/work/crud.php"  method="POST">
         <div class="form-group">
              <label for="title">Task Title</label>
              <input type="text" id="title" name="title" class="form-control" aria-describedby="emailHelp" placeholder="Enter Your Task">
            </div>
            <div class="form-group">
              <label for="desc">Task Description</label>
                <textarea class="form-control" id="description" name="description" rows="3"></textarea>
                <br>
            <button type="submit" class="btn btn-primary">Add Task</button>
              </div>
          </form>

      </div>
      <div class="container">



<table class="table" id="myTable">
  <thead>
    <tr>
      <th scope="col">S.No</th>
      <th scope="col">Title</th>
      <th scope="col">Description</th>
      <th scope="col">Action</th>
    </tr>
  </thead>
  <tbody>

    <?php 
        $sql = "SELECT * FROM `notes`";
        $result = mysqli_query($conn, $sql);
        $sno = 0;
        while($row = mysqli_fetch_assoc($result)){
          $sno = $sno + 1;
            echo"
          <tr>

            <th scope='row'>". $sno ."</th>
            <td>". $row['title'] ."</td>
            <td>". $row['description'] ."</td>
            <td> <button class='edit btn btn-sm btn-primary' id=".$row['sno'].">Edit</button>
                  <button class='delete btn btn-sm btn-primary' id=d".$row['sno'].">Delete</button>
            </td>  

          </tr>";
            //id dedi yhan pe ab iss button  pe jab p click krnga 
            //tu database wala sno generate huga id ma or uski madad se record update kr skunga

         // echo $row['sno'] . " .Title ". $row['title']. " Desc is " .$row['description']."<br>";
        
        }

        ?>
  </tbody>
</table>

      </div>




    <!-- Optional JavaScript -->
    
    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
    <script>
        if ( window.history.replaceState ) {
  window.history.replaceState( null, null, window.location.href );
}

    </script>
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
    <script src="//cdn.datatables.net/1.10.20/js/jquery.dataTables.min.js"></script>
  <script>
    $(document).ready(function () {
      $('#myTable').DataTable();

    });
  </script>

  <script>
    edits = document.getElementsByClassName('edit');//table ma mery pas bht se edit button ha har record ka apna edit ha
    Array.from(edits).forEach((element)=>{ //ab mene saarey edit button ko array ma store krwadya or uspe ek loop chala dya 
    //unpe for each loop laga dya ab har ek array ke item ko menen element kehdya
      element.addEventListener("click",(e)=>{ //ab ma uss particular btn pe click krke samaan mangwaunga
      //samaan ki location uss particular edit button ke parent ke parent ma ha
          //console.log("edit",e.target.parentNode.parentNode);
          tr =  e.target.parentNode.parentNode;
          title = tr.getElementsByTagName('td')[0].innerText;
          description = tr.getElementsByTagName('td')[1].innerText;
          console.log(title,description);
          snoEdit.value = e.target.id; //sno mangwa rha taake wu specific record update b kr skun data base ma
          console.log(e.target.id);
          titleEdit.value = title;
          descriptionEdit.value = description;
          $('#editModal').modal('toggle')


      })
    })

    deletes = document.getElementsByClassName('delete');//table ma mery pas bht se edit button ha har record ka apna edit ha
    Array.from(deletes).forEach((element)=>{ //ab mene saarey edit button ko array ma store krwadya or uspe ek loop chala dya 
    //unpe for each loop laga dya ab har ek array ke item ko menen element kehdya
      element.addEventListener("click",(e)=>{ //ab ma uss particular btn pe click krke samaan mangwaunga
      //samaan ki location uss particular edit button ke parent ke parent ma ha
          //console.log("edit",e.target.parentNode.parentNode);
          sno = e.target.id.substr(1); //kio ke del ke btn ma iski id ma dsno ha tu jab wu db se sno uthaega or 
          //phr d ke saat concatenate krega id ko or wu iss trh hujeagi like d1
          // as del btn ki id "d.($sno)." ha bcz ".$sno" hame pehle edit ma dechuke or 2 id same ni huti islye d use kia
          if(confirm("Are you sure you want to delete")){
            console.log("yes");
            window.location = `/work/crud.php?delete=${sno}`; //template literal 
          }
          else{
            console.log("No");
          }


      })
    })
  </script>
  
  
  </body>

</html>