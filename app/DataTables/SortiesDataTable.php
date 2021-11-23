<?php

namespace App\DataTables;

use App\Models\Sortie;
use Yajra\DataTables\Html\Button;
use Yajra\DataTables\Html\Column;
use Yajra\DataTables\Html\Editor\Editor;
use Yajra\DataTables\Html\Editor\Fields;
use Yajra\DataTables\Services\DataTable;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;

class SortiesDataTable extends DataTable
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
        ->editColumn('valid', function ($sortie) {
            return $sortie->valid ? '<i class="fas fa-check"></i>' : '';
        })
        ->editColumn('created_at', function ($sortie) {
            return formatDate($sortie->created_at);
        })
        ->editColumn('updated_at', function ($sortie) {
            return formatDate($sortie->updated_at);
        })
        ->addColumn('action', function ($sortie) {
            return $edit = '<a id="show" href="' . route('detail.sorties', $sortie->id) . '" class="btn btn-xs btn-info btn-block" title="Voir"><i class="fas fa-eye"></i></a>

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
                'sorties.edit',
                $sortie->id,
                'warning',
                __('Edit'),
                'edit'
            ). $this->button(
                'sorties.destroy',
                $sortie->id,
                'danger',
                __('Rendre'),
                'trash-alt',
                '',
                __('Voulez vous vraiment supprimer cette sortie?')
            );
        })
        ->rawColumns(['valid', 'action']);
    }

    /**
     * Get query source of dataTable.
     *
     * @param \App\Models\Sortie $model
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function query(Sortie $model)
    {
        if(Route::currentRouteNamed('sorties.indexnew')) {
            return $model->has('unreadNotifications');
        }

        $cod = Auth::user()->email;
        return $model->where(
            'email_users',
            $cod);
    }

    /**
     * Optional method if you want to use html builder.
     *
     * @return \Yajra\DataTables\Html\Builder
     */
   public function html()
{
    return $this->builder()
                ->setTableId('sorties-table')
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
            Column::make('code_reference_materielle_SORTIES')->title(__('Code Référence')),
            Column::make('quantite')->title(__('Quantite')),
            Column::make('email_users')->title(__('Email')),
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
        return 'Sorties_' . date('YmdHis');
    }
}
