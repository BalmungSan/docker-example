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

<html lang="es" class="no-js">

<head>
    <meta charset="UTF-8" />
    <title>Login and Registration BookStore</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="shortcut icon" href="images/favicon.ico">
    <link rel="stylesheet" type="text/css" href="assets/css/demo.css" />
    <link rel="stylesheet" type="text/css" href="assets/css/style_login.css" />
    <link rel="stylesheet" type="text/css" href="assets/css/animate-custom.css" />
    <link rel="stylesheet" type="text/css" href="assets/css/bootstrap.css" />
    <link rel="shortcut icon" href="assets/img/favicon.ico" type="image/x-icon">
    <link rel="icon" href="assets/img/favicon.ico" type="image/x-icon">
</head>

<body>
    <div class="container">
        <header>
            <h1>Login and Sign up<span> BookStore</span></h1>
        </header>

        <section>
            <div id="container_demo" >
                <a class="hiddenanchor" id="toregister"></a>
                <a class="hiddenanchor" id="tologin"></a>
                <div id="wrapper">
                    <div id="login" class="animate form">

                        <form  autocomplete="on" id="form_id" method="post" name="myform" action="welcome/checkUser">
                            <h1>Log in</h1>
                            <p>
                                <label for="emaillogin"  data-icon="u" class="uname" > Your email </label>
                                <input id="emaillogin" name="emaillogin" pattern="[a-z0-9._%+-]+@[a-z0-9.-]+\.[a-z]{2,3}$" required="required" type="email" placeholder="user@example.com"/>
                            </p>
                            <p>
                                <label for="passwordlogin" data-icon="p" class="youpasswd" > Your password </label>

                                <input id="passwordlogin"  name="passwordlogin" required="required" type="password" placeholder="eg. X8df!90EO" />
                            </p>


                            <p class="login button">
                                <input type="submit" name="action" value="Login"/>
                            </p>
                            <p class="change_link">
                             Not a member yet ?
                                <a href="#toregister" class="to_register">Join us</a>
                            </p>
                        </form>
                    </div>


                     <div id="register" class="animate form">

                        <form  id="register_form_id" method="post" name="myform" autocomplete="on" action="welcome/registerUser">

                            <h1> Sign up </h1>
                            <p>
                                <label for="emailsignup" class="uname" data-icon="e" >Email</label>
                                <input id="emailsignup" name="emailsignup" pattern="[a-z0-9._%+-]+@[a-z0-9.-]+\.[a-z]{2,3}$" required="required" type="email" placeholder="user@example.com" />
                            </p>
                            <p>
                                <label for="namesignup" class="uname" data-icon="u">Name</label>
                                <input id="namesignup"  name="namesignup" pattern="[a-zA-Z ]+$" required="required" type="text" placeholder="Pepito" />
                            </p>
                            <p>
                                <label for="citysignup" class="uname" data-icon="m">City</label><br>
                                <select id="citysignup" name="citysignup" required="required">
                                    <?php
                                        foreach($cities as $city){
                                            echo "<option value=$city>$city</option>";
                                        }
                                    ?>
                                </select>
                                <!--<input id="citysignup" name="citysignup" required="required" type="text" placeholder="Medellín" />-->
                            </p>
                            <p>
                                <label for="addresssignup" class="uname" data-icon="a">Address</label>
                                <input id="addresssignup" name="addresssignup" required="required" type="text" placeholder="Cr 54 N° 27" />
                            </p>
                            <p>
                                <label for="passwordsignup" class="youpasswd" data-icon="p">Your password </label>
                                <input id="passwordsignup" name="passwordsignup" required="required" type="password" placeholder="X8df!90EO"/>
                            </p>


                            <p>
                                <label for="passwordsignup_confirm" class="youpasswd" data-icon="p">Please confirm your password </label>
                                <input id="passwordsignup_confirm" name="passwordsignup_confirm" required="required" type="password" placeholder="X8df!90EO"/>
                            </p>


                            <p class="signin button">
                               <input type="submit" value="Sign up" />
                           </p>

                           <p class="change_link">
                               Already a member ?
                               <a href="#tologin" class="to_register"> Go and log in </a>
                           </p>
                       </form>
                   </div>
               </div>
           </div>
       </section>
    </div>
</body>
</html>