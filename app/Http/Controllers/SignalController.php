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
        $reports = Report::with('comments')->get();
        return view('front.pages.index', ['reports' => $reports]);
    }

    public function store(Request $request)
    {
        // Valider les données du formulaire
        $validatedData = $request->validate([
            'location' => 'required',
            'description' => 'required',
            'region' => 'nullable',
            'latitude' => 'nullable|numeric',
            'longitude' => 'nullable|numeric',
        ]);

        // Créer un nouveau signalement
        $report = new Report;
        $report->location = $validatedData['location'];
        $report->description = $validatedData['description'];
        $report->region = $validatedData['region'];
        $report->latitude = $validatedData['latitude'];
        $report->longitude = $validatedData['longitude'];
        $report->save();

        // Rediriger l'utilisateur avec un message de confirmation
        return redirect()->route('acceuil')->with('success', 'Le signalement a été ajouté avec succès.');
    }

    public function show_signalement(Request $request)
    {
        // Afficher la page daccueil
        $reports = Report::with('comments')->get();
        return view('front.pages.signal', ['reports' => $reports]);
    }


    public function store_signalement(Request $request)
    {
        // Valider les données du formulaire
        $validatedData = $request->validate([
            'location' => 'required',
            'description' => 'required',
            'region' => 'nullable',
            'latitude' => 'nullable|numeric',
            'longitude' => 'nullable|numeric',
        ]);

        // Créer un nouveau signalement
        $report = new Report;
        $report->location = $validatedData['location'];
        $report->description = $validatedData['description'];
        $report->region = $validatedData['region'];
        $report->latitude = $validatedData['latitude'];
        $report->longitude = $validatedData['longitude'];
        $report->save();

        // Rediriger l'utilisateur avec un message de confirmation
        return redirect()->route('acceuil')->with('success', 'Le signalement a été ajouté avec succès.');
    }


    public function update(Request $request, Report $report)
    {
        $validatedData = $request->validate([
            'status' => 'required|in:En_attente,En_cours,Terminé',
        ]);
    
        $report->status = $validatedData['status'];
        $report->save();
    
        return redirect()->back()->with('success', 'Le statut du signalement a été mis à jour avec succès.');
    }
    
    
    public function destroy(Report $report)
    {

        try {

            $report = Report::where('id', $report->id)->firstOrFail();

            $report->delete();
            return redirect()->route('signalisations')->with('status', 'La signalisation a été supprimé avec succès.');
        } catch (\Exception $e) {

            return back()->with('error', 'Une erreur s\'est produite. Veuillez réessayer.');
        }
    }


    public function showcarte_signalement(Request $request)
    {
        // Afficher la carte des signalements
        $reports = Report::with('comments')->get();
        return view('front.pages.signalcarte', ['reports' => $reports]);
    }

    public function show_reportcomment($id)
    {
        try {
            $report = Report::findOrFail($id);
            return view('front.pages.reportcomment', compact('report'));
        } catch (ModelNotFoundException $e) {
            return redirect()->back();
        }
    }

    public function store_reportcommemt(Request $request)
    {
        // Valider les données du formulaire
        $validatedData = $request->validate([
            'report_id' => 'required|exists:reports,id',
            'name' => 'required',
            'comment' => 'required',
        ]);

        // Ajouter un nouveau commentaire
        $reportcomment = new ReportComment;
        $reportcomment->report_id = $validatedData['report_id'];
        $reportcomment->name = $validatedData['name'];
        $reportcomment->comment = $validatedData['comment'];
        $reportcomment->save();

        // Rediriger l'utilisateur vers la page du signalement avec un message de confirmation
        return redirect()->route('acceuil')->with('success', 'Le commentaire a été ajouté avec succès.');
    }
}
