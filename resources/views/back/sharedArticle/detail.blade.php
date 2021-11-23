<div class="border-b p-2 pb-3 pt-0 mb-4">
    <div class="flex justify-between items-center">
        <h2 class="text-secondary font-weight-light mb-2">Détail de l'article</h2>
    </div>
</div>

    <div class="row gutters-sm">
        <div class="col-sm-6 col-xl-3 mb-3">
          <div class="card">
            <div class="card-header border-bottom flex-column align-items-start p-3">
              <h4 class="text-secondary font-weight-light mb-2">Nom :{{ $articles->nom_article_ARTICLES }} </h4>
            </div>
            <div class="card-header border-bottom justify-content-center py-4">
              <h1 class="pricing-price">
                <small class=".justify-content-center">Catégorie : {{ $categories->nom_categorie_CATEGORIES_ARTICLES }}</small><br />
                <small class=".justify-content-center">Code Référence : {{ $articles->code_reference_materielle_SORTIES }}</small><br />
                <small class=".justify-content-center">Désignation : {{ $articles->designation_ARTICLES }}</small><br />
                <small class=".justify-content-center">Remplacée : {{ $articles->remplacees_ARTICLES }}</small><br />
                <small class=".justify-content-center">Quantité : {{ $articles->quantite_Article }}</small><br />
                <small class=".justify-content-center">Date Entrée : {{ $articles->date_Entree_Articles }}</small><br />
                <small class=".justify-content-center">Lieu de Stock : {{ $articles->lieu_stocks }}</small><br />
                <small class=".justify-content-center">Date de Creation : {{ $articles->created_at }}</small><br />
                <small class=".justify-content-center">Derniere Modification : {{ $articles->updated_at }}</small>
              </h1>
          </div>
        </div>
  </div>

