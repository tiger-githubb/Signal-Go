<?php

namespace App\Http\Controllers;

use App\Models\Report;
use Illuminate\Http\Request;
use App\Models\ReportComment;

class SignalController extends Controller
{
    public function index(Request $request)
    {
        // Afficher la page daccueil
        $reports = Report::all();
        return view('front.pages.index', ['reports' => $reports]);
    }

    public function store(Request $request)
    {
        // Valider les données du formulaire
        $validatedData = $request->validate([
            'location' => 'required',
            'description' => 'required',
        ]);

        // Créer un nouveau signalement
        $report = new Report;
        $report->location = $validatedData['location'];
        $report->description = $validatedData['description'];
        $report->save();

        // Rediriger l'utilisateur avec un message de confirmation
        return redirect()->route('acceuil')->with('success', 'Le signalement a été ajouté avec succès.');
    }

    public function addComment(Request $request)
    {
        // Valider les données du formulaire
        $validatedData = $request->validate([
            'report_id' => 'required|exists:reports,id',
            'name' => 'required',
            'comment' => 'required',
        ]);
    
        // Ajouter un nouveau commentaire
        $comment = new ReportComment;
        $comment->report_id = $validatedData['report_id'];
        $comment->name = $validatedData['name'];
        $comment->comment = $validatedData['comment'];
        $comment->save();
    
        // Rediriger l'utilisateur vers la page du signalement avec un message de confirmation
        return redirect()->route('reports.show', ['id' => $validatedData['report_id']])->with('success', 'Le commentaire a été ajouté avec succès.');
    }

    public function show_reportcomment(Request $report){
        
    }

    public function store_reportcommemt(Request $report){

    }
    
    
    
}
