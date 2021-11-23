<?php

namespace App\DataTables;

use App\Models\Sort;
use Yajra\DataTables\Html\Button;
use Yajra\DataTables\Html\Column;
use Yajra\DataTables\Html\Editor\Editor;
use Yajra\DataTables\Html\Editor\Fields;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
use Yajra\DataTables\Services\DataTable;

class SortsDataTable extends DataTable
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

        ->rawColumns(['valid', 'action']);
    }

    /**
     * Get query source of dataTable.
     *
     * @param \App\Models\Sort $model
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function query(Sort $model)
    {
        if(Route::currentRouteNamed('sorts.indexnew')) {
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
        ->setTableId('sorts-table')
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
            Column::make('date_sortie_SORTIES')->title(__('Date de sortie')),
            Column::make('heure_sortie_SORTIES')->title(__('Heure')),
            Column::make('quantite')->title(__('Quantite')),
        ];
    }

    /**
     * Get filename for export.
     *
     * @return string
     */
    protected function filename()
    {
        return 'Sorts_' . date('YmdHis');
    }
}
