<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    @auth
    <p>congrats you are logged in</p>
    <form action="/logout" method="POST">
        @csrf
        <button>Log out</button>
    </form>

    @else
    <div style="border: 3px solid black">
        <h2>Register</h2>
        <form action="/register" METHOD="POST">
            @csrf
            <input name="name" type="text" placeholder="name"/>
            <input name="email" type="text" placeholder="email"/>
            <input name="password" type="password" placeholder="password"/>
            <button>Register</button>
        </form>
    </div>
    <div style="border: 3px solid black">
        <h2>Login</h2>
        <form action="/login" METHOD="POST">
            @csrf
            <input name="loginname" type="text" placeholder="loginname"/>
            <input name="loginpassword" type="password" placeholder="loginpassword"/>
            <button>Login</button>
        </form>
    </div>
    @endauth
</body>
</html>
