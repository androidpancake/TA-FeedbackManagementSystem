<?php

namespace App\Http\Controllers\Mahasiswa;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class FeedbackController extends Controller
{
    public function index()
    {
        return view('mahasiswa.feedback.index');
    }

    public function create()
    {
        # code...
    }

    public function store()
    {
        # code...
    }
}
