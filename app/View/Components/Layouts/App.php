<?php

namespace App\View\Components\Layouts;

use App\User;
use Illuminate\View\Component;
use Illuminate\Support\Facades\Auth;

class App extends Component
{
    /**
     * Create a new component instance.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\View\View|string
     */
    public function render()
    {
        return view('components.layouts.app', [
            'user' => Auth::user()
        ]);
    }
}
