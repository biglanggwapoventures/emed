<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class DownloadsController extends Controller
{
    public function getDownload()
    {
     
        return response()->download(storage_path("app/public/downloads/localhost.jar"));
	}
}
