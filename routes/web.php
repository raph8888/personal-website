<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| This file is where you may define all of the routes that are handled
| by your application. Just tell Laravel the URIs it should respond
| to using a Closure or controller method. Build something great!
|
*/

Route::get("/", function () {

    $brokers = [];
    $fees = [];

    $quotes = [
        "Do what you love, and period",
        "Listen to everyone - Trust the ones you admire - Follow your heart",
        "It's not what they call you. It's what you answer to.",
        "#govegan",
        "Learn a vegan recipe!",
        "Plenitude can be found in the smallest things",
        "Wear sunscreen",
        "Your dreams don't work if you don't",
        "The hour is darkest before the dawn",
        "Per aspera ad astra"
    ];

    // Test database connection
    try {
        DB::connection()->getPdo();

        $brokers = DB::select("select * from cryptofx");
        $fees = DB::select("select * from fees");

    } catch (\Exception $e) {
        error_log("Database error: " . $e->getMessage());
    }


    $data = [
        "brokers" => $brokers,
        "fees" => $fees,
        "quote" => $quotes[array_rand($quotes)]
    ];

    return view("homepage", $data);
});
