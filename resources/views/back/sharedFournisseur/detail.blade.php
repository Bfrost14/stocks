<div class="border-b p-2 pb-3 pt-0 mb-4">
    <div class="flex justify-between items-center">
        Détail du fournisseur
    </div>
</div>

    <div class="row gutters-sm">
        <div class="col-sm-6 col-xl-3 mb-3">
          <div class="card">
            <div class="card-header border-bottom flex-column align-items-start p-3">
              <h2 class="text-secondary font-weight-light mb-2">Nom : {{ $fournisseurs->prenom_fournisseur_FOURNISSEURS }} {{ $fournisseurs->nom_fournisseur_FOURNISSEURS }}</h2>
            </div>
            <div class="card-header border-bottom justify-content-center py-4">
              <h1 class="pricing-price">
                <small class=".justify-content-center">Adresse : {{$fournisseurs->adresse_fournisseur_FOURNISSEURS }}</small><br />
                <small class=".justify-content-center">Email : {{ $fournisseurs->email_fournisseur_FOURNISSEURS }}</small><br />
                <small class=".justify-content-center">Date de Creation : {{ $fournisseurs->created_at }}</small><br />
                <small class=".justify-content-center">Derniere Modification : {{ $fournisseurs->updated_at }}</small>
              </h1>
          </div>
        </div>
  </div>

