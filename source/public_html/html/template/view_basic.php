<!--<div class="br-card col">
    <div class="front">
        <div class="header">...</div>
        <div class="content">...</div>
        <div class="footer">...</div>
    </div>
</div>
<div class="br-card col">
    <div class="front">
        <div class="header">...</div>
        <div class="content">...</div>
        <div class="footer">...</div>
    </div>
</div>-->
<?php
global $cod_foto;
?>
<div class="row">
    <div class="col-12" style="vertical-align: top">
        <@localizar classes=["imagem"] pai=[#cod_objeto] condicao=["destaque=1"] limite=[1] niveis=[0] ordem=["peso,-data_publicacao"] @>
        <div class="" style="width: 200px; float: left;">
            <a title="<@= #legenda @>">
                <@usarblob nome=["conteudo"] @>
                <img src="<@srcblob@>" class="left" alt="<@= #titulo @>" width="100%">
                <@/usarblob@>
            </a>
        </div>
        <@/localizar@>
        <@= #texto @>
    </div>
</div>

<div class="row mt-2">
<@localizar classes=['folder,interlink,pagina_cadastro,pagina_cadastroorg'] ordem=['peso,titulo'] pai=[#cod_objeto] niveis=[0] @>
    <div class="col-sm-6 col-md-4">
        <a href="<@= $_page->config["portal"]["url"].#url @>">
           <div class="br-card" style="height: 150px;">
               <div class="front" >
                    <div class="header"><p class="h6"><@= #titulo @></p></div>
                    <div class="content"><@= cortaTexto(#texto, 200) @></div>
                </div>
            </div>
        </a>
    </div>
<!--    <a href="<@= $_page->config["portal"]["url"].#url @>" class="br-card is-small is-change-content is-arrow" style="float: left; min-width: 200px; min-height: 50px;">
        <span class="icon">
            <i class="fas fa-question"></i>
        </span>
        <span class="title text-center">
            <@= #titulo @>
        </span>
        <p class="text"><@= cortaTexto(#texto, 70) @></p>
    </a>-->
    <@/localizar@>
</div>