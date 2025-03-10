<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Register</title>
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
            0% { background-position: 0% 50%; }
            50% { background-position: 100% 50%; }
            100% { background-position: 0% 50%; }
        }

        .container {
            position: relative;
            width: 420px;
            background: rgba(255, 255, 255, 0.1);
            border-radius: 15px;
            display: flex;
            justify-content: center;
            align-items: center;
            backdrop-filter: blur(5px);
            box-shadow: 0 25px 45px rgba(0, 0, 0, 0.1);
            padding: 25px;
            border: 1px solid rgba(255, 255, 255, 0.5);
        }

        .form {
            width: 100%;
            text-align: center;
        }

        .form img {
            margin-bottom: 10px;
        }

        .form h2 {
            color: #fff;
            font-size: 24px;
            font-weight: 600;
            margin-bottom: 20px;
        }

        /* Grid Input */
        .inputGroup {
            display: flex;
            flex-wrap: wrap;
            justify-content: space-between;
            margin-bottom: 10px;
        }

        .inputBox {
            width: 48%;
            margin-bottom: 10px;
        }

        .fullWidth {
            width: 100%;
        }

        .inputBox input,
        .inputBox select {
            width: 100%;
            padding: 10px;
            border-radius: 35px;
            border: 1px solid rgba(255, 255, 255, 0.5);
            background: rgba(255, 255, 255, 0.2);
            color: white;
            outline: none;
            font-size: 16px;
            text-align: center;
        }

        .inputBox input::placeholder {
            color: rgba(255, 255, 255, 0.8);
        }

        .inputBox select option {
            color: black;
            background: white;
        }

        .inputBox input[type="submit"] {
            background: #fff;
            color: #666;
            max-width: 150px;
            cursor: pointer;
            font-weight: bold;
        }

        .inputBox input[type="submit"]:hover {
            background: #666;
            color: #fff;
            transition: 0.3s ease-in-out;
        }

        .forget {
            margin-top: 10px;
            color: #fff;
        }

        .forget a {
            color: #fff;
            text-decoration: none;
        }

        .forget a:hover {
            color: #000;
        }

    </style>
</head>
<body>
    <div class="container">
        <div class="form">
            <img class="logo" src="{{ asset('template/img/Logo Poliwangi.png') }}" alt="Logo" width="100" height="100">
            <h2>Register Form</h2>
            <form action="{{ route('register.store') }}" method="POST">
                @csrf
                
                <!-- Grid untuk Input -->
                <div class="inputGroup">
                    <div class="inputBox">
                        <input type="text" name="name" placeholder="Username" required>
                    </div>
                    <div class="inputBox">
                        <input type="text" name="nim" placeholder="NIM" required>
                    </div>
                    <div class="inputBox">
                        <input type="text" name="nomor" placeholder="Nomor HP Aktif" required>
                    </div>
                    <div class="inputBox">
                        <input type="email" name="email" placeholder="Email" required>
                    </div>
                </div>

                <!-- Input Password Full Width -->
                <div class="inputBox fullWidth">
                    <input type="password" name="password" placeholder="Password" required>
                </div>

                <!-- Pilihan Role Full Width -->
                <div class="inputBox fullWidth">
                    <select name="role" required>
                        <option value="" disabled selected>Pilih Role</option>
                        <option value="pelapor">Pelapor</option>
                        <option value="admin">Admin</option>
                        <option value="upt">UPT</option>
                    </select>
                </div>

                <div class="inputBox fullWidth">
                    <input type="submit" value="Register">
                </div>

                <p class="forget">Have an account? <a href="/">Sign In</a></p>
            </form>
        </div>
    </div>
</body>
</html>
