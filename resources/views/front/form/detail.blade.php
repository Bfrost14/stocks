
  <div class="border-b p-2 pb-3 pt-0 mb-4">
    <div class="flex justify-between items-center">
        <h2 class="text-secondary font-weight-light mb-2">Détail de la sortie</h2>
    </div>
</div>

    <div class="row gutters-sm">
        <div class="col-sm-6 col-xl-3 mb-3">
          <div class="card">
            <div class="card-header border-bottom flex-column align-items-start p-3">
              <h2 class="text-secondary font-weight-light mb-2">Article : {{ $articles->nom_article_ARTICLES }} </h2>
            </div>
            <div class="card-header border-bottom justify-content-center py-4">
              <h1 class="pricing-price">
                <small class=".justify-content-center">Date de Sortie : {{ $sorties->date_sortie_SORTIES }}</small><br />
                <small class=".justify-content-center">Heure de Sortie : {{ $sorties->heure_sortie_SORTIES }}</small><br />
                <small class=".justify-content-center">Quantité : {{ $sorties->quantite }}</small><br />
                <small class=".justify-content-center">Mon Email : {{ $sorties->email_users }}</small><br />
                <small class=".justify-content-center">Date Création : {{ $sorties->created_at }}</small><br />
                <small class=".justify-content-center">Dernier Modification : {{ $sorties->updated_at }}</small><br />
              </h1>
          </div>
        </div>
  </div>
