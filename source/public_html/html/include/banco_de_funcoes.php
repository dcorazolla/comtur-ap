<?php
global $_page,$cod_objeto;

if (!function_exists("paginacao"))
{
    function paginacao($total=0, $limite=6, $pagina=1, $url="", $params=array(), $maximo_paginas=10)
    {
        $retorno = array();
        try {
            $retorno["status"] = 1;
            $retorno["total"] = $total;
            $retorno["limite"] = $limite;
            $retorno["paginas"] = ceil($total / $limite);
            $retorno["pagina"] = min($retorno["paginas"], $pagina);
            $retorno["offset"] = ($retorno["pagina"] - 1)  * $retorno["limite"];
            $retorno["inicio"] = $retorno["offset"] + 1;
            $retorno["fim"] = min(($retorno["offset"] + $retorno["limite"]), $retorno["total"]);

            $inicio_paginas = 1;
            $fim_paginas = min($retorno["paginas"], $maximo_paginas);
            $meio = ceil($maximo_paginas/2)+1;

            if ($retorno["pagina"]>$meio)
            {
                $fim_paginas = min($pagina + $meio - 2, $retorno["paginas"]);
                $inicio_paginas = $fim_paginas - $maximo_paginas + 1;
            }

            $parametros = "";
            if (count($params)>0)
            {
                foreach ($params as $id=>$valor)
                {
                    $parametros .= "&".$id."=".$valor;
                }
            }

            $retorno["controles"] = '';
            $retorno["mensagem"] = '<p class="text-center"><center>Nenhum resultado.</center></p>';
            if ($retorno["total"] > 0)
            {
                $retorno["mensagem"] = '
                    <p class="text-center"><center>
                        <strong>'.$retorno["total"].'</strong> resultado'.('s. Exibindo de '.$retorno["inicio"].' a '.$retorno["fim"].'.').'
                    </center></p>';

                $retorno["controles"] = '
                    <ul class="paginacao listingBar">';
                if ($retorno["pagina"] > 1)
                {
                    $retorno["controles"] .= '<li><a href="'.$url.'?p=1'.$parametros.'"><<</a></li>';
                    $retorno["controles"] .= '<li><a href="'.$url.'?p='.max(1, $retorno["pagina"]-1).$parametros.'"><</a></li>';
                }
                for ($i=$inicio_paginas; $i <= $fim_paginas; $i++)
                {
                    if ($retorno["pagina"] == $i) 
                    {
                        $retorno["controles"] .= '<li><span>'.$i.'</span></li>';
                    }
                    else
                    {
                        $retorno["controles"] .= '<li><a href="'.$url.'?p='.$i.$parametros.'">'.$i.'</a></li>';
                    }
                }
                if ($retorno["pagina"] < $retorno["paginas"])
                {
                    $retorno["controles"] .= '<li><a href="'.$url.'?p='.($retorno["pagina"] + 1).$parametros.'">></a></li>';
                    $retorno["controles"] .= '<li><a href="'.$url.'?p='.$retorno["paginas"].$parametros.'">>></a></li>';
                }
                $retorno["controles"] .= '
                    </ul>';
            }
        } catch (Exception $e) {
            $retorno["status"] = 0;
            $retorno["msg"] = $e->getMessage();
        }
        return $retorno;
    }
}
    
if (!function_exists("transformaTamanho"))
{
    function transformaTamanho($tamanho, $medida=0)
    {
        $ret = array();
        $arrMedidas = array("B", "KB", "MB", "GB", "TB");

        $ret[0] = $tamanho;
        $ret[1] = $arrMedidas[$medida];

        if ($tamanho > 1024)
        {
            $tamanho = $tamanho/1024;
            $medida++;
            $ret = transformaTamanho($tamanho, $medida);
        }

        return $ret;
    }
}

if (!function_exists("validaCPF"))
{
    function validaCPF($cpf = null) {

        // Verifica se um número foi informado
        if(empty($cpf)) { return false; }

        // Elimina possivel mascara
        $cpf = preg_replace("/[^0-9]/", "", $cpf);
        $cpf = str_pad($cpf, 11, '0', STR_PAD_LEFT);

        // Verifica se o numero de digitos informados é igual a 11 
        if (strlen($cpf) != 11) { return false; }

        // Verifica se nenhuma das sequências invalidas abaixo 
        // foi digitada. Caso afirmativo, retorna falso
        if ($cpf == '00000000000' || $cpf == '11111111111' || $cpf == '22222222222' || 
            $cpf == '33333333333' || $cpf == '44444444444' || $cpf == '55555555555' || 
            $cpf == '66666666666' || $cpf == '77777777777' || $cpf == '88888888888' || 
            $cpf == '99999999999') 
            { return false; }

        // Calcula os digitos verificadores para verificar se o CPF é válido
        for ($t = 9; $t < 11; $t++) 
        {
            for ($d = 0, $c = 0; $c < $t; $c++) { $d += $cpf[$c] * (($t + 1) - $c); }
            $d = ((10 * $d) % 11) % 10;
            if ($cpf[$c] != $d) { return false; }
        }

        return true;
    }
}

