<?php

namespace App\Http\Controllers;

use App\Models\Newsletter;
use App\Http\Requests\StoreNewsletterRequest;
use App\Http\Requests\UpdateNewsletterRequest;
use App\Notifications\MailNewsletter;

class NewsletterController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreNewsletterRequest $request)
    {
        try {
            $newsletter = new Newsletter();
            dd($newsletter);
            $newsletter->email = $request->email;
            if ($newsletter->save()) {
                $newsletter->notify(new MailNewsletter());
                return response()->json([
                    'status_code' => 200,
                    'status_message' => 'Newsletter enregistrer avec success',
                    'data' => $newsletter
                ]);
            } else {
                return abort('403');
            }
        } catch (\Exception $e) {

            return response()->json($e);
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(Newsletter $newsletter)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Newsletter $newsletter)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateNewsletterRequest $request, Newsletter $newsletter)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Newsletter $newsletter)
    {
        //
    }
}
