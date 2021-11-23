<?php

namespace App\DataTables;

use App\Models\Livrer;
use Yajra\DataTables\Html\Button;
use Yajra\DataTables\Html\Column;
use Yajra\DataTables\Html\Editor\Editor;
use Yajra\DataTables\Html\Editor\Fields;
use Yajra\DataTables\Services\DataTable;
use Illuminate\Support\Facades\Route;

class LivrersDataTable extends DataTable
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
        ->editColumn('valid', function ($livrer) {
            return $livrer->valid ? '<i class="fas fa-check"></i>' : '';
        })
        ->editColumn('created_at', function ($livrer) {
            return formatDate($livrer->created_at);
        })
        ->editColumn('updated_at', function ($livrer) {
            return formatDate($livrer->updated_at);
        })
        ->addColumn('action', function ($livrer) {
            return $edit = '<a id="show" href="' . route('detail.livrers', $livrer->id) . '" class="btn btn-xs btn-info btn-block" title="Voir"><i class="fas fa-eye"></i></a>
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
            </script>'.$this->button(
                'livrers.edit',
                $livrer->id,
                'warning',
                __('Edit'),
                'edit'
            ). $this->button(
                'ajout',
                $livrer->id,
                'secondary',
                __('Ajouter'),
                'plus-square',
            )
            . $this->button(
                'livrers.destroy',
                $livrer->id,
                'danger',
                __('Supprimer'),
                'trash-alt',
                '',
                __('Voulez vous vraiment supprimer cette livraison?')
            );
        })
        ->rawColumns(['valid', 'action']);
    }

    /**
     * Get query source of dataTable.
     *
     * @param \App\Models\Livrer $model
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function query(Livrer $model)
    {
        if(Route::currentRouteNamed('livrer.indexnew')) {
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
                ->setTableId('livrers-table')
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
            Column::make('code_reference_materielle_SORTIES')->title(__('Code Article')),
            Column::make('email_fournisseur_FOURNISSEURS')->title(__('Email Fournisseurs')),
            Column::make('prix_LIVRER')->title(__('Prix')),
            Column::make('quantite_livraison_LIVRER')->title(__('Quantite')),
            Column::make('date_livraison_LIVRER')->title(__('Livraison')),
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
        return 'Livrers_' . date('YmdHis');
    }
}
