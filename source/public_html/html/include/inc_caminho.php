                    <ul class="br-breadcrumb">
                        <li class="home"><a href="pagina-inicial"><span class="sr-only">Página inicial</span><i class="fas fa-home"></i></a></li>
                        <li class="hidden"><i class="fas fa-ellipsis-h"></i></li>
<?php
$caminho =  $_page->_adminobjeto->PegaIDPai($_page->_objeto->Valor("cod_objeto"), 7, array(1), array(), true);
foreach ($caminho as $cod_obj => $titulo)
{
?>
                        <li><a href="<?php echo($titulo[1]); ?>"><?php echo($titulo[0]); ?></a></li>
<?php
}
?>
                        <li class="is-active"><a href="<@= #url_amigavel @>"><@= #titulo @></a></li>
                    </ul>
                    