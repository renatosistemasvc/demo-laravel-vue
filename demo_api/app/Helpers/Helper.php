<?php
namespace App\Helpers;
use Config;

class Helper
{

    public static function getCursoNacional($cod){

		switch($cod) {
            case 1:
                return "CRECHE 1 ANO";
            break;
            case 2:
                return "CRECHE 2 ANOS";
            break;
            case 3:
                return "CRECHE 3 ANOS";
            break;
            case 4:
                return "ECUCAÇÃO INFANTIL - 04 ANOS";
            break;
            case 5:
                return "ECUCAÇÃO INFANTIL - 05 ANOS";
            case 6:
                return "1º ANO";
            case 7:
                return "2º ANO";
            case 8:
                return "3º ANO";
            case 9:
                return "4º ANO";
            case 10:
                return "5º ANO";
            case 11:
                return "6º ANO";
            case 12:
                return "7º ANO";
            case 13:
                return "8º ANO";
            case 14:
                return "9º ANO";
            break;
            default:
                return "";
        }
    }

    public static function getTurno($cod){

		switch($cod) {
            case 0:
                return "MATUTINO";
            break;
            case 1:
                return "VESPERTINO";
            break;
            case 2:
                return "NOTURNO";
            break;
            case 4:
                return "INTEGRAL";
            break;
            default:
                return "";
        }
    }

    public static function getSituacaoMatricula($cod){

		switch($cod) {
            case 0:
                return "PENDENTE";
            break;
            case 1:
                return "ATIVA";
            break;
            case 2:
                return "EM TRANSFERÊNCIA";
            break;
            case 3:
                return "FECHADA (OCULTADA)";
            break;
            case 4:
                return "CONCLUÍDA";
            break;
            case 5:
                return "CANCELADO";
            break;
            case 5:
                return "INATIVO";
            break;
            case 5:
                return "TRANSFERIDO";
            break;
            case 5:
                return "RECLASSIFICACA";
            break;
            case 5:
                return "REALOCADO";
            break;
            case 5:
                return "EVADIDO";
            break;
            case 5:
                return "DESISTENTE";
            break;
            case 5:
                return "FECHADA";
            break;
            case 5:
                return "RENOVADA";
            break;
            case 5:
                return "NÃO CONCLUÍDO";
            break;
            default:
                return "";
        }
    }


    public static function getSituacaoAcademica($cod){

		switch($cod) {
            case 0:
                return "ABERTO";
            break;
            case 1:
                return "APROVADO";
            break;
            case 2:
                return "CONSERVADO";
            break;
            case 3:
                return "EVADIDO";
            break;
            case 4:
                return "DESISTENTE";
            break;
            case 5:
                return "FALECIDO";
            break;
            default:
                return "";
        }
    }

    public static function getRacaCor($ref){

		switch($ref) {
            case 0:
                return "NÃO DECLARADA";
            break;
            case 1:
                return "BRANCA";
            break;
            case 2:
                return "PRETA";
            break;
            case 3:
                return "PARDA";
            break;
            case 4:
                return "AMARELA";
            break;
            case 5:
                return "INDÍGENA";
            break;
            default:
                return "";

        }
    }

    public static function getSexo($ref){

		switch($ref) {
            case 0:
                return "MASCULINO";
            break;
            case 1:
                return "FEMININO";
            break;
            default:
                return "";

        }
    }

    public static function validCPF($cpf = null) {

        if(empty($cpf))
            return false;

        $cpf = preg_replace("/[^0-9]/", "", $cpf);
        $cpf = str_pad($cpf, 11, '0', STR_PAD_LEFT);

        if(strlen($cpf) != 11){

            return false;

        }elseif($cpf == '00000000000' || $cpf == '11111111111' || $cpf == '22222222222' || $cpf == '33333333333' || $cpf == '44444444444' || $cpf == '55555555555' || $cpf == '66666666666' || $cpf == '77777777777' || $cpf == '88888888888' || $cpf == '99999999999') {

            return false;

        }else{

            for ($t = 9; $t < 11; $t++) {

                for ($d = 0, $c = 0; $c < $t; $c++) {
                    $d += $cpf{$c} * (($t + 1) - $c);
                }
                $d = ((10 * $d) % 11) % 10;
                if ($cpf{$c} != $d) {
                    return false;
                }
            }

            return true;
        }
    }

    public static function validNome($nome){

        //SE O NOME POSSUI CARACTERE ESPECIAL
        if((preg_match('/[\'^£$%&*()}{@#~?><>,|=_+¬-]/', $nome)))
            return false;

        $ta = explode(" ", $nome);

        //VALIDA SE O NOME POSSUI MAIS DE UMA PALAVRA
        if(count($ta) <= 1)
            return false;

        //VALIDA SE O NOME ESTÁ ABREVIADO
        foreach($ta as $val){

            if(strlen($val) <= 1 || strpos($val, '.'))
                return false;
        }

        return true;
    }

    public static function convertDate($date, $format){

        if(empty($date))
            return null;

        if($format == 'pt'){

            return implode("/", array_reverse(explode("-", $date)));

        }elseif($format == 'en'){

            return implode("-", array_reverse(explode("/", $date)));

        }

        return null;
    }





}
