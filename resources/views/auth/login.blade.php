<!doctype html>
<html lang="en">

<head>
  <title>Login </title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <link rel="stylesheet" href="{{ asset('dist/styles.css') }}">
  <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.0.13/css/all.css" integrity="sha384-DNOHZ68U8hZfKXOrtjWvjxusGo9WQnrNx2sqG0tfsghAvtVlRW3tvkXWZh58N9jp"
    crossorigin="anonymous">
  <style>
  .login{
    background: url('./dist/images/isep2.jpg') no-repeat;
    background-size: cover;
  }
  </style>
</head>
<body class="h-screen font-sans login bg-cover">
<div class="container mx-auto h-full flex flex-1 justify-center items-center">
  <div class="w-full max-w-lg">
    <div class="leading-loose">
      <form class="max-w-xl m-4 p-10 bg-white rounded shadow-xl" method="POST" action="{{ route('login') }}">
        @csrf
        <p class="text-gray-800 font-medium text-center text-lg font-bold">Connexion</p>
        <div class="">
          <label class="block text-sm text-gray-00" for="username">Nom d'utilisateur</label>
          <input class="w-full px-5 py-1 text-gray-700 bg-gray-200 rounded" type="email" placeholder="Email" name="email" value="{{ old('email') }}" required autocomplete="email" autofocus>
        </div>
        @error('email')
            <span>
                <strong>{{ $message }}</strong>
            </span>
            @enderror
        <div class="mt-2">
          <label class="block text-sm text-gray-00" for="Mot de passe">Mot de passe</label>
          <input class="w-full px-5  py-1 text-gray-700 bg-gray-200 rounded" type="password" placeholder="Password" name="password" required autocomplete="current-password">
        </div>
        @error('password')
        <span>
            <strong>{{ $message }}</strong>
        </span>
        @enderror
        <div class="mt-4 items-center " style="
        display: flex;
        flex-direction: column;
    ">
            <button class=' text-white font-bold py-2 px-4 rounded' style="background-color: #c9a03a; hover:background-color: #a37539;"> Connexion
            </button>
        </div>
      </form>
    </div>
  </div>
</div>
</body>
</html>

