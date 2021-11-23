<?php

namespace App\DataTables;

use App\Models\Conserver;
use Yajra\DataTables\Html\Button;
use Yajra\DataTables\Html\Column;
use Yajra\DataTables\Html\Editor\Editor;
use Yajra\DataTables\Html\Editor\Fields;
use Yajra\DataTables\Services\DataTable;
use Illuminate\Support\Facades\Route;

class ConserversDataTable extends DataTable
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
        ->editColumn('valid', function ($conserver) {
            return $conserver->valid ? '<i class="fas fa-check"></i>' : '';
        })
        ->editColumn('created_at', function ($conserver) {
            return formatDate($conserver->created_at);
        })
        ->editColumn('updated_at', function ($conserver) {
            return formatDate($conserver->updated_at);
        })
        
        ->rawColumns(['valid', 'action']);
    }

    /**
     * Get query source of dataTable.
     *
     * @param \App\Models\Conserver $model
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function query(Conserver $model)
    {
        if(Route::currentRouteNamed('conservers.indexnew')) {
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
        ->setTableId('conservers-table')
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
            Column::make('duree_CONSERVER')->title(__('Durée de conservation')),
        ];
    }

    /**
     * Get filename for export.
     *
     * @return string
     */
    protected function filename()
    {
        return 'Conservers_' . date('YmdHis');
    }
}
