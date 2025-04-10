<?php

namespace App\Http\Controllers;

use App\Models\Product;

use App\Models\WpCf7Submit;
use Illuminate\Http\Request;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;


class HomeController extends Controller
{
    public function index()
    {
       return view('home');
    }

    public function loadMoreProducts()
    {
        $products = Product::paginate(60);

        $productHtml = view('partials.product_list', ['products' => $products])->render();

        return response()->json([
            'product_html' => $productHtml,
            'next_page_url' => $products->nextPageUrl(),
            'has_more' => $products->hasMorePages(),
        ]);
    }


    public function submitContactForm(Request $request)
    {
        $formId = 602;
        $submitTime = Carbon::now();

        // Prepare data with cfdb7_status
        $formFields = array_merge(
            ['cfdb7_status' => 'unread'],
            $request->except('_token')
        );



        $a = WpCf7submit::insert([
            'form_post_id' => $formId,
            'form_value' => serialize($formFields),
            'form_date' => $submitTime,
        ]);

        dd($a);

        return redirect()->back()->with('success', 'Form submitted and saved to WordPress. '. $a);
    }
}



