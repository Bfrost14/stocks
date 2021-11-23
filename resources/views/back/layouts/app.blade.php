<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <meta name="keywords"
        content="tailwind,tailwindcss,tailwind css,css,starter template,free template,admin templates, admin template, admin dashboard, free tailwind templates, tailwind example">
    <!-- Css -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
    @yield('css')
    @livewireStyles()
    <link rel="stylesheet" href="{{ asset('dist/styles.css') }}">
    <link rel="stylesheet" href="{{ asset('dist/all.css') }}">
    <link rel="stylesheet" href="{{ asset('css/adat.css') }}">
  <style>
    a > * { pointer-events: none; }
  </style>

    <link href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:400,400i,600,600i,700,700i" rel="stylesheet">
    <title>Dashboard</title>
</head>

<body>
    <!--Container -->
    <div class="mx-auto bg-grey-400">
        <!--Screen-->
        <div class="min-h-screen flex flex-col">
            <!--Header Section Starts Here-->
            <header class="bg-nav">
                <div class="flex justify-between">
                    <div class="p-1 mx-3 inline-flex items-center">
                        <i class="fas fa-bars pr-2 text-white" onclick="sidebarToggle()"></i>
                        <img src="{{ asset('dist/images/isep.png') }}" alt="isep" width="90px" height="90px">
                    </div>
                    <div class="p-1 flex flex-row items-center">
                        <form action="{{ route('logout') }}" method="POST" hidden>
                            @csrf
                          </form>
                        <a href="{{ route('logout') }}" onclick="event.preventDefault(); this.previousElementSibling.submit();" class="text-white p-3 no-underline hidden md:block lg:block">Déconnexion</a>

                    </div>
            </header>
            <!--/Header-->

            <div class="flex flex-1">
                <!--Sidebar-->
                <aside id="sidebar"
                    class="bg-side-nav w-1/2 md:w-1/6 lg:w-1/6 border-r border-side-nav hidden md:block lg:block">

                    <ul class="list-reset flex flex-col">
                        <li class=" w-full h-full py-4 px-12 border-b border-light-border bg-white">
                            <h1 class="text-black p-2"> Atelier ISEP</h1>
                        </li>
                        <li class="w-full h-full py-4 px-2 border-b border-light-border">
                            <a href="{{ route('articles.index') }}"
                                class="font-sans font-hairline hover:font-normal text-sm text-nav-item no-underline">
                                <i class="fab fa-wpforms float-left mx-2"></i>
                                Articles
                                <span><i class="fa fa-angle-right float-right"></i></span>
                            </a>
                        </li>
                        <li class="w-full h-full py-4 px-2 border-b border-light-border">
                            <a href="{{ route('categories.index') }}"
                                class="font-sans font-hairline hover:font-normal text-sm text-nav-item no-underline">
                                <i class="fab fa-uikit float-left mx-2"></i>
                                Catégories
                                <span><i class="fa fa-angle-right float-right"></i></span>
                            </a>
                        </li>
                        <li class="w-full h-full py-4 px-2 border-b border-light-border">
                            <a href="{{ route('users.index') }}"
                                class="font-sans font-hairline hover:font-normal text-sm text-nav-item no-underline">
                                <i class="fas fa-user float-left mx-2"></i>
                                Utilisateurs
                                <span><i class="fa fa-angle-right float-right"></i></span>
                            </a>
                        </li>
                        <li class="w-full h-full py-4 px-2 border-b border-light-border">
                            <a href="{{ route('fournisseurs.index') }}"
                                class="font-sans font-hairline hover:font-normal text-sm text-nav-item no-underline">
                                <i class="fas fa-grip-horizontal float-left mx-2"></i>
                                Fournisseurs
                                <span><i class="fa fa-angle-right float-right"></i></span>
                            </a>
                        </li>
                        <li class="w-full h-full py-4 px-2 border-b border-light-border">
                            <a href="{{ route('livrers.index') }}"
                                class="font-sans font-hairline hover:font-normal text-sm text-nav-item no-underline">
                                <i class="fas fa-table float-left mx-2"></i>
                                Entrées
                                <span><i class="fa fa-angle-right float-right"></i></span>
                            </a>
                        </li>
                        <li class="w-full h-full py-4 px-2 border-b border-light-border">
                            <a href="{{ route('conservers.index') }}"
                                class="font-sans font-hairline hover:font-normal text-sm text-nav-item no-underline">
                                <i class="fas fa-table float-left mx-2"></i>
                                Conservation
                                <span><i class="fa fa-angle-right float-right"></i></span>
                            </a>
                        </li>
                        <li class="w-full h-full py-4 px-2 border-b border-light-border">
                            <a href="{{ route('sorts.index') }}"
                                class="font-sans font-hairline hover:font-normal text-sm text-nav-item no-underline">
                                <i class="fab fa-uikit float-left mx-2"></i>
                                Tous les Sorties
                                <span><i class="fa fa-angle-right float-right"></i></span>
                            </a>
                        </li>
                        <li class="w-full h-full py-4 px-2 border-b border-light-border">
                            <a href="{{ route('sorties.index') }}"
                                class="font-sans font-hairline hover:font-normal text-sm text-nav-item no-underline">
                                <i class="fab fa-uikit float-left mx-2"></i>
                                Faire Sorties
                                <span><i class="fa fa-angle-right float-right"></i></span>
                            </a>
                        </li>
                        <li class="w-full h-full py-4 px-2 border-b border-light-border">
                            <a href="{{ route('stocks.index') }}"
                                class="font-sans font-hairline hover:font-normal text-sm text-nav-item no-underline">
                                <i class="fab fa-uikit float-left mx-2"></i>
                                Stocks
                                <span><i class="fa fa-angle-right float-right"></i></span>
                            </a>
                        </li>
                        
                    </ul>

                </aside>
                <!--/Sidebar-->
                <!--Main-->
                <main class="bg-white-300 flex-1 p-3 overflow-hidden">
                    @yield('main')

                    <div class="flex flex-col">

                        <div class="flex flex-1 flex-col md:flex-row lg:flex-row mx-2">


                            <div class="rounded overflow-hidden shadow bg-white mx-2 w-full">
                                @yield('content')
                            </div>
                            <!-- /card -->

                        </div>

                    </div>
                </main>
                <!--/Main-->
            </div>

        </div>

    </div>
    @livewireScripts()
    <script src="{{ asset('js/main.js') }}"></script>
    @yield('js')
</body>

</html>
