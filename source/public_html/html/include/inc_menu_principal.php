<?php
global $_page, $titulo, $url, $condicao;
?>
                <div class="br-menu">
                    <nav class="folders">
                        <div class="close-menu">
                            <button class="br-button" type="button" circle mini>
                                <i class="fas fa-times"></i>
                            </button>
                        </div>

                        <div class="folder">
                            <a class="header logo">
                                <div class="content">COMTUR</div>
                                <div class="support"><i class="fas fa-angle-down"></i></div>
                            </a>
                            <ul>
                            <@localizar classes=["condutores,contato,folder,pagina_cadastro"] condicao=["menu_principal=1"] ordem=['peso,data_publicacao'] niveis=[0] pai=[1]@>
                                <@var $titulo=#titulo @>
                                <@var $url=#url_amigavel @>
                                <li>
                                    
                                    
                                    <@localizar classes=["condutores,contato,folder,pagina_cadastro_condutor"] condicao=["menu_principal=1"] ordem=['peso,data_publicacao'] niveis=[0] pai=[#cod_objeto]@>
                                        <@se [%INDICE==1]@>
                                    <a class="item">
                                        <div class="content"><?php echo($titulo); ?></div>
                                        <div class="support"><i class="fas fa-angle-right"></i></div>
                                    </a>
                                    <ul>
                                        <@/se@>
                                        <li>
                                            <a class="item" href="<@= #url_amigavel @>">
                                                <div class="content"><@= #titulo @></div>
                                            </a>
                                        </li>
                                        <@se [%INDICE==%FIM]@>
                                    </ul>
                                        <@/se@>

                                    <@/localizar@>
                                    <@naolocalizado@>
                                    <a class="item" href="<?php echo($url); ?>">
                                        <div class="content"><?php echo($titulo); ?></div>
                                    </a>
                                    <@/naolocalizado@>
                                </li>
                            <@/localizar@>
                            </ul>
                        </div>
                    </nav>

                    <footer class="footer">
                        <div class="footer-block">
                            <div class="title">Acesso Rápido</div>
                            <div class="content">
                                <a class="item" href="http://www.altoparaiso.go.gov.br" target="_blank">Portal de Alto Paraíso<i class="fas fa-external-link-square-alt"></i></a>
                            </div>
                        </div>
                        <div class="footer-block">
                            <div class="title">Redes Sociais</div>
                            <div class="content">
                                <button class="br-button" type="button" circle><img src="https://picsum.photos/id/1/200" alt="Redes Sociais">
                                </button>
                                <button class="br-button" type="button" circle><img src="https://picsum.photos/id/10/200" alt="Redes Sociais">
                                </button>
                                <button class="br-button" type="button" circle><img src="https://picsum.photos/id/1001/200" alt="Redes Sociais">
                                </button>
                                <button class="br-button" type="button" circle><img src="https://picsum.photos/id/1002/200" alt="Redes Sociais">
                                </button>
                            </div>
                        </div>
                    </footer>

                </div>
            


