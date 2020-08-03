<?php
global $_page, $titulo, $url, $codd_obj;

function pegaParentescoMenuProprio()
{
    
}

if ($_page->_objeto->Valor("cod_objeto") != 1)
{
    $codd_obj = 0;
    if ($_page->_objeto->Valor("menu_proprio") == 1)
    {
        $codd_obj = $_page->_objeto->Valor("cod_objeto");
    }
    //x($_page->_objeto->CaminhoObjeto);
    if ($codd_obj == 0)
    {
        foreach (array_reverse($_page->_objeto->CaminhoObjeto) as $cod)
        {
            $obj = new Objeto($_page, $cod);
            if ($obj && $obj->Valor("menu_proprio") == 1)
            {
                $codd_obj = $cod;
                break;
            }
        }
    }
    //x($codd_obj);
    if ($codd_obj > 0)
    {
        $obj = new Objeto($_page, $codd_obj);
?>
                <div class="context-menu col-sm-6 col-md-4" id="context-nav">
                    <div class="br-menu">
                        <a class="header">
                            <div class="support"><i class="fas fa-angle-up"></i></div>
                            <div class="content"><?php echo($obj->Valor("titulo")); ?></div>
                        </a>
                        <nav class="folders">
                            <div class="folder">
                                <ul>
                                    <li>
                                        <a class="item" href="<?php echo($obj->Valor("url_amigavel")); ?>" active>
                                            <div class="content"><strong><?php echo($obj->Valor("titulo")); ?></strong></div>
                                            <div class="support"><i class="fas fa-angle-down"></i></div>
                                        </a>
                                    </li>
                                    <?php
                                    $objetos = $_page->_adminobjeto->LocalizarObjetos("folder", "", 'peso,titulo', -1, -1, $codd_obj, 0);
                                    foreach ($objetos as $objeto):
                                        $objetos2 = $_page->_adminobjeto->LocalizarObjetos("folder", "", 'peso,titulo', -1, -1, $objeto->Valor("cod_objeto"), 0);
                                        ?>
                                    <li>
                                        <a class="item" <?php if(count($objetos2) == 0): ?> href='<?php echo($objeto->Valor("url_amigavel")); ?>' <?php endif; ?>>
                                            <div class="content"><?php echo($objeto->Valor("titulo")); ?></div>
                                            <?php if(count($objetos2) > 0): ?><div class="support"><i class="fas fa-angle-right"></i></div><?php endif; ?>
                                        </a>
                                        <?php if(count($objetos2) > 0): ?>
                                        <ul>
                                            <?php foreach ($objetos2 as $objeto2): ?>
                                            <li>
                                                <a class="item" href="<?php echo($objeto2->Valor("url_amigavel")); ?>">
                                                    <div class="content"><?php echo($objeto2->Valor("titulo")); ?></div>
                                                </a>
                                            </li>
                                            <?php endforeach; ?>
                                        </ul>
                                        <?php endif; ?>
                                    </li>
                                    <?php
                                    endforeach;
                                    ?>
                                    
<!--                                    <li>
                                        <a class="item">
                                            <div class="content">Item 1</div>
                                            <div class="support"><i class="fas fa-angle-right"></i></div>
                                        </a>
                                        <ul>
                                            <li>
                                                <a class="item">
                                                    <div class="content">Item 1.1</div>
                                                </a>
                                            </li>
                                            <li>
                                                <a class="item">
                                                    <div class="content">Item 1.2</div>
                                                </a>
                                            </li>
                                            <li>
                                                <a class="item">
                                                    <div class="content">Item 1.3</div>
                                                    <div class="support"><i class="fas fa-angle-right"></i></div>
                                                </a>
                                                <ul>
                                                    <li>
                                                        <a class="item">
                                                            <div class="content">Item 1.3.1</div>
                                                        </a>
                                                    </li>
                                                </ul>
                                            </li>
                                        </ul>
                                    </li>
                                    <li>
                                        <a class="item">
                                            <div class="content">Item 2</div>
                                        </a>
                                  </li>-->
                                </ul>
                            </div>
                        </nav>
                    </div>
                </div>
<?php
    }
}
?>