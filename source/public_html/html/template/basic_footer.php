                    </div>
                </div>
            </div>
        </div>

        <div class="br-footer">
            <div class="container-lg">
                <div class="logo text-center"><img src="images/logo-negative.png" alt="Imagem"></div>
                <div class="br-list" collapsible horizontal unique>
                <@localizar classes=["condutores,folder,pagina_cadastro"] condicao=["menu_principal=1"] ordem=['peso,data_publicacao'] niveis=[0] pai=[1]@>
                    <div class="col-2">
                        <a class="item" href="<@= #url_amigavel @>" link>
                            <div class="content text-down-01 text-bold text-uppercase"><@= #titulo @></div>
                    <@localizar classes=["condutores,folder,pagina_cadastro_condutor"] condicao=["menu_principal=1"] ordem=['peso,data_publicacao'] niveis=[0] pai=[#cod_objeto]@>
                        <@se [%INDICE==1]@>
                            <div class="support"><i class="fas fa-angle-up"></i></div>
                        </a>
                        <div class="br-list">
                        <@/se@>
                            <a class="item" href="<@= #url_amigavel @>" link>
                                <div class="content"><@= #titulo @></div>
                            </a>
                        <@se [%INDICE==%FIM]@>
                        </div>
                        <@/se@>
                    <@/localizar@>
                    <@naolocalizado@>
                        </a>
                    <@/naolocalizado@>
                    </div>
                <@/localizar@>
                </div>
                
                <div class="d-none d-sm-block">
                <div class="row align-items-end justify-content-between py-5">
                    <div class="col social-network">
                    <p class="text-up-01 text-extra-bold text-uppercase">Redes Sociais</p>
                    <button class="br-button mr-3" type="button" circle><img src="images/button-negative.png" alt="Imagem">
                    </button>
                    <button class="br-button mr-3" type="button" circle><img src="images/button-negative.png" alt="Imagem">
                    </button>
                    <button class="br-button mr-3" type="button" circle><img src="images/button-negative.png" alt="Imagem">
                    </button>
                    <button class="br-button mr-3" type="button" circle><img src="images/button-negative.png" alt="Imagem">
                    </button>
                    </div>
                    <div class="col assigns text-right"><img class="ml-4" src="images/logo-assign-negative.png" alt="Imagem"><img class="ml-4" src="https://cdn.dsgovserprodesign.estaleiro.serpro.gov.br/design-system/images/logo-assign-negative.png" alt="Imagem">
                    </div>
                </div>
                </div>
            </div>
        <div class="br-divider"></div>
        <div class="container-lg">
            <div class="info">
            <div class="text-down-01 text-medium pb-3 text-center">Texto destinado a exibição de informações relacionadas à&nbsp;<strong>licença de uso.</strong></div>
            </div>
        </div>
        </div>
    <script src="js/dsgov.js"></script>
  </body>
</html>