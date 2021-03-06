<!DOCTYPE html>
<html lang="en">
<head>
	<title>LIBRARY MANAGEMENT</title>
	<meta charset="UTF-8">
	<meta name="description" content="Library Management Template">
	<meta name="keywords" content="webuni, education, creative, html">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<!-- Favicon -->   
	<link href="img/favicon.ico" rel="shortcut icon"/>

	<!-- Google Fonts -->
	<link href="https://fonts.googleapis.com/css?family=Raleway:400,400i,500,500i,600,600i,700,700i,800,800i" rel="stylesheet">

	<!-- Stylesheets -->
	<link rel="stylesheet" href="css/bootstrap.min.css"/>
	<link rel="stylesheet" href="css/font-awesome.min.css"/>
	<link rel="stylesheet" href="css/owl.carousel.css"/>
	<link rel="stylesheet" href="css/style.css"/>


	<!--[if lt IE 9]>
	  <script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
	  <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
	<![endif]-->
	
	<style>
	th{
	color: white;
	}
	
	td{
	color: white;
	}
	
	p{
	color: white;
	}

	</style>
	
</head>
<body>
	<!-- Page Preloder -->
	<div id="preloder">
		<div class="loader"></div>
	</div>

	<!-- Header section -->
    <header class="header-section">
        <div class="container">
            <div class="row">
                <div class="col-lg-3 col-md-3">
                    <div class="site-logo">
                    <nav class="main-menu">
                        <ul>
                        <li><a style="font-size:40px" href="index.html"><font color="white">Lib</font><font color="red">Uni</font></a></li>
                        </ul>
                    </nav>
                    </div>
                    <div class="nav-switch">
                        <i class="fa fa-bars"></i>
                    </div>
                </div>
                <div class="col-lg-9 col-md-9">
                    <nav class="main-menu">
                        <ul>
                            <li><a style="font-size:25px" href="index.html">Home</a></li>
							<li><a style="font-size:25px" href="viewprofile.html">Profile</a></li>
                            <li><a style="font-size:25px" href="rentbook.html">Borrow Book</a></li>
                            <li id="link"></li>
                        </ul>
                    </nav>
                </div>
            </div>
        </div>
    </header>
    <!-- Header section end -->


    <!-- Page info -->
    <div class="page-info-section set-bg" data-setbg="img/page-bg/1.jpg">
        <div class="container">
            <div class="site-breadcrumb">
                <h1 style="color:white" >All Borrowed Books</h1>
            </div>
        </div>
    </div>
    <!-- Page info end -->

	<!-- search section -->
	<section class="search-section ss-other-page">
		<div class="container">
			<div class="search-warp">
				<div class="section-title text-white">
					<h2><span>List of books</span></h2>
				</div>
				<div class="row">
					<div class="col-lg-10 offset-lg-1">
						<!-- search form -->
						<table class="table">
							<thead>
							  <tr>
								<th>ID</th>
								<th>Title</th>
								<th>Author</th>
								<th>About</th>
								<th>Rented Date</th>
								<th>Return Date</th>
							  </tr>
							</thead>
							<tbody id="rows">
						</tbody>
					  </table>
					</div>
				</div>
				<div class="row">
					<div class="col-lg-10 offset-lg-1">
					
				</div>
				</div>
				<div class="row">
					<div class="col-lg-10 offset-lg-1">
					<p id="singlebook"></p>
					</div>
					</div>
			</div>
		</div>
	</section>
	<!-- search section end -->


<!-- footer section -->
	<footer class="footer-section spad pb-0">
		<div class="footer-top">
			<div class="footer-warp">
				<div class="row">
					<div class="widget-item">
						<h4>Contact Info</h4>
						<ul class="contact-list">
							<li>232, Jalan Tun Razak, Titiwangsa, 50572 Kuala Lumpur, Wilayah Persekutuan Kuala Lumpur</li>
							<li> 03-2687 1700</li>
							<li>libuni@gmail.com</li>
						</ul>
					</div>
					<div class="widget-item">
						<h4>LibUni</h4>
						<ul>
							<li><a href=""></a>Rent Book</li>
							<li><a href="">View Book</a></li>
						</ul>
					</div>
				</div>
			</div>
		</div>
		<div class="footer-bottom">
			<div class="footer-warp">
				<ul class="footer-menu">
		
				</ul>
			</div>
		</div>
	</footer> 
	<!-- footer section end -->


	<!--====== Javascripts & Jquery ======-->
	<script src="js/jquery-3.2.1.min.js"></script>
	<script src="js/bootstrap.min.js"></script>
	<script src="js/mixitup.min.js"></script>
	<script src="js/circle-progress.min.js"></script>
	<script src="js/owl.carousel.min.js"></script>
	<script src="js/main.js"></script>
	
	<script>  
			$(document).ready(function () {
				
				$("#link").append('<a style="font-size:25px" href="getallrentbook.php?Id=' + sessionStorage.getItem("Id") + '">List Rent Book</a>');
				
				$.ajax({
					type: "GET",
					url: "api/getbookRent/" + sessionStorage.getItem("Id"),
					dataType: "json",
					
					success: function(data, status, xhr){
					//load data into table
	
						data.forEach(function(book, index) {
						var newRow = document.createElement("tr");
						var bookId = document.createElement("td");
						var bookTitle = document.createElement("td");
						var bookAuthor = document.createElement("td");
						var bookAbout = document.createElement("td");
						var rentedDate = document.createElement("td");
						var returnDate = document.createElement("td");
						bookId.innerHTML = book.ID;
						bookTitle.innerHTML = book.title;
						bookAuthor.innerHTML = book.author;
						bookAbout.innerHTML = book.about;
						rentedDate.innerHTML = book.rent_date;
						returnDate.innerHTML = book.return_date;
						newRow.append(bookId);
						newRow.append(bookTitle);
						newRow.append(bookAuthor);
						newRow.append(bookAbout);
						newRow.append(rentedDate);
						newRow.append(returnDate);
						document.getElementById("rows").appendChild(newRow);

                    });
					
					},
					
					error: function(){
						alert(status);
						}
			});
		});
	
	
	
	</script>
	
	<script> $('#get').submit(function (event) {
			event.preventDefault();
			var id = $('#id').val();
			
			$.ajax({
					type: "GET",
					url: "http://localhost/backendsingle/getBook/"+ id,
					dataType: "json",
					
					success: function(data, status, xhr){
					//load data into table
						var prettyContent = '';
						prettyContent += '<br>ID : ' + data.ID;
						prettyContent += '<br>Title : ' + data.title;
						prettyContent += '<br>Author : ' + data.author;
						prettyContent += '<br>About : ' + data.about;
						document.querySelector('#singlebook').innerHTML = prettyContent;
									
					},
					
					error: function(){
						alert(status);
						}
			});
			
			
			
			});
		
	</script>	
</html>