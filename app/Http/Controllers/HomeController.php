<?php

namespace App\Http\Controllers;

use App\Mail\AppMailer;
use App\Models\Product;

use App\Models\WpCf7Submit;
use Illuminate\Http\Request;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Mail;


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

        Mail::to('bilal.colabarmy@gmail.com')->send(new AppMailer(
            subjectLine: 'Welcome to the App!',
            viewName: 'emails.contact',
            viewData: [
                'userName' => 'John Doe',
                'messageLine' => 'Thanks for signing up with us.',
                'ctaLink' => 'https://yourapp.com/get-started',
                'ctaText' => 'Get Started',
            ]
        ));


        return redirect(route('checkout.thankyou'))->with([
            'title' => 'Thank you for contacting us. One of our team members will reach out to you shortly.',
            'message' => "Don’t want to wait? Call us now (800) 992-6924 \n Hours: Monday to Friday 8:30AM – 5:00PM"
        ]);
    }
}



