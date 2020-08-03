<?php
global $_page;
$PERFIL = $_page->_usuario->cod_perfil;

$acesso = new Acesso();

// define valores de maximo de tentativas e tempo de espera
$maximotentativas = 5;
$tempoespera = 10;

$usuario = filter_input(INPUT_POST, "usuario", FILTER_SANITIZE_SPECIAL_CHARS);
$senha = filter_input(INPUT_POST, "password", FILTER_SANITIZE_SPECIAL_CHARS);

$cod_objeto = filter_input(INPUT_POST, "cod_objeto", FILTER_SANITIZE_NUMBER_INT);
if (is_null($cod_objeto)) { $cod_objeto = filter_input(INPUT_GET, "cod_objeto", FILTER_SANITIZE_NUMBER_INT); }
if (is_null($cod_objeto)) { $cod_objeto = $_page->config["portal"]["objroot"]; }
$objredirect = new Objeto($_page, $cod_objeto);

// se tiver informado usuario e senha
if (!is_null($usuario) != "" && !is_null($senha) != "") 
{
    // se não tiver sessão de tentativas iniciada, inicia a sessão
    if (!isset($_SESSION['_LOGIN_TENTATIVAS'])) {
        $_SESSION['_LOGIN_TENTATIVAS'] = 0;
        $_SESSION['_LOGIN_DATA'] = date("Y-m-d H:i:s");
    }
    // se ja tiver sessão iniciada
    else
    {
        $dataAtual = date("Y-m-d H:i:s");
        $dataPrimeiraTentativa = $_SESSION['_LOGIN_DATA'];

        $data1 = new \DateTime($dataAtual);
        $data2 = new \DateTime($dataPrimeiraTentativa);

        $dateDiff = $data1->diff($data2);
        // se tiver passado o tempo de espera, reinicia contagem
        if ($dateDiff->i >= $tempoespera) {
            $_SESSION['_LOGIN_TENTATIVAS'] = 0;
            $_SESSION['_LOGIN_DATA'] = date("Y-m-d H:i:s");
        }
    }
    
    // se tiver estourado o maximo de tentativas, exibe mensagem para usuario esperar
    if ($_SESSION['_LOGIN_TENTATIVAS'] >= $maximotentativas) {
        $_SESSION['_LOGIN_DATA'] = date("Y-m-d H:i:s");
        $_SESSION["mensagem"] = array("tipo"=>"danger", "msg"=>"<p><strong>Muitas tentativas de acesso</strong><br />"
                            . "Aguarde ".$tempoespera." minutos antes de nova tentativa.");
    }
    // se não tiver estourado o maximo de tentativas, envia dados para login
    else 
    {
        
        $sqlinicial = "SELECT ".$_page->_db->tabelas["usuario"]["colunas"]["cod_usuario"]." AS cod_usuario, "
                        . " ".$_page->_db->tabelas["usuario"]["colunas"]["nome"]." AS nome, "
                        . " ".$_page->_db->tabelas["usuario"]["colunas"]["email"]." AS email, "
                        . " ".$_page->_db->tabelas["usuario"]["colunas"]["chefia"]." AS chefia, "
                        . " ".$_page->_db->tabelas["usuario"]["colunas"]["secao"]." AS secao, "
                        . " ".$_page->_db->tabelas["usuario"]["colunas"]["ramal"]." AS ramal, "
                        . " ".$_page->_db->tabelas["usuario"]["colunas"]["login"]." AS login, "
                        . " ".$_page->_db->tabelas["usuario"]["colunas"]["data_atualizacao"]." AS data_atualizacao, "
                        . " ".$_page->_db->tabelas["usuario"]["colunas"]["altera_senha"]." AS altera_senha, "
                        . " ".$_page->_db->tabelas["usuario"]["colunas"]["ldap"]." AS ldap "
                        . " FROM ".$_page->_db->tabelas["usuario"]["nome"]." ";
        $sql = "";
        $bind = array();
        
        $sql = $_page->_db->getCon()->prepare($sqlinicial
                    . " WHERE ".$_page->_db->tabelas["usuario"]["colunas"]["valido"]." = 1 "
                    . " AND ".$_page->_db->tabelas["usuario"]["colunas"]["login"]." = ?");
        $bind = array(1 => $usuario);
            
        $rs = $_page->_db->ExecSQL(array($sql, $bind));
            
        // encontrou usuário com o login
        if ($rs->_numOfRows>0)
        {
            while ($row = $rs->FetchRow())
            {
                $cod_usuario = $row['cod_usuario'];
                
                $usuarios = $_page->_adminobjeto->LocalizarObjetos("usuario", "cod_usuario_padrao=".$cod_usuario, "", -1, -1, 2, 2);
                if (count($usuarios)>0)
                {
                    $usuario = $usuarios[0];
                    if ($usuario->Valor("token")!="" && $usuario->Valor("ativo")==0)
                    {
                        $tempmail = ofuscaEmail($usuario->Valor("email"));
//                xd($usuario);
                        $_SESSION["mensagem"] = array("tipo"=>"warning", "msg"=>"<p><strong>Cadastro não validado!</strong><br />"
                            . "Durante o cadastro enviamos um email para ".$tempmail." com instruções para validação da sua conta. Caso não tenha recebido a mensagem <a href='".$_page->config["portal"]["url"]."/cadastro?acao=enviatoken' class='btn btn-default'>Reenviar email para validação</a><br/>"
                            . "Ou entre em contato com a administração do sistema ".$_page->config["portal"]["email"]);
                    }
                    else
                    {
                        // muito tempo sem acessar, login fica bloqueado
                        if((int)$row['data_atualizacao'] < (int)date("Ymd"))
                        {
                            $_SESSION["mensagem"] = array("tipo"=>"danger", "msg"=>"<p>Senha expirada!<br />"
                                . "Sua senha expirou. Para acessar o portal deve gerar uma nova senha;"
                                . "<a href='".$_page->config["url"]."/esquecisenha' class='btn btn-default'>Gerar nova senha</a><br/>");
                        }
                        else
                        {
                            $sql2 = "";
                            $bind2 = array();
                            
                                $sql2 = $_page->_db->getCon()->prepare($sqlinicial
                                        . " WHERE ".$_page->_db->tabelas["usuario"]["colunas"]["valido"]." = 1 "
                                        . " AND ".$_page->_db->tabelas["usuario"]["colunas"]["cod_usuario"]." = ? "
                                        . " AND ".$_page->_db->tabelas["usuario"]["colunas"]["senha"]." = ?");
                                $bind2 = array(1 => $cod_usuario, 2 => md5($senha));
                            
                            $rs = $_page->_db->ExecSQL(array($sql2, $bind2));
                            if ($rs->_numOfRows == 0) 
                            {
                                $_SESSION["mensagem"] = array("tipo"=>"danger", "msg"=>"<p><strong>Usuário/senha incorretos</strong>");
                                $_SESSION['_LOGIN_TENTATIVAS']++;
                            }
                            else
                            {
                                $_SESSION["usuario"] = $row;

                                // atualiza data validade do usuario
                                $data_validade = strftime("%Y%m%d", strtotime("+6 month"));
                                $sql = "UPDATE ".$_page->_db->tabelas["usuario"]["nome"]." "
                                        . " SET ".$_page->_db->tabelas["usuario"]["colunas"]["data_atualizacao"]." = ".ConverteData($data_validade,16)." "
                                        . "WHERE ".$_page->_db->tabelas["usuario"]["colunas"]["cod_usuario"]." = ".$_SESSION["usuario"]["cod_usuario"];
                                $rs = $_page->_db->ExecSQL($sql);

                                // carrega permissões do usuario
                                $_page->_usuario->Carregar();

                                $_SESSION["mensagem"] = array();
                                echo("<script>document.location.href='".$_page->config["portal"]["url"]."/perfil';</script>");
                                exit();
                            }
                        }
                    }
//                    unset($usuario);
                }
                else
                {
                    $_SESSION["mensagem"] = array("tipo"=>"danger", "msg"=>"<p><strong>Usuário/senha incorretos</strong>");
                    $_SESSION['_LOGIN_TENTATIVAS']++;
                }
                break;
            }
        }
        else
        {
            $_SESSION["mensagem"] = array("tipo"=>"danger", "msg"=>"<p><strong>Usuário/senha incorretos</strong>");
            $_SESSION['_LOGIN_TENTATIVAS']++;
        }
    }
}

?>

    <@se [#texto!=""] @>
    <div class="row">
        <div class="row-content">
            <div class="column col-md-12">
                <div class="tile tile-default">
                    <@= #texto @>
                </div>
            </div>
        </div>
    </div>
    <@/se@>
<?php
if (isset($_SESSION["mensagem"]["msg"]) && $_SESSION["mensagem"]["msg"]!="")
{
?>
    <div class="br-message is-<?php echo($_SESSION["mensagem"]["tipo"]); ?>" style="max-width: 550px !important; margin: 0 auto 20px auto;">
        <div class="icon">
            <i class="fa <?php echo($_SESSION["mensagem"]["tipo"]=="danger"?"fa-times-circle":($_SESSION["mensagem"]["tipo"]=="warning"?"fa-exclamation":"fa-check")); ?> fa-lg" style="color: #fff !important;"></i>
        </div>
        <div class="content"><?php echo($_SESSION["mensagem"]["msg"]); ?></div>
    </div>
<?php
    unset($_SESSION["mensagem"]);
}
//xd($_SESSION["usuario"]);
?>
    
    
    
    <form action="<?php echo($_page->config["portal"]["url"].$_page->_objeto->Valor("url")); ?>" method="post" id="formlogin">
    <div class="br-card" style="max-width: 400px; margin: 0 auto;">
        <div class="front">
            <div class="content">
                <div class="br-input mb-1" valid>
                    <label for="usuario">Usuário</label>
                    <input id="usuario" name="usuario" type="text" placeholder="Usuário" onchange="altera();" >
                </div>
                <div class="br-input mb-1">
                    <label for="password">Senha</label>
                    <input id="password" name="password" type="password" placeholder="Sua senha" />
                    <button class="icon" type="button">
                        <span class="sr-only">Mostrar senha</span><i class="fas fa-eye"></i>
                    </button>
                </div>
                <div class="br-input mb-1" style="text-align: center;">
                    <button class="br-button primary" type="submit">
                        Entrar
                    </button>
                </div>
                <@localizar classes=["pagina_esqueceu_senha"] limite=[1] ordem=['peso'] niveis=[0] pai=[1] @>
                <div class="br-input" style="text-align: right;">
                    <a href="<@= #url_amigavel @>"><@= #titulo @></a>
                </div>
                <@/localizar @>
            </div>
        </div>
    </div>
</form>
    
<script>
    $("document").ready(function(){
        $("#formlogin").validate();
    });
    
    function altera()
    {
        var valor = $("#login").val();
        valor = valor.replace(/\./gi, "").replace(/-/gi, "").replace(/,/gi, "");
        $("#login").val(valor);
    }
</script>
