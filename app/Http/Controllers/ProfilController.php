<?php

namespace App\Http\Controllers;

class ProfilController extends Controller
{
    protected array $candidate = [
        'name' => 'Paisal Patmal',
        'position' => 'IT Specialist',
        'photo' => '/images/profile.png',
    ];

    public function index()
    {
        return view('profile.index', [
            'candidate' => $this->candidate,
        ]);
    }
}
