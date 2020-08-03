<?php
global $_page;
?>
<div class="row">
    <div class="col-md-5" style="vertical-align: top">
        <@= #texto @>
    </div>
    <div class="col-md-7" style="vertical-align: top">
        <div class="br-card">
            <div class="front">
                <div class="header bg-primary-pastel-01"><p class="h5">Envie uma mensagem</p></div>
                <div class="content">
                    <div class="row">
                        <div class="col-md-12">
                            <div class="br-input mb-1 mt-1">
                                <label for="nome">Nome</label>
                                <input id="nome" type="text" placeholder="Informe seu nome">
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6">
                            <div class="br-input mb-1">
                                <label for="email">E-mail</label>
                                <input id="email" type="text" placeholder="Informe seu e-mail">
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="br-input mb-1">
                                <label for="fone">Telefone</label>
                                <input id="fone" type="text" placeholder="Informe seu telefone">
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-12">
                            <div class="br-input mb-1">
                                <label for="assunto">Assunto</label>
                                <input id="assunto" type="text" placeholder="Informe o assunto">
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-12">
                            <div class="br-textarea mb-1">
                                <label for="msg">Mensagem</label>
                                <textarea id="msg" placeholder="Qual é a mensagem?" rows="5"></textarea>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
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