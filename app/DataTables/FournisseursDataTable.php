<?php

namespace App\DataTables;

use App\Models\Fournisseur;
use Yajra\DataTables\Html\Button;
use Yajra\DataTables\Html\Column;
use Yajra\DataTables\Html\Editor\Editor;
use Yajra\DataTables\Html\Editor\Fields;
use Yajra\DataTables\Services\DataTable;
use Illuminate\Support\Facades\Route;

class FournisseursDataTable extends DataTable
{
    use DataTableTrait;
    /**
     * Build DataTable class.
     *
     * @param mixed $query Results from query() method.
     * @return \Yajra\DataTables\DataTableAbstract
     */
    public function dataTable($query)
    {
        return datatables()
        ->eloquent($query)
        ->editColumn('valid', function ($fournisseur) {
            return $fournisseur->valid ? '<i class="fas fa-check"></i>' : '';
        })
        ->editColumn('created_at', function ($fournisseur) {
            return formatDate($fournisseur->created_at);
        })
        ->editColumn('updated_at', function ($fournisseur) {
            return formatDate($fournisseur->updated_at);
        })
        ->addColumn('action', function ($fournisseur) {
            return $edit = '<a id="show" href="' . route('detail.fournisseurs', $fournisseur->id) . '" class="btn btn-xs btn-info btn-block" title="Voir"><i class="fas fa-eye"></i></a>
            <script>
                $(() => {
                $("a#show").click(e => {
                    let that = e.currentTarget;
                    e.preventDefault();
                    $.ajax({
                    method: $(that).attr("method"),
                    url: $(that).attr("href"),
                    data: $(that).serialize()
                    })
                    .done((data) => {
                    $("#detail").html(data);
                    $(".modale").modal("show");
                    })
                    .fail((data) => {
                    console.log(data);
                    });
                });
                });
            </script>'
            .$this->button(
                'fournisseurs.edit',
                $fournisseur->id,
                'warning',
                __('Edit'),
                'edit'
            ). $this->button(
                'fournisseurs.destroy',
                $fournisseur->id,
                'danger',
                __('Supprimer'),
                'trash-alt',
                '',
                __('Voulez vous vraiment supprimer ce fournisseur?')
            );
        })
        ->rawColumns(['valid', 'action']);
    }

    /**
     * Get query source of dataTable.
     *
     * @param \App\Models\Fournisseur $model
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function query(Fournisseur $model)
    {
        if(Route::currentRouteNamed('fournisseurs.indexnew')) {
            return $model->has('unreadNotifications');
        }

        return $model->newQuery();
    }

    /**
     * Optional method if you want to use html builder.
     *
     * @return \Yajra\DataTables\Html\Builder
     */
    public function html()
    {
        return $this->builder()
                ->setTableId('fournisseurs-table')
                ->columns($this->getColumns())
                ->minifiedAjax()
                ->dom('Blfrtip')
                ->lengthMenu();
    }

    /**
     * Get columns.
     *
     * @return array
     */
    protected function getColumns()
    {
        return [
            Column::make('nom_fournisseur_FOURNISSEURS')->title(__('Nom')),
            Column::make('prenom_fournisseur_FOURNISSEURS')->title(__('Prenom')),
            Column::make('adresse_fournisseur_FOURNISSEURS')->title(__('Adresse')),
            Column::make('email_fournisseur_FOURNISSEURS')->title(__('Email')),
            Column::computed('action')->title(__('Action'))->addClass('align-middle text-center'),
        ];
    }

    /**
     * Get filename for export.
     *
     * @return string
     */
    protected function filename()
    {
        return 'Fournisseurs_' . date('YmdHis');
    }
}
