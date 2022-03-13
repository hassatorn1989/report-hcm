<?php

namespace App\Http\Livewire;

use App\Models\view_menu;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;

class Sidebar extends Component
{
    public function render()
    {
        $menu = view_menu::with([
            'get_sub_menu' => function ($q) {
                if (Auth::user()->user_role != 'admin') {
                    $q->whereRaw("view_sub_menu.id in (select menu_id from tb_user_role where user_id = '" . Auth::user()->idx . "')");
                }
            }
        ])->orderBy('menu_priority', 'asc')->get();
        return view('livewire.sidebar', compact('menu'));
    }
}
