<?php
global $_page, $PERFIL;
$PERFIL = $_page->_usuario->cod_perfil;

if ($_page->_objeto->Valor("url_amigavel")!="alterasenha" 
        && isset($_SESSION["usuario"]["altera_senha"])
                && $_SESSION["usuario"]["altera_senha"]==1)
{
    $_SESSION["mensagem"] = array("tipo"=>"warning", "msg"=>"<p><strong>Acesso realizado com senha temporária</strong><br />É necessário atualizar sua senha</p>");
    header("Location:".$_page->config["portal"]["url"]."/alterasenha");
    exit();
}
?>
<!DOCTYPE html>
<@incluir arquivo=['/html/include/banco_de_funcoes.php']@>
<html lang="pt-BR">
    <head>
        <title><?php echo($_page->config["portal"]["nome"]." - ".$_page->_objeto->Valor("titulo")); ?></title>
        <@incluir arquivo=['/html/include/inc_metatags.php']@>
        <base href="<?php echo($_page->config["portal"]["url"]); ?>/" target="_self" />
        <link rel="canonical" href="<?php echo($_page->config["portal"]["url"]."/".$_page->_objeto->Valor("url_amigavel")); ?>" />
        <link rel="stylesheet" href="css/dsgov.css">
        <script src="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.11.2/js/all.min.js"></script>
        <script src="js/jquery.min.js"></script>
    </head>
    <body class="template-base">

        <?php if ($PERFIL <= _PERFIL_AUTOR) {   ?>
        <!-- === Logado === -->
        <style>
            .template-base .scrim-menu {
                top: 50px !important;
            }
            
        </style>
        <div style="padding-top: 50px !important;">
        <@incluimenu@>
        </div>
        <!-- Final === Logado === -->
        <?php } ?>

        <ul class="accessibility-links">
            <li><a class="br-button" accesskey="1" href="#main-content">Ir para o conteúdo</a></li>
            <li><a class="br-button" accesskey="2" href="#main-nav">Ir para o menu principal</a></li>
            <li><a class="br-button" accesskey="3" href="#context-nav">Ir para o menu auxiliar</a></li>
        </ul>
        <div class="scrim-menu">
            <div id="main-nav">

                <@incluir arquivo=['/html/include/inc_menu_principal.php']@>

                
            </div>
        </div>

        <div class="br-header" sticky>
            <div class="container-lg">
                <div class="flex-container">
                    <div class="logo"><img src="images/logo.jpg" alt="logo">
                        <div class="sign">Alto Paraíso de Goiás</div>
                    </div>
                    <div class="actions">
                        <div class="links">
                            <button class="br-button" type="button" circle mini><i class="fas fa-ellipsis-v"></i>
                            </button>
                            <ul>
                                <li class="title">Acesso Rápido</li>
                                <li><a href="cadastro">Cadastros</a></li>
                            </ul>
                        </div>
                        <div class="functions">
                            <button class="br-button" type="button" circle mini><i class="fas fa-th"></i>
                            </button>
                            <ul>
                                <li class="title">Funcionalidades do Sistema</li>
                                <li>
                                    <button class="br-button" type="button" circle mini> <i class="fas fa-chart-bar"></i><span class="text">Estatísticas</span>
                                    </button>
                                </li>
                                <li>
                                    <button class="br-button" type="button" circle mini><i class="fas fa-adjust"></i><span class="text">Contraste</span>
                                    </button>
                                </li>
                            </ul>
                        </div>
                        <div class="search-btn">
                            <button class="br-button" type="button" circle mini><i class="fas fa-search"></i>
                            </button>
                        </div>
                        <a class="login" href="acesso">
                            <button class="br-button" type="button" mini>
                                <i class="fas fa-user"></i><span class="ml-1">Entrar</span>
                            </button>
                        </a>
                        
                        <a class="avatar" href="javascript:void(0)">
                            <div class="br-badge" danger>
                                <div class="icon">5</div>
                                <div class="content">
                                    <div class="br-avatar">
                                        <div class="image"><img src="https://picsum.photos/id/823/400" alt="Avatar"></div>
                                    </div>
                                </div>
                            </div>
                        </a>
                        <div class="br-notification" notification>
                            <div class="notification-header">
                                <div class="user-name">Fulano da Silva</div>
                                <div class="user-email">fulano.silva@email.com</div>
                            </div>
                            <div class="notification-body">
                                <div class="br-tabs">
                                    <nav class="tab-nav">
                                        <ul>
                                            <li class="tab-item">
                                                <button type="button" data-panel="panel-1"><span class="name">Configurações<i class="fas fa-cog"></i></span></button>
                                            </li>
                                            <li class="tab-item is-active">
                                                <button type="button" data-panel="panel-2"><span class="name">Notificações<i class="fas fa-bell"></i></span></button>
                                            </li>
                                            <li class="tab-item">
                                                <button type="button" data-panel="panel-3"><span class="name">Mensagens<i class="fas fa-envelope"></i></span></button>
                                            </li>
                                        </ul>
                                    </nav>
                                    <div class="tab-content">
                                        <div class="tab-panel" id="panel-1">
                                            <p>Painel Configurações</p>
                                        </div>
                                        <div class="tab-panel is-active" id="panel-2">
                                            <div class="br-list">
                                                <a class="item divider" href="javascript:void(0);" link>
                                                    <div class="br-badge" success>
                                                        <div class="icon"></div>
                                                    </div>
                                                    <div class="title">Título Notificação</div>
                                                    <div class="subtitle">Subtítulo Notificação</div>
                                                    <div class="date">08/04/2020</div>
                                                    <div class="content">
                                                        <div class="text">Lorem ipsum dolor sit amet, consectetur adipiscing elit. Curabitur dapibus massa nisi, id efficitur tortor tincidunt rutrum.</div>
                                                    </div>
                                                    <div class="contextual-btn"><i class="fa-lg fas fa-ellipsis-v"></i></div>
                                                    <div class="contextual-menu">
                                                        <div class="action">Ocultar esta notificação</div>
                                                        <div class="action">Ocultar todas as notificações </div>
                                                    </div>
                                                </a>
                                            </div>
                                        </div>
                                        <div class="tab-panel" id="panel-3">
                                            <div class="br-list">
                                                <div class="header">
                                                    <div class="title">Lista de Mensagens</div>
                                                    <div class="actions">
                                                        <button class="br-button" type="button" tertiary circle mini><i class="fas fa-sort-alpha-up"></i>
                                                        </button><span class="mx-3">|</span>
                                                        <button class="br-button" type="button" tertiary circle mini><i class="fas fa-search"></i>
                                                        </button>
                                                    </div>
                                                </div>
                                                <a class="item divider" href="javascript:void(0);" link>
                                                    <div class="icon active"><i class="fa-lg fas fa-envelope-open"></i></div>
                                                    <div class="title">Título Mensagem</div>
                                                    <div class="content">
                                                        <div class="subtitle">Subtítulo Mensagens</div>
                                                        <div class="text">Lorem ipsum dolor sit amet, consectetur adipiscing elit. Curabitur dapibus massa nisi, id efficitur tortor tincidunt rutrum.</div>
                                                    </div>
                                                    <div class="date">08/04/2020</div>
                                                    <div class="contextual-btn"><i class="fa-lg fas fa-ellipsis-v"></i></div>
                                                    <div class="contextual-menu">
                                                        <div class="action">Ocultar esta notificação</div>
                                                        <div class="action">Ocultar todas as notificações </div>
                                                    </div>
                                                </a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div> 
                    </div>

                    <div class="menu">
                        <button class="br-button" type="button" circle mini>
                            <i class="fas fa-bars"></i>
                        </button>
                        <div class="title">Conselho Municipal de Turismo</div>
                        <!-- <div class="subtitle">Subtítulo do Cabeçalho</div> -->
                    </div>

                    <div class="search">
                        <div class="br-input has-icon">
                            <label></label>
                            <input class="has-icon" type="text" placeholder="O que você procura?">
                            <button class="icon" type="button"><span class="icon"><i class="fas fa-search"></i></span></button>
                        </div>
                        <button class="br-button search-close" type="button" circle mini>
                            <i class="fas fa-times"></i>
                        </button>
                    </div>
                </div>
            </div>
        </div>

        <div class="container-lg">
            <div class="row">
                
                <@incluir arquivo=['/html/include/inc_menu_interno.php']@>

                <div class="col container-main">
                    
                    <@incluir arquivo=['/html/include/inc_caminho.php']@>

                    <div id="main-content">
                        
                        <@incluir arquivo=['/html/include/inc_titulo.php']@>
    