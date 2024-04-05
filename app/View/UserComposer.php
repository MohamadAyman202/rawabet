<?php

namespace App\View;

use Illuminate\View\View;

class UserComposer
{
    public function __construct()
    {
        //
    }


    public function compose(View $view): void
    {
        $view->with("user", auth()->user());
    }
}
