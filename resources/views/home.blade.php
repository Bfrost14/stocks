@extends('layouts.app')

@section('content')
<br />

    @if($users)
        <x-front.box
            type='success'
            :number='$users->matricule_RESPONSABLES'
            title='Formateur: {{ $users->prenom_responsable_RESPONSABLES }} {{ $users->nom_responsable_RESPONSABLES }}'
            route='home'
            model='user'>
        </x-front.box>
    @endif
    @if($sorties)
        <x-front.box
            type='sucsess'
            text='Nbrs de sorties :'
            :number='$sorties'
            title='Nombre de sorties'
            route='home'
            model='sortie'>
        </x-front.box>
    @endif
@endsection
