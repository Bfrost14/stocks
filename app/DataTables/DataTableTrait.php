<?php
namespace App\DataTables;
trait DataTableTrait
{
    public function badge($text, $type, $margin = 0)
    {
        return '<span class="badge badge-' . $type . ' ml-' . $margin . '">' . __($text) . '</span>';
    }
    public function button($route, $param, $type, $title, $icon,$id=null, $name = '', $target = '_self')
    {
        return '<a
                    id="'.$id.'"
                    title="'. $title . '"
                    data-name="' . $name . '"
                    href="' . route($route, $param) . '"
                    class="btn btn-xs btn-' . $type . '"
                    target="' . $target . '">
                    <i class="far fa-' . $icon . '"></i>
                </a>';
    }
}
