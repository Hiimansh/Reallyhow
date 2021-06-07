<!doctype html>
<html lang="en">

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.1/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-+0n0xVW2eSR5OomGNYDnhzAbDsOXxcvSN1TPprVMTNDbiYZCxYbOOl7+AMvyTG2x" crossorigin="anonymous">

    <title>CODE-HUL</title>
    <style>
    #thread {
        min-height: 450px;
    }
    </style>
</head>

<body>
    <?php include 'partials/dbconnect.php';?>
    <?php include 'partials/header.php';?>

    <?php
$id= $_GET['catid'];
$sql= "SELECT * FROM `category` WHERE `category_id`= $id";
$result= mysqli_query($conn, $sql);
while($row= mysqli_fetch_assoc($result)){
    $catname= $row['category_name'];
    $catdesc= $row['category_description'];
}
?>

    <?php
        $showAlert= false;
        $method= $_SERVER['REQUEST_METHOD'];
        if($method== 'POST'){
    //INSERT THREAD INTO DB
    $th_title= $_POST['title'];
    $th_desc= $_POST['desc'];

    $th_title= str_replace("<",  "&lt;", $th_title);
    $th_title= str_replace(">", "&gt;",$th_title );

    $th_desc= str_replace("<",  "&lt;",  $th_desc);
    $th_desc= str_replace(">", "&gt;", $th_desc );

    $sno = $_POST['sno'];
    $sql= "INSERT INTO `threads` (`thread_title`, `thread_desc`, `thread_cat_id`, `thread_user_id`, `timestamp`) VALUES ('$th_title', '$th_desc', '$id', '$sno', current_timestamp())";
    $result= mysqli_query($conn, $sql);
    $showAlert= true;
    if($showAlert){
       echo '<div class="alert alert-success alert-dismissible fade show" role="alert">
  <strong>SUCCESS!</strong> Your query has been submitted please wait while our community respond to your query.
  <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
</div>';

    }

}
?>

    <div class="container my-4">
        <div class="jumbotron">
            <h1 class="display-4">Welcome to <?php echo $catname; ?> Forum</h1>
            <p class="lead"> <?php echo $catdesc; ?> </p>
            <hr class="my-4">
            <p>This is a peer to peer forum. For sharing knowledge with each other.</p>
            <a class="btn btn-success btn-lg" href="#" role="button">Learn more</a>
        </div>
    </div>

    <?php

    if(isset($_SESSION['loggedin']) && $_SESSION['loggedin']== true){
  
    echo'<div class="container">
            <h1 class="py-2">Start your Questions.</h1>
            <form action="'. $_SERVER["REQUEST_URI"] . '" method="post">
        <div class="mb-3">
            <label for="exampleInputEmail1" class="form-label">Query Title</label>
            <input type="text" class="form-control" id="title" name="title" aria-describedby="emailHelp">
        <div id="emailHelp" class="form-text">Please use appropriate keywords.</div>
    </div>
    <input type= "hidden" name="sno" value= "' .$_SESSION["sno"]. '">
    <div class="mb-3">
        <label for="exampleFormControlTextarea1" class="form-label">Query-(In detail)</label>
        <textarea class="form-control" id="desc" name="desc" rows="3"></textarea>
    </div>
    <button type="submit" class="btn btn-success my-3">Submit</button>
    </form>
    </div>
    
        ';
}
        else{
            echo'
            <div class="container">
            <h1 class="py-2">Start a Discussion</h1> 
               <p class="lead">You are not logged in. Please login to be able to start a Discussion</p>
            </div>
            ';
        }

        ?>

        <div class="container" id="thread">
        <h1 class="py-2">Browse Questions</h1>

        <?php
       $id= $_GET['catid'];
       $sql= "SELECT * FROM `threads` WHERE `thread_cat_id`= $id";
       $result= mysqli_query($conn, $sql);
       $noResult= true;
       while($row= mysqli_fetch_assoc($result)){
        $noResult= false;   
           $id= $row['thread_id'];
           $title= $row['thread_title'];
           $desc= $row['thread_desc'];
           $thread_time= $row['timestamp'];
           $thread_user_id= $row['thread_user_id'];
           $sql2= "SELECT user_email FROM `users` WHERE sno ='$thread_user_id'";
           $result2= mysqli_query($conn, $sql2);
           $row2= mysqli_fetch_assoc($result2);
           
           
           echo'
        <div class="d-flex my-3">
            <div class="flex-shrink-0">
                <img src="img/avatar.png" width= 65px alt="...">
            </div>'.
           ' <div class="flex-grow-1 ms-3">
            <h5><a class="text-dark" href="thread.php?threadid=' .$id. '">'. $title .' </a></h5>
            '. $desc .' <p>Asked By: <b> '. $row2['user_email'] .' at '. $thread_time .'--</b>
            </p>
            </div>'.
        '</div>';

       }
        if($noResult){
            echo '<div class="alert alert-primary" role="alert">
            <h2>NO THREADS FOUND! </h2><br>
            Be the first one to post a comment!
          </div>';
        }


    
?>
    </div>

    </div>


    <?php
   include 'partials/footer.php';
   ?>

    <!-- Optional JavaScript; choose one of the two! -->

    <!-- Option 1: Bootstrap Bundle with Popper -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.1/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-gtEjrD/SeCtmISkJkNUaaKMoLD0//ElJ19smozuHV6z3Iehds+3Ulb9Bn9Plx0x4" crossorigin="anonymous">
    </script>

    <!-- Option 2: Separate Popper and Bootstrap JS -->
    <!--
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js" integrity="sha384-IQsoLXl5PILFhosVNubq5LC7Qb9DXgDA9i+tQ8Zj3iwWAwPtgFTxbJ8NT4GN1R8p" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.1/dist/js/bootstrap.min.js" integrity="sha384-Atwg2Pkwv9vp0ygtn1JAojH0nYbwNJLPhwyoVbhoPwBhjQPR5VtM2+xf0Uwh9KtT" crossorigin="anonymous"></script>
    -->
</body>

</html>