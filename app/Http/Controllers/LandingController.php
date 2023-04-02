<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Symfony\Component\Process\Process;
use Symfony\Component\Process\Exception\ProcessFailedException;

class LandingController extends Controller
{
    public function search(Request $request)
    {
        $query = $request->input('q');
        $rank = $request->input('rank');

        $process = new Process("python3 query.py cerpen.json {$rank} \"{$query}\"");
        $process->run();

        // executes after the command finishes
        if (!$process->isSuccessful()) {
            throw new ProcessFailedException($process);
        }

        $list_data = array_filter(explode("\n",$process->getOutput()));
        
        $data = array();

        foreach ($list_data as $book) {
            $dataj =  json_decode($book, true);
            array_push($data, '
            <div class="col-lg-5">
                <div class="card mb-2">
                    <div class="card-body">
                        <h6 class="card-title"><a href="'.$dataj['judul-href'].'">'.$dataj['judul'].'</a></h6>
                        <p class="card-text text-success">'.$dataj['karya'].'</p>
                    </div>
                </div>
            </div>
            ');
        }
        echo json_encode($data);
    }
}
