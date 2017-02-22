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

<!DOCTYPE html>
<html lang="en" class="no-js">

</html>
<head>
    <meta charset="UTF-8" />
    <title>Edit a book BookStore</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" type="text/css" href="/assets/css/demo.css" />
    <link rel="stylesheet" type="text/css" href="/assets/css/style_login.css" />
    <link rel="stylesheet" type="text/css" href="/assets/css/animate-custom.css" />
    <link rel="shortcut icon" href="/assets/img/favicon.ico" type="image/x-icon">
    <link rel="icon" href="/assets/img/favicon.ico" type="image/x-icon">
</head>

<body>
    <div class="container">
        <header>
            <h1>BookStore</h1>
        </header>
        <div id="container_demo" >
            <div id="wrapper">
                <div id="login" class="animate form">
                    <h1> Edit book </h1>
                    <?php echo render('book/_form', $data); ?>
                </div>
            </div>
        </div>
    </div>
</body>
</html>