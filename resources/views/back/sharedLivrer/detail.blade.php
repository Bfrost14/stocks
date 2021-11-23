<div class="border-b p-2 pb-3 pt-0 mb-4">
    <div class="flex justify-between items-center">
        Détail de la livraison
    </div>
</div>

    <div class="row gutters-sm">
        <div class="col-sm-6 col-xl-3 mb-3">
          <div class="card">
            <div class="card-header border-bottom flex-column align-items-start p-3">
              <h2 class="pricing-price">Nom Fournisseur :{{ $fournisseurs->prenom_fournisseur_FOURNISSEURS }} {{ $fournisseurs->nom_fournisseur_FOURNISSEURS }}</h2>
            </div>
            <div class="card-header border-bottom justify-content-center py-4">
              <h1 class="pricing-price">
                <small class=".justify-content-center">Article : {{$articles->nom_article_ARTICLES }}</small><br />
                <small class=".justify-content-center">Prix : {{ $livrers->prix_LIVRER }}</small><br />
                <small class=".justify-content-center">Quantité : {{  $livrers->quantite_livraison_LIVRER  }}</small><br />
                <small class=".justify-content-center">Paiement : {{ $livrers->condition_payement_LIVRER }}</small><br />
                <small class=".justify-content-center">Code TVA : {{ $livrers->code_TVA_LIVRER }}%</small><br />
                <small class=".justify-content-center">Taux de remise : {{ $livrers->taux_remise_LIVRER }}%</small><br />
                <small class=".justify-content-center">Prix Totale : {{ ((($livrers->prix_LIVRER * $livrers->quantite_livraison_LIVRER)* $livrers->code_TVA_LIVRER)/100) + ($livrers->prix_LIVRER * $livrers->quantite_livraison_LIVRER) }}</small><br />
                <small class=".justify-content-center">Date de Creation : {{ $livrers->created_at }}</small><br />
                <small class=".justify-content-center">Derniere Modification : {{ $livrers->updated_at }}</small>
              </h1>

          </div>
        </div>
  </div>

