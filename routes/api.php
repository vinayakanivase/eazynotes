<?php

use Illuminate\Http\Request;

Route::middleware('auth:api')->group(function () {

    //--------------------------------------------------------------------------
    // current user
    //--------------------------------------------------------------------------
    Route::get('me', function (Request $request) {
        return $request->user();
    });

    //--------------------------------------------------------------------------
    // notes for current user
    //--------------------------------------------------------------------------
    Route::resource('notes', 'NoteController')->except([
        'create', 'edit', 'show'
    ]);

});
