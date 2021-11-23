<div class="border-b p-2 pb-3 pt-0 mb-4">
    <div class="flex justify-between items-center">
        Détail de l'Utilisateur
    </div>
</div>

    <div class="row gutters-sm">
        <div class="col-sm-6 col-xl-3 mb-3">
          <div class="card">
            <div class="card-header border-bottom flex-column align-items-start p-3">
              <h4 class="text-secondary font-weight-light mb-2">{{ $user->prenom_responsable_RESPONSABLES }} {{ $user->nom_responsable_RESPONSABLES }}</h4>
            </div>
            <div class="card-header border-bottom justify-content-center py-4">
              <h1 class="pricing-price">
                <small class=".justify-content-center">Email : {{ $user->email }}</small><br />
                <small class=".justify-content-center">Date de naissance : {{ $user->date_naissance_RESPONSABLES }}</small><br />
                <small class=".justify-content-center">Adresse : {{ $user->adresse_responsable_RESPONSABLES }}</small><br />
                <small class=".justify-content-center">Role : {{ $user->role }}</small>
              </h1>
            
          </div>
        </div>
  </div>


