<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <meta name="csrf-token" content="{{ csrf_token() }}" />
    <meta name="keywords"
        content="tailwind,tailwindcss,tailwind css,css,starter template,free template,admin templates, admin template, admin dashboard, free tailwind templates, tailwind example">
    <!-- Css -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
    
  <style>
    a > * { pointer-events: none; }
  </style>
    <link rel="stylesheet" href="{{ asset('dist/styles.css') }}">
    <link rel="stylesheet" href="{{ asset('dist/all.css') }}"> 
    <link rel="stylesheet" href="{{ asset('css/adat.css') }}">
    @livewireStyles()
    <link href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:400,400i,600,600i,700,700i" rel="stylesheet">
    <title>Dashboard</title>
    <!-- firebase integration started -->


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
                        @if(auth()->user()->role != 'user')
                        <li class="w-full h-full py-4 px-2 border-b border-light-border">
                            <a href="{{ url('admin') }}"
                                class="font-sans font-hairline hover:font-normal text-sm text-nav-item no-underline">
                                <i class="fas fa-table float-left mx-2"></i>
                                @lang('Responsable')
                                <span><i class="fa fa-angle-right float-right"></i></span>
                            </a>
                        </li>
                        @endif

                        <li class="w-full h-full py-4 px-2 border-b border-light-border">
                            <a href="{{ route('sorties.index') }}"
                                class="font-sans font-hairline hover:font-normal text-sm text-nav-item no-underline">
                                <i class="fas fa-table float-left mx-2"></i>
                                Mes Sorties
                                <span><i class="fa fa-angle-right float-right"></i></span>
                            </a>
                        </li>


                    </ul>

                </aside>
                <!--/Sidebar-->
                <!--Main-->
                <main class="bg-white-300 flex-1 p-3 overflow-hidden">


                    <div class="flex flex-col">

                        <div class="flex flex-1 flex-col md:flex-row lg:flex-row mx-2">


                            <div class="rounded overflow-hidden shadow bg-white mx-2 w-full">
                                @yield('content')
                            <!-- /card -->
                            </div>
                        </div>

                    </div>
                </main>
                <!--/Main-->
            </div>

        </div>

    </div>
     
    <script src="{{ asset('js/main.js') }}"></script>
    @livewireScripts()
    @yield('script')
</body>

</html>
