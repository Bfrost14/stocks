@extends('back.layouts.app')


@section('main')
@if(session('ok'))
    <div class="alert alert-success alert-dismissible">
    <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
    <h5><span class="icon fa fa-user"></span>{!! session('ok') !!}</h5>
</div>
@endif
@if(session('echec'))
    <div class="alert alert-danger alert-dismissible">
    <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
    <h5><span class="icon fa fa-user"></span>{!! session('echec') !!}</h5>
</div>
@endif
@endsection
@section('content')
<div class="table-responsive">
    <div class="flex flex-1  flex-col md:flex-row lg:flex-row mx-2">
        <div class="mb-2 border-solid border-gray-300 rounded border shadow-sm w-full">
            <div class="bg-gray-200 px-2 py-3 border-solid border-gray-200 border-b">
                Editer {{ $user->prenom_responsable_RESPONSABLES }} {{ $user->nom_responsable_RESPONSABLES }}
            </div>
            <div class="p-3">
                <form id='form_id' class="w-full" action="{{ route('users.update', $user->id) }}" method="POST">
                    @csrf
                    @method('PUT')
                    <div class="flex flex-wrap -mx-3 mb-6">

                        <div class="w-full md:w-1/2 px-3">
                            <label class="block uppercase tracking-wide text-gray-700 text-xs font-light mb-1"
                                for="grid-last-name">
                                Nom
                            </label>
                            <input
                                class="appearance-none block w-full bg-gray-200 text-grey-darker border border-gray-300 rounded py-3 px-4 leading-tight focus:outline-none focus:bg-white-500 focus:border-gray-600"
                                id="grid-last-name" type="text" name="nom_responsable_RESPONSABLES" value="{{ $user->nom_responsable_RESPONSABLES }}">
                        </div>
                        <div class="w-full md:w-1/2 px-3">
                            <label class="block uppercase tracking-wide text-gray-700 text-xs font-light mb-1"
                                for="grid-last-name">
                                Prénom
                            </label>
                            <input
                                class="appearance-none block w-full bg-gray-200 text-grey-darker border border-gray-300 rounded py-3 px-4 leading-tight focus:outline-none focus:bg-white-500 focus:border-gray-600"
                                id="grid-last-name" type="text" name="prenom_responsable_RESPONSABLES" value="{{ $user->prenom_responsable_RESPONSABLES }}">
                        </div>
                    </div>


                    <div class="flex flex-wrap -mx-3 mb-6">

                        <div class="w-full md:w-1/2 px-3">
                            <label class="block uppercase tracking-wide text-gray-700 text-xs font-light mb-1"
                                for="grid-last-name">
                                Date de Naissance
                            </label>
                            <input
                                class="appearance-none block w-full bg-gray-200 text-grey-darker border border-gray-300 rounded py-3 px-4 leading-tight focus:outline-none focus:bg-white-500 focus:border-gray-600"
                                id="grid-last-name" type="date" name="date_naissance_RESPONSABLES" value="{{ $user->date_naissance_RESPONSABLES }}">
                        </div>
                        <div class="w-full md:w-1/2 px-3">
                            <label class="block uppercase tracking-wide text-gray-700 text-xs font-light mb-1"
                                for="grid-last-name">
                                Adresse
                            </label>
                            <input
                                class="appearance-none block w-full bg-gray-200 text-grey-darker border border-gray-300 rounded py-3 px-4 leading-tight focus:outline-none focus:bg-white-500 focus:border-gray-600"
                                id="grid-last-name" type="text" name="adresse_responsable_RESPONSABLES" value="{{ $user->adresse_responsable_RESPONSABLES }}">
                        </div>
                    </div>

                    <div class="flex flex-wrap -mx-3 mb-6">
                        <div class="w-full md:w-1/2 px-3 mb-6 md:mb-0">
                            <label class="block uppercase tracking-wide text-grey-darker text-xs font-light mb-1"
                                for="grid-state">
                                Role
                            </label>
                            <div class="relative">
                                <select
                                    class="block appearance-none w-full bg-grey-200 border border-grey-200 text-grey-darker py-3 px-4 pr-8 rounded leading-tight focus:outline-none focus:bg-white focus:border-grey"
                                    id="grid-state" name="role">
                                    <option disabled>Choisir le Role</option>
                                    <option value="user">User</option>
                                    <option value="admin">Admin</option>

                                </select>
                                <div
                                    class="pointer-events-none absolute inset-y-0 right-0 flex items-center px-2 text-grey-darker">
                                    <svg class="fill-current h-4 w-4" xmlns="http://www.w3.org/2000/svg"
                                        viewBox="0 0 20 20">
                                        <path
                                            d="M9.293 12.95l.707.707L15.657 8l-1.414-1.414L10 10.828 5.757 6.586 4.343 8z">
                                        </path>
                                    </svg>
                                </div>
                            </div>
                        </div>
                        <div class="w-full md:w-1/2 px-3 mb-6 md:mb-0">
                            <label class="block uppercase tracking-wide text-gray-700 text-xs font-light mb-1"
                            for="grid-last-name">
                            Email
                        </label>
                        <input
                            class="appearance-none block w-full bg-gray-200 text-grey-darker border border-gray-300 rounded py-3 px-4 leading-tight focus:outline-none focus:bg-white-500 focus:border-gray-600"
                            id="grid-last-name" type="email" name="email" value="{{ $user->email }}">

                        </div>
                    </div>
                    <div class="flex flex-wrap -mx-3 mb-6">

                        <div class="w-full md:w-1/2 px-3">
                            <label class="block uppercase tracking-wide text-gray-700 text-xs font-light mb-1"
                                for="grid-last-name">
                                Password
                            </label>
                            <input
                                class="appearance-none block w-full bg-gray-200 text-grey-darker border border-gray-300 rounded py-3 px-4 leading-tight focus:outline-none focus:bg-white-500 focus:border-gray-600"
                                id="grid-last-name" type="password" name="password" >
                        </div>
                    </div>
                    @foreach ($errors->all() as $error)
                        <span>{{ $error }}</span><br />
                    @endforeach
                    <div class="mt-5">
                        <button class='bg-green-500 hover:bg-green-800 text-white font-bold py-2 px-4 rounded' type="submit"> Update
                        </button>
                
                    </div>
                </form>
            </div>
        </div>
    </div>
</div> 
@endsection

