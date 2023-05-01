<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\Menu;
use Illuminate\Http\Request;

class StatusController extends Controller
{
    public function change($name)
    {
        $status = Menu::where('name', $name)->value('status');
        if ($status == 1) {
            Menu::where('name', $name)->update(['status' => 0]);
        } else {
            Menu::where('name', $name)->update(['status' => 1]);
        }
        return redirect()->back();
    }
}
