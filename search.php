<!doctype html>
<html lang="en">

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.1/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-+0n0xVW2eSR5OomGNYDnhzAbDsOXxcvSN1TPprVMTNDbiYZCxYbOOl7+AMvyTG2x" crossorigin="anonymous">


    <style>
    #maincontainer {
        min-height: 100vh;
    }
    </style>
    <title>CODE-HUL</title>
</head>

<body>
    <?php include 'partials/dbconnect.php';?>
    <?php include 'partials/header.php';?>





    <!--SEARCH RESULTS -->
    <div class="container my-3" id="maincontainer">
        <h1 class="py-3"> Search results for <em>"<?php echo $_GET['search'] ?>" </em></h1>
    <?php

    $noresults = true;
    $query=  $_GET["search"];
    
    $sql= "SELECT * FROM `threads` WHERE match (thread_title, thread_desc) against ('$query')";
    $result= mysqli_query($conn, $sql);
    echo var_dump($result);
    
    while($row= mysqli_fetch_assoc($result)){
    $title= $row['thread_title'];
    $desc= $row['thread_desc'];
    $thread_id= $row['thread_id'];
    $url = "thread.php?threadid=". $thread_id;
    $noresults = false;

// Display the search result
        echo '<div class="result">
        <h3><a href="'. $url. '" class="text-dark">'. $title. '</a> </h3>
        <p>'. $desc .'</p>
        </div>'; 
        }
        if ($noresults){
        echo '<div class="jumbotron jumbotron-fluid">
        <div class="container">
        <p class="display-4">No Results Found</p>
        <p class="lead"> Suggestions: <ul>
                <li>Make sure that all words are spelled correctly.</li>
                <li>Try different keywords.</li>
                <li>Try more general keywords. </li></ul>
        </p>
        </div>
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