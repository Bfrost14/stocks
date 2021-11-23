<?php

namespace App\DataTables;

use App\Models\Categorie;
use Yajra\DataTables\Html\Button;
use Yajra\DataTables\Html\Column;
use Yajra\DataTables\Html\Editor\Editor;
use Yajra\DataTables\Html\Editor\Fields;
use Yajra\DataTables\Services\DataTable;
use Illuminate\Support\Facades\Route;

class CategoriesDataTable extends DataTable
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
        ->editColumn('valid', function ($categorie) {
            return $categorie->valid ? '<i class="fas fa-check"></i>' : '';
        })
        ->editColumn('created_at', function ($categorie) {
            return formatDate($categorie->created_at);
        })
        ->editColumn('updated_at', function ($categorie) {
            return formatDate($categorie->updated_at);
        })
        ->addColumn('action', function ($categorie) {
            return $edit = '<a id="show" href="' . route('detail.catgories', $categorie->id) . '" class="btn btn-xs btn-info btn-block" title="Voir"><i class="fas fa-eye"></i></a>

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
            </script>'. $this->button(
                'categories.edit',
                $categorie->id,
                'warning',
                __('Edit'),
                'edit'
            ). $this->button(
                'categories.destroy',
                $categorie->id,
                'danger',
                __('supprimer'),
                'trash-alt',
                '',
                __('Voulez vous vraiment supprimer cette catégorie?')
            );
        })
        ->rawColumns(['valid', 'action']);
    }

    /**
     * Get query source of dataTable.
     *
     * @param \App\Models\Category $model
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function query(Categorie $model)
    {
        if(Route::currentRouteNamed('sorties.indexnew')) {
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
                ->setTableId('categories-table')
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
            Column::make('nom_categorie_CATEGORIES_ARTICLES')->title(__('Nom Catégorie')),
            Column::make('libelle_categorie_CATEGORIES_ARTICLES')->title(__('Libelle Categorie')),
            Column::make('created_at')->title(__('Creation')),
            Column::make('updated_at')->title(__('Modification')),
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
        return 'Categories_' . date('YmdHis');
    }
}
