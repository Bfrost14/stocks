<?php

namespace App\DataTables;

use App\Models\Article;
use App\Http\Controllers\Back\ArticlesController\limite;
use App\Models\Categorie;
use Yajra\DataTables\Html\Button;
use Yajra\DataTables\Html\Column;
use Yajra\DataTables\Html\Editor\Editor;
use Yajra\DataTables\Html\Editor\Fields;
use Yajra\DataTables\Services\DataTable;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
use Symfony\Polyfill\Ctype\Ctype;

class ArticlesDataTable extends DataTable
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
        ->editColumn('created_at', function ($article) {
            return formatDate($article->created_at);
        })
        ->editColumn('updated_at', function ($article) {
            return formatDate($article->updated_at);
        })
        ->addColumn('Stock d\'alerte', function ($article){
            $message = "";
            if($article->quantite_Article <= 15 && $article->quantite_Article >= 0){
                return $message = "Nombre Article faible";
            }elseif($article->quantite_Article == 0){
                return $message = "Nombre Article épuisé";
            }else{
                return $message = " Nombre Article suffisant";
            }
        })
        ->addColumn('action', function ($article) {
            return $edit = '<a id="show" href="' . route('detail.articles', $article->id) . '" class="btn btn-xs btn-info btn-block" title="Voir"><i class="fas fa-eye"></i></a>

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
                'articles.edit',
                $article->id,
                'warning',
                __('Edit'),
                'edit'
            ). $this->button(
                'articles.destroy',
                $article->id,
                'danger',
                __('supprimer'),
                'trash-alt',
                '',
                __('Voulez vous vraiment supprime cet article?')
            );
        })
        ->rawColumns(['valid', 'action']);
    }

    /**
     * Get query source of dataTable.
     *
     * @param \App\Models\Article $model
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function query(Article $model)
    {
        if(Route::currentRouteNamed('articles.indexnew')) {
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
        ->setTableId('article-table')
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
            Column::make('nom_article_ARTICLES')->title(__('Nom Article')),
            Column::make('quantite_Article')->title(__('Quantité')),
            Column::make('date_Entree_Articles')->title(__('Date Entrée')),
            Column::computed('Stock d\'alerte')->title(__('Stock d\'alerte'))->addClass('align-middle text-center'),
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
        return 'Articles_' . date('YmdHis');
    }
}
