<div id='centeredFormModal' class="modal-wrapper">
    <div class="overlay close-modal"></div>
    <div class="modal modal-centered">
        <div class="modal-content shadow-lg p-5">
            <div class="border-b p-2 pb-3 pt-0 mb-4">
                <div class="flex justify-between items-center">
                    Nouveau Stock
                    <span class='close-modal cursor-pointer px-3 py-1 rounded-full bg-gray-100 hover:bg-gray-200'>
                        <i class="fas fa-times text-gray-700"></i>
                    </span>
                </div>
            </div>
            <!-- Modal content -->
            <form id='form_id' class="w-full" action="{{ route('stocks.store') }}" method="POST">
                @csrf
                <div class="flex flex-wrap -mx-3 mb-6">

                    <div class="w-full md:w-1/2 px-3">
                        <label class="block uppercase tracking-wide text-gray-700 text-xs font-light mb-1"
                            for="grid-last-name">
                            Lieu de Stock
                        </label>
                        <input
                            class="appearance-none block w-full bg-gray-200 text-grey-darker border border-gray-300 rounded py-3 px-4 leading-tight focus:outline-none focus:bg-white-500 focus:border-gray-600"
                            id="grid-last-name" type="text" name="lieu_STOCK" >
                    </div>
                    <div class="w-full md:w-1/2 px-3">
                        <label class="block uppercase tracking-wide text-gray-700 text-xs font-light mb-1"
                            for="grid-last-name">
                            Emplacement
                        </label>
                        <input
                            class="appearance-none block w-full bg-gray-200 text-grey-darker border border-gray-300 rounded py-3 px-4 leading-tight focus:outline-none focus:bg-white-500 focus:border-gray-600"
                            id="grid-last-name" type="text" name="emplacement_STOCK">
                    </div>
                </div>
                @foreach ($errors->all() as $error)
                    <span>{{ $error }}</span><br />
                @endforeach
                <div class="mt-5">
                    <button class='bg-green-500 hover:bg-green-800 text-white font-bold py-2 px-4 rounded' type="submit"> Ajouter
                    </button>
                    <span
                        class='close-modal cursor-pointer bg-red-200 hover:bg-red-500 text-red-900 font-bold py-2 px-4 rounded'>
                        Annuler
                    </span>
                </div>
            </form>
        </div>
    </div>
</div>
