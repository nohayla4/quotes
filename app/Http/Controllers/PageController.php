<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use App\Models\Quote;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session; 
use Illuminate\Validation\Rule;

class PageController extends Controller
{
    public function index(){

        if (Auth::check()) {

            $user = Auth::user();
            $quotes = $user->quotes;

        } else {
            $quotes = [];
        }
    
        $breeds = Http::get('https://api.kanye.rest/')['quote'];
    
        return view('index', compact(['breeds', 'quotes']));

    }

    public function add($qt){

        if(DB::table('quotes')->where('content', $qt)->where('user_id', Auth::id())->exists()) {
            
            return back()->withErrors(['message' => 'Quote already existe !!']);
        }
        $quote = new Quote();
        $quote->content = $qt;
        // $quote->user_id = Auth::id();
        // $quote->save();
        // Auth::user()->quotes()->save($quote);
        $quote->user()->associate(Auth::user())->save();

        Session::flash('status', 'Quote was added!!');

        return redirect('/home');
    }

    public function destroy(Quote $quote)
    {
        $quote->delete();

        Session::flash('status', 'Quote was deleted!!');

        return redirect('/home');
    }
}
