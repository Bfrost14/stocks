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
<br>
<div class="table-responsive">
    <div class="flex flex-1  flex-col md:flex-row lg:flex-row mx-2">
        <div class="mb-2 border-solid border-gray-300 rounded border shadow-sm w-full">
            <div class="bg-gray-200 px-2 py-3 border-solid border-gray-200 border-b">
                Editer {{ $article->nom_article_ARTICLES }}
            </div>
            <div class="p-3">
                <form id='form_id' class="w-full" action="{{ route('articles.update', $article->id) }}" method="POST">
                    @csrf 
                    @method('put')
                    <div class="flex flex-wrap -mx-3 mb-6">
                        <div class="w-full md:w-1/2 px-3 mb-6 md:mb-0">
                            <label class="block uppercase tracking-wide text-grey-darker text-xs font-light mb-1"
                                for="grid-state">
                                Catégorie
                            </label>
                            <div class="relative">
                                <select
                                    class="block appearance-none w-full bg-grey-200 border border-grey-200 text-grey-darker py-3 px-4 pr-8 rounded leading-tight focus:outline-none focus:bg-white focus:border-grey"
                                    id="grid-state" name="categorie_id">
                                    <option disabled>Choisir la catégorie</option>
                                    @foreach($categories as $arc)
                                        <option value="{{ $arc->id }}">{{ $arc->nom_categorie_CATEGORIES_ARTICLES }}</option>
                                    @endforeach
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
                            <label class="block uppercase tracking-wide text-grey-darker text-xs font-light mb-1"
                                for="grid-state">
                                Stock
                            </label>
                            <div class="relative">
                                <select
                                    class="block appearance-none w-full bg-grey-200 border border-grey-200 text-grey-darker py-3 px-4 pr-8 rounded leading-tight focus:outline-none focus:bg-white focus:border-grey"
                                    id="grid-state" name="lieu_stocks">
                                    <option disabled>Choisir le lieu</option>
                                    @foreach($stocks as $arc)
                                        <option value="{{ $arc->lieu_STOCK }}">{{ $arc->lieu_STOCK }}</option>
                                    @endforeach
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

                    </div>

                    <div class="flex flex-wrap -mx-3 mb-6">

                        <div class="w-full md:w-1/2 px-3">
                            <label class="block uppercase tracking-wide text-gray-700 text-xs font-light mb-1"
                                for="grid-last-name">
                                Code Reference
                            </label>
                            <input
                                class="appearance-none block w-full bg-gray-200 text-grey-darker border border-gray-300 rounded py-3 px-4 leading-tight focus:outline-none focus:bg-white-500 focus:border-gray-600"
                                id="grid-last-name" type="text" name="code_reference_materielle_SORTIES" value="{{ $article->code_reference_materielle_SORTIES }}">
                        </div>
                        <div class="w-full md:w-1/2 px-3">
                            <label class="block uppercase tracking-wide text-gray-700 text-xs font-light mb-1"
                                for="grid-last-name">
                                Nom Article
                            </label>
                            <input
                                class="appearance-none block w-full bg-gray-200 text-grey-darker border border-gray-300 rounded py-3 px-4 leading-tight focus:outline-none focus:bg-white-500 focus:border-gray-600"
                                id="grid-last-name" type="text" name="nom_article_ARTICLES" value="{{ $article->nom_article_ARTICLES }}">
                        </div>
                    </div>
                    <div class="flex flex-wrap -mx-3 mb-6">
                        <div class="w-full md:w-1/2 px-3">
                            <label class="block uppercase tracking-wide text-gray-700 text-xs font-light mb-1"
                                for="grid-last-name">
                                Désignation Article
                            </label>
                            <input
                                class="appearance-none block w-full bg-gray-200 text-grey-darker border border-gray-300 rounded py-3 px-4 leading-tight focus:outline-none focus:bg-white-500 focus:border-gray-600"
                                id="grid-last-name" type="text" name="designation_ARTICLES" value="{{ $article->designation_ARTICLES }}">
                        </div>
                        <div class="w-full md:w-1/2 px-3">
                            <label class="block uppercase tracking-wide text-gray-700 text-xs font-light mb-1"
                                for="grid-last-name">
                                Remplacé Article
                            </label>
                            <input
                                class="appearance-none block w-full bg-gray-200 text-grey-darker border border-gray-300 rounded py-3 px-4 leading-tight focus:outline-none focus:bg-white-500 focus:border-gray-600"
                                id="grid-last-name" type="text"  name="remplacees_ARTICLES" value="{{ $article->remplacees_ARTICLES }}">
                        </div>
                    </div>

                    <div class="flex flex-wrap -mx-3 mb-2">
                        <div class="w-full md:w-1/2 px-3 mb-6 md:mb-0">
                                <label class="block uppercase tracking-wide text-grey-darker text-xs font-light mb-1"
                                    for="grid-city">
                                    Quantite
                                </label>
                                <input
                                    class="appearance-none block w-full bg-grey-200 text-grey-darker border border-grey-200 rounded py-3 px-4 leading-tight focus:outline-none focus:bg-white focus:border-grey"
                                    id="grid-city" type="number" name="quantite_Article" value="{{ $article->quantite_Article }}">
                        </div>
                        <div class="w-full md:w-1/2 px-3 mb-6 md:mb-0">
                            <label class="block uppercase tracking-wide text-grey-darker text-xs font-light mb-1"
                                for="grid-city">
                                Date Entrée
                            </label>
                            <input
                                class="appearance-none block w-full bg-grey-200 text-grey-darker border border-grey-200 rounded py-3 px-4 leading-tight focus:outline-none focus:bg-white focus:border-grey"
                                id="grid-city" type="text" value="{{ date("d-m-Y à H:i:s") }}" name="date_Entree_Articles" readonly>
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
