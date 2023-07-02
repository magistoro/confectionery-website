<html>
                                <head>
                                    <title>Подтвердите Email</title>
                                    <style>
                                        /* Стилизация элементов письма */

                                        @import url("https://fonts.googleapis.com/css2?family=Baskervville&display=swap");
                                        body {
                                            font-family: Arial, sans-serif;
                                            background-color: #272624;
                                            color: #FFFFFF;
                                            padding: 20px;
                                        }
                                        .container {
                                            max-width: 600px;
                                            margin: 0 auto;
                                            padding: 20px;
                                            background-color: #272624;
                                            border-radius: 6px;
                                        }
                                        h1 {
                                            color: #E8D47F;
                                            text-align: center;
                                            font-family: "Baskervville";
                                        }
                                        p {
                                            text-align: center;
                                        }
                                        img {
                                            display: block;
                                            margin: 0 auto;
                                        }
                                        .button {
                                            display: inline-block;
                                            padding: 10px 20px;
                                            background-color: #E8D47F;
                                            color: #272624;
                                            text-decoration: none;
                                            border-radius: 4px;
                                            text-align: center;
                                            transition: background-color 0.3s ease;
                                        }
                                        .button:hover {
                                            background-color: #C8B86F;
                                        }
                                    </style>
                                </head>
                                <body>
                                    <div class="container">
                                        <h1>SWEET TEMPTATION</h1>
                                        <p><img src="https://i.postimg.cc/Gm9vVN6b/logo.png" alt="Логотип"></p>
                                        <p>Добро пожаловать!</p>
                                        <p>Чтобы подтвердить свой Email, пожалуйста, перейдите по ссылке ниже:</p>
                                        <p>
                                            <a href="http://localhost/_Practice/personal_account/confirmed.php?hash=' . $hash . '" class="button">Подтвердить Email</a>
                                        </p>
                                        <p>Спасибо!</p>
                                    </div>
                                </body>
                                </html>