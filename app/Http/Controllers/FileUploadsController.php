<?php

namespace App\Http\Controllers;

// require_once 'vendor/autoload.php';

// use Google\Cloud\Speech\V1\SpeechClient;
// use Google\Cloud\Speech\V1\RecognitionAudio;
// use Google\Cloud\Speech\V1\RecognitionConfig;
// use Google\Cloud\Speech\V1\RecognitionConfig\AudioEncoding;

use Illuminate\Http\Request;
use Illuminate\Support\Str;
use App\FileUploads;

class FileUploadsController extends Controller
{
    public function saveBlob(Request $request)
    {
        dd($request->all());
        
        $data=$request->validate([
            'interview_id'=>'nullable',
            'candidate_id'=>'required',
            'video-blob' => 'required|file|mimetypes:video/webm|max:800000'
        ]);

        if ($request->has('video-blob')) {
            $name = Str::random(4).time().$request->file('video-blob')->getClientOriginalName();
            $destination = public_path().'/InterviewSessions';
            $path='/InterviewSessions/'.$name;
            $request->file('video-blob')->move($destination, $name);
            $data['video-blob'] =$path;
        }

        if(FileUploads::create($data)){

            return response()->json(['success_info' => 'Your entry was recieved']);
        }

        // try {
        //     $videoFile = 'video-filename';
         
        //     // change these variables if necessary
        //     $encoding = AudioEncoding::LINEAR16;
        //     $languageCode = 'en-US';
         
        //     // get contents of a file into a string
        //     $content = file_get_contents($videoFile);
         
        //     // set string as audio content
        //     $audio = (new RecognitionAudio())
        //         ->setContent($content);
         
        //     // set config
        //     $config = (new RecognitionConfig())
        //         ->setEncoding($encoding)
        //         ->setLanguageCode($languageCode);
         
        //     // create the speech client
        //     $client = new SpeechClient();
         
        //     // create the asyncronous recognize operation
        //     $operation = $client->longRunningRecognize($config, $audio);
        //     $operation->pollUntilComplete();
         
        //     if ($operation->operationSucceeded()) {
        //         $response = $operation->getResult();
         
        //         // each result is for a consecutive portion of the audio. iterate
        //         // through them to get the transcripts for the entire audio file.
        //         $final_transcript = '';
        //         foreach ($response->getResults() as $result) {
        //             $alternatives = $result->getAlternatives();
        //             $mostLikely = $alternatives[0];
        //             $final_transcript .= $mostLikely->getTranscript();
        //         }
         
        //         $name = Str::random(4).time().$request->file($final_transcript)->getClientOriginalName();
        //         $destination = public_path().'/ConvertedFiles';
        //         $path='/ConvertedFiles/'.$name;
        //         $request->file($final_transcript)->move($destination, $name);
        //         $data['file'] = $path;
         
        //         header('Content-Description: File Transfer');
        //         header('Content-Disposition: attachment; filename='.basename($file));
        //         header('Expires: 0');
        //         header('Cache-Control: must-revalidate');
        //         header('Pragma: public');
        //         header('Content-Length: ' . filesize($file));
        //         header("Content-Type: text/plain");
        //         readfile($file);
        //         exit();
        //     } else {
        //         print_r($operation->getError());
        //     }
         
        //     $client->close();
        // } catch(Exception $e) {
        //     echo $e->getMessage();
        // }
    }


}
