<?php

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Session;
use App\Http\Controllers\PostController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\PagesController;
use App\Http\Controllers\SignalController;

Route::get('locale/{locale}', function ($locale) {
    Session::put('locale', $locale);
    return redirect()->back();
});

Route::any('/register', function () {
    return  view('auth.pages.login');
});



Route::get('/', [SignalController::class, 'index'])->name('acceuil');

//Reports
Route::post('/', [SignalController::class, 'store'])->name('reports.store');

Route::get('/signalement/{id}/commenter', [SignalController::class, 'show_reportcomment'])->name('reportcomment.show');
Route::post('/signalement/{id}/enregistrer-commentaire', [SignalController::class, 'store_reportcommemt'])->name('reportcomment.store');

Route::get('/signalement', [SignalController::class, 'show_signalement'])->name('signalement.show');
Route::post('/signalement/enregistrer', [SignalController::class, 'store_signalement'])->name('signalement.store');

//affichage de la carte
Route::get('/signalements/map', [SignalController::class, 'showcarte_signalement'])->name('signalement.carteshow');

// Route::get('tableau-de-bord/publications/{post}/modifier', [PostController::class, 'edit'])->name('article.edit');
// Route::put('tableau-de-bord/publications/{post}/update', [PostController::class, 'update'])->name('article.update');
// Route::get('tableau-de-bord/publications/{post}/supprimer', [PostController::class, 'destroy'])->name('article.destroy');

Route::get('blog', [PostController::class, 'index'])->name('blog');
Route::get('blog/articles/{post}', [PostController::class, 'show'])->name('article.show');
Route::get('blog/categories/{category}', [CategoryController::class, 'show'])->name('category.show');

Route::middleware(['auth', 'verified'])->group(function () {

    //Dashboard
    Route::get('tableau-de-bord', [PagesController::class, 'dashboard'])->name('dashboard');
    Route::get('tableau-de-bord/publications', [PagesController::class, 'dashboard_publications'])->name('publications');
    Route::get('tableau-de-bord/signalisations', [PagesController::class, 'dashboard_signalisations'])->name('signalisations');

    //User account
    Route::get('tableau-de-bord/mon-compte', function () {
        return view('back.pages.profil.edit');
    })->name('editProfil');
    //update password
    Route::get('tableau-de-bord/mot-de-passe/modifier', function () {
        return view('back.pages.profil.password-update');
    })->name('passwordMaj');

    //Post
    Route::get('tableau-de-bord/publications/ajouter', [PostController::class, 'create'])->name('article.create');
    Route::post('tableau-de-bord/publications/enregistrer', [PostController::class, 'store'])->name('article.store');
    Route::get('tableau-de-bord/publications/{post}/modifier', [PostController::class, 'edit'])->name('article.edit');
    Route::put('tableau-de-bord/publications/{post}/update', [PostController::class, 'update'])->name('article.update');
    Route::get('tableau-de-bord/publications/{post}/supprimer', [PostController::class, 'destroy'])->name('article.destroy');


    //signalisations
    Route::get('tableau-de-bord/signalisations/{report}/supprimer', [SignalController::class, 'destroy'])->name('signalisation.destroy');
    Route::put('tableau-de-bord/signalisations/{report}/update', [SignalController::class, 'update'])->name('signalisation.update');


    //Post categories
    Route::get('tableau-de-bord/categories/ajouter', [CategoryController::class, 'create'])->name('category.create');
    Route::post('tableau-de-bord/categories/enregistrer', [CategoryController::class, 'store'])->name('category.store');
    Route::get('tableau-de-bord/categories/{category}/modifier', [CategoryController::class, 'edit'])->name('category.edit');
    Route::put('tableau-de-bord/categories{category}/update', [CategoryController::class, 'update'])->name('category.update');
    Route::get('tableau-de-bord/categories/{category}/supprimer', [CategoryController::class, 'destroy'])->name('category.destroy');
});

Route::controller(PagesController::class)->group(function () {
    //Contact
    Route::get('contactez-nous', 'contact')->name('contact');
    Route::post('contactez-nous', 'contactSend')->name('contact.send');
    //Support
    Route::get('support', 'support')->name('support');
    Route::post('support', 'contactSend')->name('support.send');
    //A Propos
    Route::get('a-propos', 'aPropos')->name('aPropos');
    //FAQ
    Route::get('foire-aux-questions', 'foireAuxQuestions')->name('foireAuxQuestions');
    //Conditions de vente
    Route::get('conditions-de-vente', 'conditionsDeVente')->name('conditionsDeVente');
    //Conditions de vente
    Route::get('droits-dauteur', 'conditionsDeVente')->name('doitsDauteur');
    //Comment ca marche
    Route::get('comment-ca-marche', 'commentCaMarche')->name('commentCaMarche');
    //Termes et conditions
    Route::get('termes-et-conditions', 'termesEtConditions')->name('termesEtConditions');
    //Politique de confidentialité
    Route::get('politique-de-confidentialite', 'politiqueDeConfidentialite')->name('politiqueDeConfidentialite');
});
