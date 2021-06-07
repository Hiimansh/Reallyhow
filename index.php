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
    #thread {
        min-height: 450px;
    }
    </style>
    <title>CODE-HUL</title>
</head>

<body>
    <?php include 'partials/dbconnect.php';?>
    <?php include 'partials/header.php';?>
    

    <!-- Slider -->
    <div id="carouselExampleControls" class="carousel slide" data-bs-ride="carousel">
        <div class="carousel-inner">
            <div class="carousel-item active">
                <img src="https://source.unsplash.com/2400x700/?coding,code" class="d-block w-100" alt="...">
            </div>
            <div class="carousel-item">
                <img src="https://source.unsplash.com/2400x700/?programmer,microsoft" class="d-block w-100" alt="...">
            </div>
            <div class="carousel-item">
                <img src="https://source.unsplash.com/2400x700/?coding,apple" class="d-block w-100" alt="...">
            </div>
        </div>
        <button class="carousel-control-prev" type="button" data-bs-target="#carouselExampleControls"
            data-bs-slide="prev">
            <span class="carousel-control-prev-icon" aria-hidden="true"></span>
            <span class="visually-hidden">Previous</span>
        </button>
        <button class="carousel-control-next" type="button" data-bs-target="#carouselExampleControls"
            data-bs-slide="next">
            <span class="carousel-control-next-icon" aria-hidden="true"></span>
            <span class="visually-hidden">Next</span>
        </button>
    </div>
    <!-- Category container -->
    <div class="container my-4" id= "thread">
        <h2 class="text-center my-4">Welcome to CODE-hul- Browse Categories</h2>
    <div class="row mx-4">
        <!-- fetch all the categories -->

        <!-- use a loop to iterate the categories -->
        <?php
     $sql= "SELECT * FROM `category`";
     $result= mysqli_query($conn, $sql);
     while($row= mysqli_fetch_assoc($result)){
        //  echo $row['category_id'];
        //  echo $row['category_name'];
        $cat= $row['category_name'];
        $id= $row['category_id'];
        $desc= $row['category_description'];
        echo '<div class="col-md-4 my-2">
        <div class="card" style="width: 18rem;">
            <img src="https://source.unsplash.com/500x400/?' .$cat. ',coding" class="card-img-top" alt="...">
            <div class="card-body">
                <h5 class="card-title"><a href= "threadlist.php?catid=' .$id. '"> ' .$cat. '</a></h5>
                <p class="card-text">'.substr($desc, 0, 90). '...</p>
                <a href="threadlist.php?catid=' .$id. '" class="btn btn-primary">View Threads</a>
            </div>
        </div>
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