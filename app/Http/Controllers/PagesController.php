<?php

namespace App\Http\Controllers;

use Mail;
use App\Models\Post;
use App\Models\User;
use App\Models\Report;
use App\Models\Contact;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class PagesController extends Controller
{

    public function index(Request $request)
    {
        $posts = Post::with('category', 'user')->latest()->take(3)->get();
        return view('front.pages.index', compact('posts'));
    }

    public function dashboard()
    {
        $categories = Category::all();
        $posts = Post::where('user_id', Auth::id())->get();
        $posts_count = Post::where('user_id', Auth::id())->count();
        $category_count = Category::count();
        

        return view('back.pages.home', compact('categories', 'posts','posts_count','category_count'));
    }

    public function dashboard_publications()
    {
        $categories = Category::whereNotIn('id', [1])->latest()->take(7)->get();

        $user = User::findOrFail(Auth::id());
        $posts = $user->posts()
            ->with('category')
            ->latest()
            ->take(6)
            ->get();

        return view('back.pages.publications', compact('categories', 'posts'));
    }

    public function dashboard_signalisations()
    {
        $reports = Report::all();
        return view('back.pages.signalisations', compact('reports'));
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

    // Contact and support send
    public function contactSend(Request $request)
    {
        try {
            // Form validation
            $this->validate($request, [
                'name' => 'required',
                'email' => 'required|email',
                'phone' => 'required|regex:/^([0-9\s\-\+\(\)]*)$/|min:11',
                'subject' => 'required',
                'message' => 'required'
            ]);
            //  Store data in database
            Contact::create($request->all());

            //  Send mail to admin
            Mail::send('mail', array(
                'name' => $request->get('name'),
                'email' => $request->get('email'),
                'phone' => $request->get('phone'),
                'subject' => $request->get('subject'),
                'user_query' => $request->get('message'),
            ), function ($message) use ($request) {
                $message->from($request->email);
                $message->to('contact@signalgo.com', 'Admin')->subject($request->get('subject'));
            });

            return back()->with('success', 'Nous avons reçu votre message. Merci !');
        } catch (\Exception $e) {
            // Handle exception
            return back()->with('error', 'Une erreur est survenue lors de l\'envoi du message. Veuillez verifer vos informations et réessayer');
        }
    }

    // Contact
    public function contact(Request $request)
    {
        return view('front.pages.contacts.contact');
    }

    // Support
    public function support(Request $request)
    {
        return view('front.pages.contacts.support');
    }

    // A Propos
    public function aPropos(Request $request)
    {
        return view('front.pages.default.aPropos');
    }

    // foireAuxQuestions
    public function foireAuxQuestions(Request $request)
    {
        return view('front.pages.default.foireAuxQuestions');
    }

    // conditionsDeVente
    public function conditionsDeVente(Request $request)
    {
        return view('front.pages.default.conditionsDeVente');
    }

    // droitsDauteur
    public function doitsDauteur(Request $request)
    {
        return view('front.pages.default.doitsDauteur');
    }

    // commentCaMarche
    public function commentCaMarche(Request $request)
    {
        return view('front.pages.default.commentCaMarche');
    }

    // termesEtConditions
    public function termesEtConditions(Request $request)
    {
        return view('front.pages.default.termesEtConditions');
    }

    // politiqueDeConfidentialite
    public function politiqueDeConfidentialite(Request $request)
    {
        return view('front.pages.default.politiqueDeConfidentialite');
    }
}
