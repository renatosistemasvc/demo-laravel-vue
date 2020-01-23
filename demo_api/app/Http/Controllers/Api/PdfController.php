<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Services\PdfService;


class PdfController extends Controller
{

    public function __construct(PdfService $pdfService){

        $this->pdfService = $pdfService;
    }

    public function getRequerimentoMatricula(Request $request){

        $num_matricula = json_decode($request->input('param'), true);

        $res = $this->pdfService->getRequerimentoMatricula($num_matricula);
        return $res;
    }

    public function getAtestadoTransferencia(Request $request){

        $array = json_decode($request->input('param'), true);
        
        $res = $this->pdfService->getAtestadoTransferencia($array);
        return $res;
    }   
    
    public function getRelatorioGeralAluno(Request $request){

        $array = json_decode($request->input('param'), true);

        $res = $this->pdfService->getRelatorioGeralAluno($array);
        return $res;
    }   

    public function getRelatorioPreMatricula(Request $request){

        $array = json_decode($request->input('param'), true);

        $res = $this->pdfService->getRelatorioPreMatricula($array);
        return $res;
    }

}
