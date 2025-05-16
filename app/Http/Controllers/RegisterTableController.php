<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Register;

class RegisterTableController extends RegisterController
{
    public function showTable(){
        $registers = Register::all();
        return view('registers.table', compact('registers'));
    }
     
    public function index(Request $request)
    {
        $search = $request->input('search');    

        $registers = Register::when($search, function ($query, $search){
            return $query->where('name', 'like', "%{$search}%")
            ->orWhere('email', 'like', "%{$search}%")
            ->orWhere('city', 'like', "%{$search}%")
            ->orWhere('country', 'like', "%{$search}%");
        })->paginate(5);
        return view('registers.table', compact('registers'));
    }
}
