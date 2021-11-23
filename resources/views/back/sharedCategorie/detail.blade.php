<div class="border-b p-2 pb-3 pt-0 mb-4">
    <div class="flex justify-between items-center">
        Détail de la Catégorie
    </div>
</div>

    <div class="row gutters-sm">
        <div class="col-sm-6 col-xl-3 mb-3">
          <div class="card">
            <div class="card-header border-bottom flex-column align-items-start p-3">
              <h4 class="text-secondary font-weight-light mb-2">{{ $categories->nom_categorie_CATEGORIES_ARTICLES }}</h4>
            </div>
            <div class="card-header border-bottom justify-content-center py-4">
              <h1 class="pricing-price">
                <small class=".justify-content-center">Libellé : {{$categories->libelle_categorie_CATEGORIES_ARTICLES }}</small><br />
                <small class=".justify-content-center">Date de Creation : {{ $categories->created_at }}</small><br />
                <small class=".justify-content-center">Derniere Modification : {{ $categories->updated_at }}</small>
              </h1>
          </div>
        </div>
  </div>

