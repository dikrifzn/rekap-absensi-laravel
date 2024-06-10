<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>LOGIN - AL-AWALIYAH</title>
    <link rel="stylesheet" href="../assets/css/login.css">
</head>

<body>
    @if(session('error'))
        <div class="alert alert-danger" role="alert">
            {{ session('error') }}
        </div>
    @endif
    <main>
        <div class="box">
            <div class="togaIcon">
                <div class="circle">
                    <img src="assets/images/toga.png" />
                </div>
            </div>
            <div class="formLogin">
                <form action="{{ route('login.login') }}" method="POST">
                    @csrf
                    <table>
                        <tr>
                            <td>
                                <div class="container">
                                    <div class="did-floating-label-content">
                                        <input class="did-floating-input" type="email" placeholder="" name="email"/>
                                        <label class="did-floating-label">Username</label>
                                    </div>
                                </div>
                            </td>
                        </tr>
                        <tr>
                            <td>
                                <div class="container">
                                    <div class="did-floating-label-content">
                                        <input class="did-floating-input" type="password" placeholder="" name="password"/>
                                        <label class="did-floating-label">Password</label>
                                    </div>
                                </div>
                            </td>
                        </tr>
                        <tr>
                            <td>
                                <button type="submit">Masuk</button>
                            </td>
                        </tr>
                    </table>
                </form>
            </div>
        </div>
    </main>
    <footer>
        <div>
            © 2020 Copyright:
            <a class="text-white ms-1 me-1"
                href="https://www.instagram.com/sisteminformasi_02?igsh=MWF0bmJwczFmZDcybg=="
                target="_BLANK">SINFC-2022-02</a>
            Universitas Kuningan
        </div>
    </footer>
</body>

</html>