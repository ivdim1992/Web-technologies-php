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

    <div style="border: 3px solid black">
      <h2>Create new form</h2>
      <form action="/create-post" METHOD="POST">
        @csrf
        <input type="text" name="title" placeholder="title" />
        <textarea type="text" name="body" placeholder="body content.."></textarea>
        <button>Save Post</button>
      </form>
    </div>

    <div style="border: 3px solid black">
      <h2>All posts</h2>
      @foreach($posts as $post)
    <div style="background-color:gray; padding:10px; margin:10px">
        <h3>{{$post['title']}} by {{$post->user->name}}</h3>
        <div>{{$post['body']}}</div>
        <p><a href="/edit-post/{{$post->id}}">Edit</a></p>
        <form action="/delete-post/{{$post->id}}" method="POST">
        @csrf
        @method('DELETE')
        <button>DELETE</button>
        </form>
      @endforeach
    </div>

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
