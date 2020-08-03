<?php
/**
 * Arquivo com configurações da aplicação PBL3
 * Inicia e define variáveis importantes para o funcionamento do portal
 */

$PBLCONFIG = array();

/*
 * ////////////////////////////////////////////////////////////////////
 * CONFIGURACOES GERAIS E PATHS
 * ////////////////////////////////////////////////////////////////////
 */
$PBLCONFIG["portal"] = array();
// NOME DO PORTAL
$PBLCONFIG["portal"]["nome"] = "Conselho Municipal de Turismo";
// NOME DO ORGAO
$PBLCONFIG["portal"]["orgao"] = "Alto Paraíso de Goiás";
// EMAIL DO RESPONSAVEL PELO PORTAL
// SERAO ENVIADOS EMAILS DE ERROS
$PBLCONFIG["portal"]["email"] = "diogocorazolla@gmail.com";
// LINGUAGEM PRINCIPAL
$PBLCONFIG["portal"]["linguagem"] = "pt_BR";
// PATH DO PUBLICARE
$PBLCONFIG["portal"]["pblpath"] = "/var/www/html/publicare3";
// PATH PARA UPLOAD DE ARQUIVOS
$PBLCONFIG["portal"]["uploadpath"] = "/var/www/html/arquivos/";
// CODIGO DO OBJETO _ROOT - O OBJETO INICIAL DO PORTAL	
$PBLCONFIG["portal"]["objroot"] = 1;
// LARGURA DAS MINIATURAS DAS IMAGENS
$PBLCONFIG["portal"]["largurathumb"] = 250;
// TIMEZONE
$PBLCONFIG["portal"]["tz"] = "America/Sao_Paulo";
// URL DO PORTAL
$PBLCONFIG["portal"]["url"] = "http://localhost:8080";
// CASO O PORTAL ESTEJA RODANDO EM UMA PASTA WEB, INFORMAR O CAMINHO AQUI
// INFORMAR ENDERECO QUE NAO FAZ PARTE DO DOMINIO PRINCIPAL
$PBLCONFIG["portal"]["pasta"] = "";
// AVISO DE PUBLICACAO DE OBJETOS
$PBLCONFIG["portal"]["avisopublicacao"] = false;
// DESTINO AVISO PUBLICACAO
$PBLCONFIG["portal"]["emailavisopublicacao"] = "diogocorazolla@gmail.com";
// PERMITE CADASTRO DE USUARIOS
// bool: true ou false
$PBLCONFIG["portal"]["permitecadastro"] = true;
// perfil atribuido a usuarios cadastrados
// valores: restrito, autor, editor
$PBLCONFIG["portal"]["perfilcadastro"] = "restrito";

// seta include path para localizar arquivos facilmente
set_include_path(get_include_path() . PATH_SEPARATOR . $PBLCONFIG["portal"]["pblpath"].'/');
set_include_path(get_include_path() . PATH_SEPARATOR . $PBLCONFIG["portal"]["pblpath"].'/manage/');

/*
 * ////////////////////////////////////////////////////////////////////
 * CONFIGURACOES DE LOGIN
 * ////////////////////////////////////////////////////////////////////
 */
$PBLCONFIG["login"]["ldap"] = false;
$PBLCONFIG["login"]["ldaphost"] = "localhost";
$PBLCONFIG["login"]["ldapporta"] = "636";
$PBLCONFIG["login"]["ldapversao"] = 2;
$PBLCONFIG["login"]["ldapdominio"] = "";

/*
 * ////////////////////////////////////////////////////////////////////
 * CONFIGURACOES DE EMAIL
 * ////////////////////////////////////////////////////////////////////
 */
// UTILIZA SMTP? CASO POSITIVO CONECTARA CONFORME DADOS ABAIXO, CASO NEGATIVO UTILIZARÁ A FUNÇÃO MAIL() DO PHP
// true ou false
$PBLCONFIG["email"]["smtp"] = false;
// HOST SMTP
$PBLCONFIG["email"]["host"] = "1.1.1.1";
// PORTA SMTP
$PBLCONFIG["email"]["porta"] = 25;
// SMTP AUTENTICADO
// true ou false
$PBLCONFIG["email"]["auth"] = false;
// USUARIO SMTP
$PBLCONFIG["email"]["usuario"] = "usuario";
// SENHA SMTP
$PBLCONFIG["email"]["senha"] = "senha";
// ENCRIPTACAO SMTP
// VALORES POSSIVEIS: '', 'tls', 'ssl'
// ATENCAO: CASO ALTERE A CRIPTOGRAFIA, DEVE ALTERAR A PORTA
$PBLCONFIG["email"]["enc"] = "tls";
// EMAIL FROM - ORIGEM EMAIL
$PBLCONFIG["email"]["from"] = "diogocorazolla@gmail.com";
// NOME FROM - NOME ORIGEM
$PBLCONFIG["email"]["fromnome"] = $PBLCONFIG["portal"]["nome"];
// DEBUG EMAIL
$PBLCONFIG["email"]["debug"] = false;
// NIVEL DEBUG EMAIL
// DE 1 A 5, NIVEL CRESCENTE DE DETALHES, 0 desativar
$PBLCONFIG["email"]["debugnivel"] = 5;

/*
 * ////////////////////////////////////////////////////////////////////
 * BANCO DE DADOS
 * ////////////////////////////////////////////////////////////////////
 */
// DEFINE TIPO DE BANCO DE DADOS
// PODEM SER PGSQL, MYSQL, MSSQL OU ORACLEX11
$PBLCONFIG["bd"]["tipo"] = "mysqli";
// HOST DO BANCO DE DADOS
$PBLCONFIG["bd"]["host"] = "comtur-mysql";
// PORTA
$PBLCONFIG["bd"]["porta"] = "3306";
// USUARIO
$PBLCONFIG["bd"]["usuario"] = "root";
// SENHA
$PBLCONFIG["bd"]["senha"] = "123456";
// NOME DO BANCO DE DADOS
// CASO UTILIZE ORACLE 11, COLOCAR O "SERVICE NAME"
$PBLCONFIG["bd"]["nome"] = "dbs_comtur";
// DEBUG DE BANCO DE DADOS
// IMPRIME EM TELA TODAS AS TRANSAÇÕES SQL. NÃO UTILIZAR EM PRODUÇÃO!!!!!
$PBLCONFIG["bd"]["debug"] = false;

/*
 * ////////////////////////////////////////////////////////////////////
 * CACHE PARA BANCO DE DADOS
 * PODE SER EM DISCO OU MEMORIA (MEMCACHE)
 * ARMAZENA AS CONSULTAS E RESULTADO, PARA RECUPERAÇÃO RÁPIDA. 
 * UTIL QUANDO NOTA-SE GARGALO ENTRE SERVIDOR DE APLICAÇÃO E SERVIDOR DE BANCO
 * ////////////////////////////////////////////////////////////////////
 */
// ATIVA / DESATIVA
$PBLCONFIG["bd"]["cache"] = false;
// TEMPO DO CACHE EM SEGUNDOS
$PBLCONFIG["bd"]["cachetempo"] = 60 * 60 * 1;
// TIPO DE CACHE, PODE SER MEMORIA OU DISCO
$PBLCONFIG["bd"]["cachetipo"] = "disco";

//////////////////////////////////////////////////////////////////////
// CACHE EM DISCO
// PATH PARA GRAVACAO DO CACHE
$PBLCONFIG["bd"]["cachepath"] = $PBLCONFIG["portal"]["uploadpath"]."/dbcache/";

//////////////////////////////////////////////////////////////////////
// CACHE EM MEMORIA
// HOST DO MEMCACHE
$PBLCONFIG["bd"]["cachehost"] = "localhost";
// PORTA DO MEMCACHE
$PBLCONFIG["bd"]["cacheporta"] = "11211";
// UTILIZA COMPRESSAO
$PBLCONFIG["bd"]["cachecompress"] = false;


/*
 * ///////////////////////////////////////////////////////////////////
 * CONFIGURAÇÕES DE NOMES DAS TABELAS E COLUNAS
 * //////////////////////////////////////////////////////////////////
 * Altere as informações abaixo com os nomes das tabelas e colunas utilizadas
 * Esta implementação foi feita para atender a necessidade da PR
 * Formato do array:
 * 
 * "nome_tabela_sistema" => array (
 *      "nome" => "nome_da_tabela",
 *      "nick" => "nome_curto_usado_em_joins",
 *      "colunas" => array (
 *          "nome_coluna_sistema" => "nome_coluna_banco"
 *      )
 * );
 * 
 * Onde:
 * nome_tabela_sistema => é o nome da tabela que o sistema reconhece, não deve ser alterado
 * nome_da_tabela => é o nome que a tabela tem no banco de dados
 * nome_curto_usado_em_joins => abreviação que o sistema utilizara em consultas com joins
 * nome_coluna_sistema => é o nome da coluna que o sistema reconhece, não deve ser alterado
 * nome_coluna_banco => é o nome que a coluna tem no banco de dados
 * 
 */
/*
$PBLCONFIG["bd"]["tabelas"] = array(
    "classe" => array(
        "nome" => "TAB12501", 
        "nick" => "t1", 
        "colunas" => array(
            "cod_classe" => "COD_CLASSE",
            "nome" => "NOM_CLASSE",
            "prefixo" => "NOM_PREFIXO",
            "descricao" => "DSC_CLASSE",
            "temfilhos" => "IND_FILHOS",
            "sistema" => "IND_SISTEMA",
            "indexar" => "IND_INDEXAR"
        )
    )
);
*/