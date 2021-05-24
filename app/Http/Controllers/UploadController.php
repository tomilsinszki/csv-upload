<?php

namespace App\Http\Controllers;

use Doctrine\ORM\EntityManager;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class UploadController extends Controller
{
    /**
     * @var EntityManager
     */
    private $entityManager;

    /**
     * @param EntityManager $entityManager
     */
    public function __construct(EntityManager $entityManager)
    {
        $this->entityManager = $entityManager;
    }

    public function selectFile()
    {
        return view('selectFile');
    }

    public function uploadFile(Request $request)
    {
        $data = array();

        $validator = Validator::make($request->all(), [
            'file' => 'required|mimes:csv|max:2048'
        ]);

        if ($validator->fails()) {
            $data['success'] = 0;
            $data['error'] = $validator->errors()->first('file');
        } else {
            if($request->file('file')) {
                $file = $request->file('file');
                $extension = $file->getClientOriginalExtension();
                $fileName = time() . '_' . uniqid() . '.' . $extension;
                $location = 'files';
                $file->move($location, $fileName);
                $filePath = url("files/$fileName");

                $data['success'] = 1;
                $data['message'] = 'Uploaded Successfully!';
                $data['filepath'] = $filePath;
                $data['extension'] = $extension;
            } else {
                $data['success'] = 2;
                $data['message'] = 'File not uploaded.';
            }
        }

        return response()->json($data);
    }

    public function processFile(Request $request)
    {
        //echo public_path();exit();

        $fileName = $request->file ?? null;

        if (empty($fileName)) {
            // TODO: show error message
            exit();
        }

        $publicFolderPath = public_path();
        $filePath = "$publicFolderPath/files/$fileName.csv";

        $sampleRows = array();

        $rowNumber = 0;
        if (($handle = fopen($filePath, "r")) !== FALSE) {
            while (($data = fgetcsv($handle, 0, ",")) !== FALSE) {
                if (3 <= $rowNumber) {
                    break;
                }

                $sampleRows[] = $data;


                /*
                $num = count($data);
                echo "<p> $num fields in line $rowNumber: <br /></p>\n";
                for ($c=0; $c < $num; $c++) {
                    echo $data[$c] . "<br />\n";
                }
                */

                $rowNumber++;
            }
            fclose($handle);
        }

        print_r($sampleRows);
        exit();
    }
}
