<?php

namespace App\Http\Controllers;

use App\Models\Sortie;
use Illuminate\Http\Request;

class CalculsController extends Controller
{
    public function index(Sortie $sorty){
        Sortie::find($sorty->id)->update(["email_users" => $sorty->email_users." épuisé"]);
        return back()->with(['ok' => __('Article epuisé supprimé.')]);
    }
}
