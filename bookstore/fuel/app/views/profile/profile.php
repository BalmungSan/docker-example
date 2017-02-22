<!DOCTYPE html>
<!--
  Copyright 2017 Luis Miguel Mejía Suárez (BalmungSan)
 
  Licensed under the Apache License, Version 2.0 (the "License");
  you may not use this file except in compliance with the License.
  You may obtain a copy of the License at
  
   http://www.apache.org/licenses/LICENSE-2.0

  Unless required by applicable law or agreed to in writing, software
  distributed under the License is distributed on an "AS IS" BASIS,
  WITHOUT WARRANTIES OR CONDITIONS OF ANY KIND, either express or implied.
  See the License for the specific language governing permissions and
  limitations under the License.
-->

<html lang="es">
<head>
<meta name="viewport" content="width=device-width, initial-scale=1">
<meta http-equiv="content-type" content="text/html; charset=UTF-8">
<title>BookStore</title>
<meta charset="utf-8">

<!-- Linking styles -->
<link rel="stylesheet" href="/assets/css/reset.css" type="text/css" media="screen">
<link rel="stylesheet" href="/assets/css/style_store.css" type="text/css" media="screen">
<link rel="stylesheet" href="/assets/css/nivo-slider.css" type="text/css" media="screen">
<link rel="stylesheet" href="/assets/css/bootstrap.css" type="text/css" media="screen">

<!-- Linking scripts -->
<script src="assets/js/main.js"></script>
<script src="assets/js/jquery.js"></script>
<link rel="shortcut icon" href="/assets/img/favicon.ico" type="image/x-icon">
<link rel="icon" href="/assets/img/favicon.ico" type="image/x-icon">
</head>

<body>
	<div class="container">
		<header><!-- Defining the header section of the page -->
			<div class="top_head"><!-- Defining the top head element -->
				<div id="salir">
					<button type="button" class="btn btn-danger" onclick="window.location.href='profile/logOut';"><strong>Log Out</strong></button>
				</div>

				<div class="logo"><!-- Defining the logo element -->
					<img id="logo" src="assets/img/logo.png">
				</div>
			</div>
		</header>

		<div id="main"><!-- Defining submain content section -->
			<section id="content"><!-- Defining the content section #2 -->
				<div id="left">
					<h3>My Books</h3>
					<ul>
						<?php
						foreach ($books as $book) {
						?>
						<li>
							<div class="well" id="book">
								<div class="info">
									<a class="title"><?=utf8_encode($book['name'])?></a>
									<div id="info<?=$book['id']?>">
										<p style="font-size: 17px; margin-top: 15px;"><span class="st">Author: </span><strong><?=$book['author']?></strong></p>
										<p style="font-size: 17px; margin-top: 15px;"><span class="st">Category: </span><strong><?=$book['category']?></strong></p>
										<p style="font-size: 17px; margin-top: 15px;"><span class="st">Units: </span><strong><?=$book['units']?></strong></p>
										<p style="font-size: 17px; margin-top: 15px;"><span class="st">Price: </span><strong>$<?=$book['price']?></strong></p>
										<p style="font-size: 17px; margin-top: 15px;"><span class="st"><a href="books/<?=$book['preview']?>" target="_blank">Preview</a></span></p>
									</div>
									<div class="actions">
										<button type="button" class="btn btn-info details" onclick="window.location.href='profile/editBook/<?=$book['id']?>';"><strong>Edit</strong></button>
										<button type="button" class="btn btn btn-danger" onclick="window.location.href='profile/deleteBook/<?=$book['id']?>';"><strong>Delete</strong></button>
									</div>
								</div>
							</div>
						</li>
						<?php
						}
						Session::delete('myBooks');
						?>
					</ul>
				</div>
				<div id="rightUpper">
					<h3>Search By:</h3>
					<form id="search_form" method="post" name="search_form" autocomplete="on" action="profile/search">
						<input id="r2" type="radio" name="radioButton" value=2 onclick="search()" checked> Name<br>
					  		<input id="name" name="name" class="form-control" placeholder="Las Mil y una Noches" style="display: block;"/>
					  	<input id="r0" type="radio" name="radioButton" value=0 onclick="search()"> Category<br>
                            <select id="categorynewbook" name="categorynewbook" class="form-control" style="display: none;">
	                        <?php
	                        foreach($categories as $category){
	                          	echo "<option value='".$category."'>".$category."</option>";
	                        }
	                        ?>
	                        </select>
						<input id="r1" type="radio" name="radioButton" value=1 onclick="search()"> Author<br>
					  		<input id="author" name="author" class="form-control"  placeholder="Edgar Allan Poe" style="display: none;"/>
						<input id="r3" type="radio" name="radioButton" value=3 onclick="search()"> Price<br>
						<div id="prices" style="display: none;">
							<input type="number" id="priceL" name="priceL" class="form-control"  placeholder="$60000"/>
					  		<input type="number" id="priceU" name="priceU" class="form-control"  placeholder="$170000"/>
						</div>
						<p class="signin">
                            <input type="submit" value="Search" class="btn btn-primary" id="search_button" />
                        </p>
					</form>
				</div>
				<div id="rightDown">
					<h3>Add Book:</h3>
					<?php echo Html::anchor('book/create', 'Add new Book', array('class' => 'btn btn-success', 'id' => 'btnAddBook')); ?>
				</div>
			</section>
		</div>
		<footer><!-- Defining the footer section of the page -->
			<div id="privacy">
				BookStore © 2017
			</div>
		</footer>
	</div>
</body>
</html>