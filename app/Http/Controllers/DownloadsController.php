<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class DownloadsController extends Controller
{
    public function getDownload()
    {
        //PDF file is stored under project/public/download/info.pdf
  //      $file= public_path(). "\downloads\localhost.jar";

  //   	$headers = [ 'Content-Type' => 'application/java-archive',];

		// return response()->download($file, 'localhost.jar', $headers);

		// return response()->download(public_path('downloads\localhost.jar'));

		// $filename = public_path("downloads/localhost.jar");
  //       $headers = ['Content-Type: application/java-archive'];
  //       $newName = 'rfid-'.time().'.jar';

       // return response()->download($myFile, $newName, $headers);
        return response()->download(storage_path("app/public/downloads/localhost.jar"));
	}
}
