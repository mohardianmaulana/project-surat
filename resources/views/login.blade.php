<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
            font-family: 'Poppins', sans-serif;
        }

        body {
            display: flex;
            justify-content: center;
            align-items: center;
            min-height: 100vh;
            background: url('template/img/poliwangi.jpg');
            background-size: 100% 100%;
            animation: gradientBG 15s ease infinite;
        }

        @keyframes gradientBG {
            0% {
                background-position: 0% 50%;
            }
            50% {
                background-position: 100% 50%;
            }
            100% {
                background-position: 0% 50%;
            }
        }

        .container {
            position: relative;
            width: 380px;
            height: 440px;
            background: rgba(255, 255, 255, 0.1);
            border-radius: 15px;
            display: flex;
            justify-content: center;
            align-items: center;
            backdrop-filter: blur(5px);
            box-shadow: 0 25px 45px rgba(0, 0, 0, 0.1);
            border: 1px solid rgba(255, 255, 255, 0.5);
            border-right: 1px solid rgba(255, 255, 255, 0.2);
            border-bottom: 1px solid rgba(255, 255, 255, 0.2);
        }

        .form {
            position: relative;
            width: 100%;
            height: 130%;
            padding: 30px;
            text-align: center;
        }

        .form img {
            text-align: center;
            margin-top: 45px;
        }

        .form h2 {
            position: relative;
            color: #fff;
            font-size: 24px;
            font-weight: 600;
            letter-spacing: 1px;
            margin-bottom: 20px;
        }

        .form .inputBox {
            width: 100%;
            margin-top: 20px;
        }

        .form .inputBox input {
            width: 100%;
            background: rgba(255, 255, 255, 0.2);
            border: none;
            outline: none;
            padding: 10px 20px;
            border-radius: 35px;
            border: 1px solid rgba(255, 255, 255, 0.5);
            border-right: 1px solid rgba(255, 255, 255, 0.2);
            border-bottom: 1px solid rgba(255, 255, 255, 0.2);
            font-size: 16px;
            letter-spacing: 1px;
            color: #fff;
            box-shadow: 0 5px 15px rgba(0, 0, 0, 0.05);
        }

        .form .inputBox input::placeholder {
            color: #fff;
        }

        .form .inputBox input[type="submit"] {
            background: #fff;
            color: #666;
            max-width: 100px;
            cursor: pointer;
            margin-bottom: 10px;
            font-weight: 600;
        }

        .form .inputBox input[type="submit"]:hover {
            background: #666; /* Warna biru primary */
            color: #fff; /* Warna teks menjadi putih */
            transition: 0.3s ease-in-out;
        }

        .forget {
            margin-top: 5px;
            color: #fff;
        }

        .forget a {
            color: #fff;
            text-decoration: none;
        }

        .forget a:hover {
            color: #000000;
        }
    </style>
</head>
<body>
    <div class="container">
        <div class="form">
            <img class="logo" src="{{ asset('template/img/Logo Poliwangi.png') }}"  alt="Logo" width="100" height="100">
            <h2>Login Form</h2>
            <form action="/">
                <div class="inputBox">
                    <input type="text" placeholder="Email">
                </div>
                <div class="inputBox">
                    <input type="password" placeholder="Password">
                </div>
                <div class="inputBox">
                    <input type="submit" value="Login">
                </div>
                <p class="forget">Don't have an account? <a href="/register">Sign up</a></p>
                <p class="forget"><a href="#">Forgot Password?</a></p>
            </form>
        </div>
    </div>
</body>
</html>