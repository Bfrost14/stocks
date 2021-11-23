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
                Editer 
            </div>
            <div class="p-3">
                    <form id='form_id' class="w-full" action="{{ route('livrers.update', $livrer->id) }}" method="POST">
                        @csrf
                        @method('put')
                        <div class="flex flex-wrap -mx-3 mb-6">

                            <div class="w-full md:w-1/2 px-3">
                                <label class="block uppercase tracking-wide text-gray-700 text-xs font-light mb-1"
                                    for="grid-last-name">
                                    Prix
                                </label>
                                <input
                                    class="appearance-none block w-full bg-gray-200 text-grey-darker border border-gray-300 rounded py-3 px-4 leading-tight focus:outline-none focus:bg-white-500 focus:border-gray-600"
                                    id="grid-last-name" type="number" name="prix_LIVRER" value="{{ $livrer->prix_LIVRER }}">
                            </div>
                            <div class="w-full md:w-1/2 px-3">
                                <label class="block uppercase tracking-wide text-gray-700 text-xs font-light mb-1"
                                    for="grid-last-name">
                                    Quantité
                                </label>
                                <input
                                    class="appearance-none block w-full bg-gray-200 text-grey-darker border border-gray-300 rounded py-3 px-4 leading-tight focus:outline-none focus:bg-white-500 focus:border-gray-600"
                                    id="grid-last-name" type="number" name="quantite_livraison_LIVRER" value="{{ $livrer->quantite_livraison_LIVRER }}">
                            </div>
                        </div>


                        <div class="flex flex-wrap -mx-3 mb-6">

                            <div class="w-full md:w-1/2 px-3">
                                <label class="block uppercase tracking-wide text-gray-700 text-xs font-light mb-1"
                                    for="grid-last-name">
                                    Condition de paiement
                                </label>
                                <input
                                    class="appearance-none block w-full bg-gray-200 text-grey-darker border border-gray-300 rounded py-3 px-4 leading-tight focus:outline-none focus:bg-white-500 focus:border-gray-600"
                                    id="grid-last-name" type="text" name="condition_payement_LIVRER" value="{{ $livrer->condition_payement_LIVRER }}">
                            </div>
                            <div class="w-full md:w-1/2 px-3">
                                <label class="block uppercase tracking-wide text-gray-700 text-xs font-light mb-1"
                                    for="grid-last-name">
                                    Code TVA
                                </label>
                                <input
                                    class="appearance-none block w-full bg-gray-200 text-grey-darker border border-gray-300 rounded py-3 px-4 leading-tight focus:outline-none focus:bg-white-500 focus:border-gray-600"
                                    id="grid-last-name" type="number" name="code_TVA_LIVRER" value="{{ $livrer->code_TVA_LIVRER }}">
                            </div>
                        </div>


                        <div class="flex flex-wrap -mx-3 mb-6">

                            <div class="w-full md:w-1/2 px-3">
                                <label class="block uppercase tracking-wide text-gray-700 text-xs font-light mb-1"
                                    for="grid-last-name">
                                    Taux de remise
                                </label>
                                <input
                                    class="appearance-none block w-full bg-gray-200 text-grey-darker border border-gray-300 rounded py-3 px-4 leading-tight focus:outline-none focus:bg-white-500 focus:border-gray-600"
                                    id="grid-last-name" type="number" name="taux_remise_LIVRER" value="{{ $livrer->taux_remise_LIVRER }}">
                            </div>
                            <div class="w-full md:w-1/2 px-3">
                                <label class="block uppercase tracking-wide text-gray-700 text-xs font-light mb-1"
                                    for="grid-last-name">
                                    Date de Livraison
                                </label>
                                <input
                                    class="appearance-none block w-full bg-gray-200 text-grey-darker border border-gray-300 rounded py-3 px-4 leading-tight focus:outline-none focus:bg-white-500 focus:border-gray-600"
                                    id="grid-last-name" type="date" name="date_livraison_LIVRER" value="{{ $livrer->date_livraison_LIVRER }}">
                            </div>
                        </div>
                        <input type="hidden" required class="input-text" name="code_reference_materielle_SORTIES" value="{{ $livrer->code_reference_materielle_SORTIES }}">
                        <input type="hidden" required class="input-text" name="email_fournisseur_FOURNISSEURS" value="{{ $livrer->email_fournisseur_FOURNISSEURS }}">

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
