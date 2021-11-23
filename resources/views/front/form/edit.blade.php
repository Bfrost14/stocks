@extends('layouts.app')

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
                Editer {{ $sorty->code_reference_materielle_SORTIES }}
            </div>
            <div class="p-3">
                    <form id='form_id' class="w-full" action="{{ route('sorties.update',$sorty->id) }}" method="POST">
                        @csrf
                        @method('PUT')
                        <input type="hidden" class="input-text" required  value="{{ Auth::user()->email }}" name="email_users" >
                        <input type="hidden" class="input-text" required  value="{{ $sorty->code_reference_materielle_SORTIES }}" name="code_reference_materielle_SORTIES" >

                        <div class="flex flex-wrap -mx-3 mb-6">
                            <div class="w-full md:w-1/2 px-3">
                                <label class="block uppercase tracking-wide text-gray-700 text-xs font-light mb-1"
                                    for="grid-last-name">
                                    Date de Sortie
                                </label>
                                <input
                                    class="appearance-none block w-full bg-gray-200 text-grey-darker border border-gray-300 rounded py-3 px-4 leading-tight focus:outline-none focus:bg-white-500 focus:border-gray-600"
                                    id="grid-last-name" type="text" name="date_sortie_SORTIES" value="{{ date("Y-m-d") }}" readonly>
                            </div>
                            <div class="w-full md:w-1/2 px-3">
                                <label class="block uppercase tracking-wide text-gray-700 text-xs font-light mb-1"
                                    for="grid-last-name">
                                    Heure de Sortie
                                </label>
                                <input
                                    class="appearance-none block w-full bg-gray-200 text-grey-darker border border-gray-300 rounded py-3 px-4 leading-tight focus:outline-none focus:bg-white-500 focus:border-gray-600"
                                    id="grid-last-name" type="text" name="heure_sortie_SORTIES" value="{{ date("H:i:s") }}" readonly>
                            </div>
                        </div>
                        <div class="flex flex-wrap -mx-3 mb-6">
                            <div class="w-full md:w-1/2 px-3">
                                <label class="block uppercase tracking-wide text-gray-700 text-xs font-light mb-1"
                                    for="grid-last-name">
                                    Quantité
                                </label>
                                <input
                                    class="appearance-none block w-full bg-gray-200 text-grey-darker border border-gray-300 rounded py-3 px-4 leading-tight focus:outline-none focus:bg-white-500 focus:border-gray-600"
                                    id="grid-last-name" type="number" name="quantite" value="{{ $sorty->quantite }}">
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
@section('script')


@endsection
