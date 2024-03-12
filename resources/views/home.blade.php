<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
</head>

<body>
    {{-- The @auth
helps redirect a loged in user, @else if the user is not loged in he is not redirected to anywhere,
but remains on the same page
    @endauth --}}
    @auth
        <p>Congrats you've been loged in</p>
        <form action="/logout" method="post">
            @csrf
            <button>log out</button>
        </form>

        <div style="border: 3px solid black">
            <h2>Create a new Post</h2>
            <form action="/create-post" action="post">
                @csrf
                <input type="text" name="title" placeholder="post title">
                <textarea name="body" placeholder="body content...."></textarea>
                <button>Save Post</button>
            </form>
        </div>

        {{-- showing all posts posted by a user in the site --}}
        <div style="border: 3px solid black">
            <h2>All posts</h2>
            @foreach ($posts as $post)
                <div style="background-color: gray padding: 10px margin: 10px">
                    <h3>{{ $post['title'] }}</h3>
                    {{ $post['body'] }}

                    {{-- editing and deleting posts --}}
                    <p><a href="/edit-post/{{ $post->id }}">Edit</a></p>
                    <form action="/delete-post/{{ $post->id }}" method="post">
                        @csrf
                        @method('DELETE')
                        <button>Delete</button>
                    </form>
                </div>
            @endforeach
        </div>
    @else
        <div style="border: 3px solid black">
            <h2>Register</h2>
            <form action="/register" method="post">
                @csrf
                <input name="name" type="text" placeholder="name">
                <input name="email" type="text" placeholder="email">
                <input name="password" type="password" placeholder="password">
                <button>Register</button>
            </form>
        </div>
        <div style="border: 3px solid black">
            <h2>Login</h2>
            <form action="/login" method="post">
                @csrf
                <input name="name" type="text" placeholder="name">
                <input name="password" type="password" placeholder="password">
                <button>login</button>
            </form>
        </div>
    @endauth
</body>

</html>
