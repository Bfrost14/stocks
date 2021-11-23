<div class="w-full md:w-1/2 px-3 mb-6 md:mb-0">
    <label class="block uppercase tracking-wide text-grey-darker text-xs font-light mb-1"
        for="grid-state">
        Catégorie
    </label>
    <div class="relative">
        <p wire:loading >Chargement de données ...</p>
        <select
            class="block appearance-none w-full bg-grey-200 border border-grey-200 text-grey-darker py-3 px-4 pr-8 rounded leading-tight focus:outline-none focus:bg-white focus:border-grey"
            id="categorie_id"  wire:model="categorie_id">
            <option value="" >Séléctionner une catégorie</option>
            @foreach ($countries as $categorie)
            <option value="{{ $categorie->id }}" >{{ $categorie->nom_categorie_CATEGORIES_ARTICLES }}</option>
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
@if($articles->count())

    <label class="block uppercase tracking-wide text-grey-darker text-xs font-light mb-1"
        for="grid-state">
        Article
    </label>
    <div class="relative">
        <select
            class="block appearance-none w-full bg-grey-200 border border-grey-200 text-grey-darker py-3 px-4 pr-8 rounded leading-tight focus:outline-none focus:bg-white focus:border-grey"
            id="article_id" wire:model="article_id" name="code_reference_materielle_SORTIES">
            <option value="" >Sélectionnez un article</option>
            @foreach ($articles as $article)
                <option value="{{ $article->code_reference_materielle_SORTIES }}">{{ $article->nom_article_ARTICLES }}</option>
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
@endif
</div>

