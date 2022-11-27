<?php
    session_start();

    $userData = "";
    if(isset($_SESSION['login'])) {
        if($_SESSION['login'] == 'admin') {
            header("Location:admin.php");
        }else{
            $userData = $_SESSION['login'];
        }
    }
?>
<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Document</title>

<link rel="stylesheet" href="bootstrap-5.2.1-dist/css/bootstrap.css">
<link rel="stylesheet" href="mycss.css">
<style>
    form {
        display: inline;
    } 
</style>
</head>
<body class="black">
    <div class="header">
        <h1 class="title">XX</h1>
        <h1 class="title2">2</h1>
        <div class="buton">
        <ul> 
        <li onclick = "now_playing()" class=" hover-underline-animation">Now Playing</li>
        <li onclick = "upcoming()"  class=" hover-underline-animation">Upcoming</li>
        <li onclick = "showPopup()"  class=" hover-underline-animation">Topup</li>
        <li class=" hover-underline-animation"> <a class="nounder2" href="theater_schedule.php">Theater</a> </li>
      </ul>
        
        </div>

        
        
        <?php 
        if(isset($_SESSION['login'])) {
            echo '<form action = "Controller/controller_member.php" method = "POST"><button class="btn-hover color-7 " name = "logout" type = "submit">logout</button></form>';
        } else {
            echo '<button class="btn-hover color-72"> <a class="nounder" href = "login.php">Login</a></button>';
        }
        ?>

    </div>

    <input type="text" id="id_member" value="<?= empty($userData['id_member']) ? "" : $userData['id_member'] ?>" hidden>

    <div class="main">
        <h5>Search</h5>
        <label>Title : </label> 
        

        
        <div class="search-container">
        <form action="/search" method="get">
            <input class="search expandright" id="search_key" type="search" name="q" placeholder="Search">
            <label class="buttonsearch searchbutton" for="search_key"><span class="mglass">&#9906;</span></label>
        </form>
        </div>
    </div>
    
    <!-- <div id="carouselExampleCaptions" class="carousel slide" data-bs-ride="false">
        <div class="carousel-indicators" id="indicators">
            
        </div>
        <div class="carousel-inner" id="caraousel-ajax">
            
        </div>
        <button class="carousel-control-prev" type="button" data-bs-target="#carouselExampleCaptions" data-bs-slide="prev">
            <span class="carousel-control-prev-icon" aria-hidden="true"></span>
            <span class="visually-hidden">Previous</span>
        </button>
        <button class="carousel-control-next" type="button" data-bs-target="#carouselExampleCaptions" data-bs-slide="next">
            <span class="carousel-control-next-icon" aria-hidden="true"></span>
            <span class="visually-hidden">Next</span>
        </button>
    </div> -->


    <h1 id = 'title'>Title</h1>
    <div id="movie_list"></div>

    <div id="topup_popup" class="popup_container">
        <div class="popup">
            <Button id="closePopup">Close</Button>
            <div class="d-flex flex-wrap w-100">
                <div class="w-33 text-center">
                    <img src="Assets/point.png" class="w-50">
                    <h2>100 Points</h2>
                    <button class="btn btn-primary buy-button" value="100">Buy</button>
                </div>
                <div class="w-33 text-center">
                    <img src="Assets/point.png" class="w-50">
                    <h2>500 Points</h2>
                    <button class="btn btn-primary buy-button" value="500">Buy</button>
                </div>
                <div class="w-33 text-center">
                    <img src="Assets/point.png" class="w-50">
                    <h2>1000 Points</h2>
                    <button class="btn btn-primary buy-button" value="1000">Buy</button>
                </div>
                <div class="w-33 text-center">
                    <img src="Assets/point.png" class="w-50">
                    <h2>1500 Points</h2>
                    <button class="btn btn-primary buy-button" value="1500">Buy</button>
                </div>
                <div class="w-33 text-center">
                    <img src="Assets/point.png" class="w-50">
                    <h2>3000 Points</h2>
                    <button class="btn btn-primary buy-button" value="3000">Buy</button>
                </div>
                <div class="w-33 text-center">
                    <img src="Assets/point.png" class="w-50">
                    <h2>5000 Points</h2>
                    <button class="btn btn-primary buy-button" value="5000">Buy</button>
                </div>
            </div>
        </div>
    </div>

    <div class="modal" tabindex="-1" role="dialog">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Modal title</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <p>Modal body text goes here.</p>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-primary">Save changes</button>
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
            </div>
            </div>
        </div>
    </div>
</body>
</html>

<script src="bootstrap-5.2.1-dist/js/bootstrap.js"></script>
<script src="ajax.js"></script>
<script>
    var is_now_playing = 1;
    var id_member = document.getElementById("id_member").value;

    function refresh(responseNow) {
        var movie_list = document.getElementById('caraousel-ajax');
        var indicators = document.getElementById("indicators");
        movie_list.innerHTML = "";

        var refreshContent = '';
        for(var i=0; i<responseNow.length; i++) {
            var data = "data-bs-slide-to=" + (i) + "";
            if(i == 0){
                data += " Class=active";
            }
            indicators.innerHTML += '<button type="button" data-bs-target="#carouselExampleCaptions" '+ data +'></button>';
        }
        for(var i = 0;i < responseNow.length;i++) {
            var active = "";
            if(i == 0){
                active = " active";
            }
            refreshContent += '<div class="carousel-item' + active + '"' + '>';
                refreshContent += '<img src="Gambar/' + responseNow[i]['image_path'] + '"' + ' class=\"d-block w-100 background-cover\" alt=\"...\">';
                '<div class="carousel-caption d-none d-md-block">';
                    refreshContent += '<h5>' + responseNow[i]['nama_film'] + '</h5>';
                    refreshContent += '<a  href="detail_film.php?id='+responseNow[i]['id_film']+'" class="btn">Detail</a>';
                refreshContent += '</div>';
            refreshContent += '</div>';
        }
        movie_list.innerHTML = refreshContent;
    }

    function refresh(responseNow) {
        var movie_list = document.getElementById('movie_list');
        movie_list.innerHTML = "";

        var refreshContent = '';
        for(var i = 0;i < responseNow.length;i++) {
        refreshContent += '<div class="card" style="width: 18rem;float:left;">';
            refreshContent += '<img width = "200px" height = "300px" class="card-img-top" src="Gambar/' + responseNow[i]['image_path'] +'" alt="'+responseNow[i]['nama_film']+'">';
            refreshContent += '<div class="card-body">';
            refreshContent += '<h5 class="card-title">'+ responseNow[i]['nama_film'] +'</h5>';
            refreshContent += '<a  href="detail_film.php?id='+responseNow[i]['id_film']+' " class="btn ">Detail</a>';
            refreshContent += '</div>';
        refreshContent += '</div>';
        }
        movie_list.innerHTML = refreshContent;
    }

    function now_playing() {
        is_now_playing = 1;
        document.getElementById('title').innerHTML = "Now Playing!";
        var xhttp = new XMLHttpRequest();
        xhttp.onreadystatechange = function() {
            if (this.readyState == 4 && this.status == 200) {
            //summary.innerHTML = summary.innerHTML + xhttp.responseText;
            
            var responseNow = JSON.parse(xhttp.responseText);
            refresh(responseNow);
            }
        };
        xhttp.open("GET", "Controller/controller_film.php?get_current_movie=1"  );
        xhttp.send();
    }

    function upcoming() {
        is_now_playing = 0;
        document.getElementById('title').innerHTML = "Upcoming!";
        var xhttp = new XMLHttpRequest();
        xhttp.onreadystatechange = function() {
            if (this.readyState == 4 && this.status == 200) {
            //summary.innerHTML = summary.innerHTML + xhttp.responseText;
            
            var responseNow = JSON.parse(xhttp.responseText);
            refresh(responseNow);
            }
        };
        xhttp.open("GET", "Controller/controller_film.php?get_upcoming_movie=1"  );
        xhttp.send();
    }

    function search() {
        document.getElementById('title').innerHTML = "Now Playing!";
        var xhttp = new XMLHttpRequest();
        xhttp.onreadystatechange = function() {
            if (this.readyState == 4 && this.status == 200) {
            //summary.innerHTML = summary.innerHTML + xhttp.responseText;
            var responseNow = JSON.parse(xhttp.responseText);
            refresh(responseNow);
            }
        };

        var like_filter = document.getElementById('search_key').value;
        if(is_now_playing == 1) {
        xhttp.open("GET", "Controller/controller_film.php?get_current_movie=1&title_like=" + like_filter   );
        } else if(is_now_playing == 0) {
        xhttp.open("GET", "Controller/controller_film.php?get_upcoming_movie=1&title_like=" + like_filter  );
        }

        xhttp.send();
    }

    function showPopup(){
        if(id_member.length > 0){
            var popup = document.querySelector(".popup_container");
            popup.style.display = "flex";
        }else{
            alert("You must login first");
        }
    }

    function hidePopup(){
        var popup = document.querySelector(".popup_container");
        popup.style.display = "none";
    }

    function processBuyPoints(){
        var data = `saldo=${this.value}&id_member=${id_member}`;
        var crudObject = new CrudObject("Ajax_Folder/point_request.php", data);
        crud(crudObject, buyCallback);
    }

    function buyCallback(){
        alert("Your Request is Waiting For Confirmation");
    }

    document.getElementById("closePopup").addEventListener("click", hidePopup);

    listBuy = document.querySelectorAll(".buy-button");
    for(var i=0; i<listBuy.length; i++){
        listBuy[i].addEventListener("click", processBuyPoints);
    }

    now_playing();


</script>