<?php 
	global $_page, $PERFIL;
        $PERFIL = $_page->_usuario->cod_perfil;
	if ($PERFIL <= _PERFIL_AUTOR) { 
?>
<span class="iconeedicao">
<@se [#apagado==1] @>
<strong style="color: #f00 !important;"> (APAGADO)</strong>
<@/se@>
<@se [#cod_status!=2]@>
    <a href="<?php echo($_page->config["portal"]["url"]); ?>/do/publicar/<@= #cod_objeto@>.html" title="Publicar" class="logado" ><i class='fa fa-check-square'></i></a>
<@/se@>
<@se [#cod_classe!=75]@>
<a href="<?php echo($_page->config["portal"]["url"]); ?>/do/edit/<@= #cod_objeto@>.html" title="Editar" class="logado"><i class='fa fa-pencil-alt'></i></a>
<@/se@>
<@se [#temfilhos==1]@>
<a href="<?php echo($_page->config["portal"]["url"]); ?>/do/new/<@= #cod_objeto@>.html" title="Inserir outros objetos" class="logado"><i class='fa fa-plus'></i></a>
<@/se@>
<@se [#cod_classe!=75]@>
<a href="<?php echo($_page->config["portal"]["url"]); ?>/do/delete/<@= #cod_objeto@>.html" title="Excluir" class="logado"><i class='fa fa-trash'></i></a>
<@/se@>
<@se [#temfilhos==1]@>
<a href="<?php echo($_page->config["portal"]["url"]); ?>/do/list_content/<@= #cod_objeto@>.html" title="Listar conte&uacute;do" class="logado"><i class='fa fa-list'></i></a>
<@/se@>
</span>
<?php 
	} 	
?>