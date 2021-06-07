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
$id= $_GET['threadid'];
$sql= "SELECT * FROM `threads` WHERE `thread_id`= $id";
$result= mysqli_query($conn, $sql);
while($row= mysqli_fetch_assoc($result)){
    $title= $row['thread_title'];
    $desc= $row['thread_desc'];
    $thread_user_id= $row['thread_user_id'];
      
    //query the user
    $sql2= "SELECT user_email FROM `users` WHERE sno ='$thread_user_id'";
    $result2= mysqli_query($conn, $sql2);
    $row2= mysqli_fetch_assoc($result2);
    $posted_by= $row2['user_email'];
}
?>

<?php
        $showAlert= false;
        $method= $_SERVER['REQUEST_METHOD'];
        if($method== 'POST'){

    //INSERT INTO COMMENT DB
    $comment= $_POST['comment'];
    $comment= str_replace("<",  "&lt;", $comment);
    $comment= str_replace(">", "&gt;", $comment);
    $sno = $_POST['sno'];
    $sql= "INSERT INTO `comments` (`comment_content`, `thread_id`, `comment_by`, `comment_time`) VALUES ('$comment', '$id',  '$sno' , current_timestamp())";
    $result= mysqli_query($conn, $sql);
    $showAlert= true;
    if($showAlert){
       echo '<div class="alert alert-success alert-dismissible fade show" role="alert">
  <strong>SUCCESS!</strong> Thank you! Your comment added successfully.
  <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
</div>';

    }

}
?>

    <div class="container my-4">
        <div class="jumbotron">
            <h1 class="display-4"><?php echo $title; ?></h1>
            <p class="lead"> <?php echo $desc; ?> </p>
            <hr class="my-4">
            <p>This is a peer to peer forum. For sharing knowledge with each other.</p>
            <p><b>Posted by: <em><?php echo $posted_by; ?></em></p></b>
        </div>
    </div>

<?php

if(isset($_SESSION['loggedin']) && $_SESSION['loggedin']== true){
echo'
    <div class="container">
        <h1 class="py-2">Post a comment.</h1>
        <form action="'. $_SERVER["REQUEST_URI"] . '" method="post">
            <div class="mb-3">
                <label for="exampleFormControlTextarea1" class="form-label">Post solution</label>
                <textarea class="form-control" id="comment" name="comment" rows="3"></textarea>
             <input type= "hidden" name="sno" value= "' .$_SESSION['sno']. '">
                </div>
            <button type="submit" class="btn btn-success my-3">Submit</button>
        </form>
    </div>';
}
else{
    echo'
    <div class="container">
    <h1 class="py-2">Post a comment.</h1> 
       <p class="lead">You are not logged in. Please login to be able to post a comment.</p>
    </div>
    ';
}
?>
    <div class="container" id="thread">
        <h1 class="py-2">Solved Queries</h1>
 
    <?php
       $id= $_GET["threadid"];
       $sql= "SELECT * FROM `comments` WHERE thread_id= $id";
       $result= mysqli_query($conn, $sql);
       $noResult= true;   
       
       while($row= mysqli_fetch_assoc($result)){
           $noResult= false;
           $id= $row['comment_id'];
           $content= $row['comment_content'];  
           $current_time= $row['comment_time']; 
           $thread_user_id= $row['comment_by'];

           $sql2= "SELECT user_email FROM `users` WHERE sno ='$thread_user_id'";
           $result2= mysqli_query($conn, $sql2);
           $row2= mysqli_fetch_assoc($result2);
           echo'
           <div class="d-flex my-3">
           <div class="flex-shrink-0">
               <img src="img/avatar.png" width= 65px alt="...">
           </div>
           <div class="flex-grow-1 ms-3">
           <p><b>'. $row2['user_email'] .'  </b>'. $current_time .'--</b>'. $content .'</p>
           </div>
       </div>';

    }
    if($noResult){ 
        echo '<div class="alert alert-danger" role="alert">
        <h2>NO COMMENTS FOUND! </h2><br>
        Be the first one to post a query!
      </div>';
    }
?>

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