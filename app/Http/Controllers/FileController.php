<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\FileDetails;
use Illuminate\Support\Facades\Storage;



class FileController extends Controller
{
    const INDEX_PREVIEW = '_preview';
    const UPLOADS = 'public/uploads/';
    const ONPAGE = 20;

    private $uploads;


    public function __construct()
    {
        $this->uploads = Storage::path(self::UPLOADS);
    }

    public function upload(Request $request, $document = null)
    {
        $path = $request->file('image')->store('uploads', 'public');

        $fileName = pathinfo($path, PATHINFO_FILENAME);
        $fileExt = pathinfo($path, PATHINFO_EXTENSION);
        $file = $fileName .'.'. $fileExt;
        $preview = $fileName . self::INDEX_PREVIEW .'.jpg';

        $FileDetails = new FileDetails;
        $FileDetails->name = $file;
        $FileDetails->preview = $preview;
        $FileDetails->file = $document;
        $FileDetails->save();

        $pdf = $this->uploads . $file;
        $this->makePreview($pdf);

    }

    public function getAll(){

//        $page = 1;
        $page = $_GET['page'];
        if (is_numeric($page) and $page != 0){
            $first = $page * self::ONPAGE - self::ONPAGE;
            $last = $page * self::ONPAGE - 1;
        } else {
            $first = 0;
            $last = self::ONPAGE;
        }

        $files = FileDetails::all();

        foreach ($files as $key => $file) {
            $answer[$key]['pdf'] = $file->name;
            $answer[$key]['preview'] = $file->preview;
            $answer[$key]['original'] = $file->file;
        }

        $pages = ceil(count($answer) / self::ONPAGE);
        $answer=array_intersect_key($answer,array_fill_keys(range($first, $last),''));

        $answer = [
            'data' => $answer,
            'pages' => $pages,
            ];

        $answer = json_encode($answer);
        return $answer;

    }

    public function getDocumentJpg($document){

        $file = $document;
        $file = $this->uploads.$file;

        $image = imagecreatefromjpeg($file);
        header("Content-type: image/jpg");
        imagejpeg($image);
    }

    public function getDocumentPdf($document){

        $file = $document;
        $file = $this->uploads.$file;

        header("Content-type: application/pdf");
        readfile($file);
    }

    public function delDocumentPdf($document){

        FileDetails::where('name', $document)->delete();
        return 'Deleted files: ' . $document;
    }


    private function makePreview($pdf)
    {

        $fileName = pathinfo($pdf, PATHINFO_FILENAME);
        $filePath = pathinfo($pdf, PATHINFO_DIRNAME);
        $preview = $filePath .'/'. $fileName . self::INDEX_PREVIEW . '.jpg';

        $im = new \Imagick();
        $im->readImage($pdf);
        $im->setIteratorIndex(0);
        $im->writeImage($preview);

    }

}
