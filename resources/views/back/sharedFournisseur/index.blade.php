@extends('back.layouts.app')




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
<div class="px-6 py-2 ">
    <div class="font-bold text-xl">Listes des Founisseurs
       <button data-modal='centeredFormModal'
            class="modal-trigger bg-blue-500 hover:bg-blue-600 text-white font-bold py-1 px-2 border border-blue-800 rounded float-right">
                Nouveau Fournisseur
        </button>
    </div>
</div>

<br>
<div class="table-responsive">
    <div class="flex flex-1  flex-col md:flex-row lg:flex-row mx-2">
        <div class="mb-2 border-solid border-gray-300 rounded border shadow-sm w-full">
            <div class="bg-gray-200 px-2 py-3 border-solid border-gray-200 border-b">
                Fournisseurs
            </div>
            <div class="p-3">
                {{ $dataTable->table(['class' => 'table table-striped table-hover table-sm'], true) }}
            </div>
        </div>
    </div>
</div>
@include('back.sharedFournisseur.create')
<div class="modale fade" tabindex="-1" role="dialog">
    <div class="modal-dialog" role="document">
      <div id="detail" class="modal-contente">
      </div>
    </div>
  </div>
@endsection

@section('js')
<script src="{{ asset('js/jquery.js') }}"></script>
<script src="{{ asset('js/jquery.dataTables.min.js') }}"></script>
<script src="{{ asset('js/dataTables.bootstrap4.min.js') }}"></script>
<script src="{{ asset('js/sweetalert2@10.js') }}"></script>
<script src="{{ asset('dist/bootstrap.js') }}"></script>
<script>
    $(() => {
      $('#show').click(e => {
        let that = e.currentTarget;
        e.preventDefault();
        $.ajax({
          method: $(that).attr('method'),
          url: $(that).attr('href'),
          data: $(that).serialize()
        })
        .done((data) => {
          $('#detail').html(data);
          $('.modal').modal('show');
        })
        .fail((data) => {
          console.log(data);
        });
      });
    });
    $(() => {
      $('#create').click(e => {
        let that = e.currentTarget;
        e.preventDefault();
        $.ajax({
          method: $(that).attr('method'),
          url: $(that).attr('href'),
          data: $(that).serialize()
        })
        .done((data) => {
          $('#form_id').html(data);
        })
        .fail((data) => {
          console.log(data);
        });
      });
    });
  </script>
  @if(config('app.locale') == 'fr')
    <script>
      (($, DataTable) => {
        $.extend(true, DataTable.defaults, {
          language: {
            "sEmptyTable":     "Aucune donnée disponible dans le tableau",
            "sInfo":           "Affichage des éléments _START_ à _END_ sur _TOTAL_ éléments",
            "sInfoEmpty":      "Affichage de l'élément 0 à 0 sur 0 élément",
            "sInfoFiltered":   "(filtré à partir de _MAX_ éléments au total)",
            "sInfoPostFix":    "",
            "sInfoThousands":  ",",
            "sLengthMenu":     "Afficher _MENU_ éléments",
            "sLoadingRecords": "Chargement...",
            "sProcessing":     "Traitement...",
            "sSearch":         "Rechercher :",
            "sZeroRecords":    "Aucun élément correspondant trouvé",
            "oPaginate": {
              "sFirst":    "Premier",
              "sLast":     "Dernier",
              "sNext":     "Suivant",
              "sPrevious": "Précédent"
            },
            "oAria": {
              "sSortAscending":  ": activer pour trier la colonne par ordre croissant",
              "sSortDescending": ": activer pour trier la colonne par ordre décroissant"
            },
            "select": {
              "rows": {
                "_": "%d lignes sélectionnées",
                "0": "Aucune ligne sélectionnée",
                "1": "1 ligne sélectionnée"
              }
            }
          }
        });
      })(jQuery, jQuery.fn.dataTable);
    </script>
  @endif

  {{ $dataTable->scripts() }}
  <script>
    (() => {
        // Variables
        const headers = {
            'X-CSRF-TOKEN': '{{ csrf_token() }}',
            'Content-Type': 'application/json',
            'Accept': 'application/json'
        }

        // Delete
        const deleteElement = async e => {
            e.preventDefault();
            Swal.fire({
              title: e.target.dataset.name,
              icon: 'warning',
              showCancelButton: true,
              confirmButtonColor: '#DD6B55',
              confirmButtonText: '@lang('Yes')',
              cancelButtonText: '@lang('No')',
              preConfirm: () => {
                  return fetch(e.target.getAttribute('href'), {
                      method: 'DELETE',
                      headers: headers
                  })
                  .then(response => {
                      if (response.ok) {
                          e.target.parentNode.remove();
                      } else {
                        Swal.fire({
                            icon: 'error',
                            title: '@lang('Whoops!')',
                            text: '@lang('Something went wrong!')'
                        });
                      }
                  });
              }
            });
        }
        // Listener wrapper
        const wrapper = (selector, type, callback, condition = 'true', capture = false) => {
            const element = document.querySelector(selector);
            if(element) {
                document.querySelector(selector).addEventListener(type, e => {
                    if(eval(condition)) {
                        callback(e);
                    }
                }, capture);
            }
        };
        // Set listeners
        window.addEventListener('DOMContentLoaded', () => {
            wrapper('table', 'click', deleteElement, "e.target.matches('.btn-danger')");
        });
    })()
  </script>
@endsection
