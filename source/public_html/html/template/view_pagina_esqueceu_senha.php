<div class="row linha-titulo">
    <div class="col">
        <h1 >Recuperar a senha</h1>
    </div>
</div>
<div class="row mt-4">
    <div class="col col-sm-4">&nbsp;</div>
    <div class="col col-sm-4">
        <div class="card">
            <article class="card-body">
<!--                <p class="text-success text-center">Login realizado</p>-->
                <form method="post" action="#">
                    <div class="form-group">
                        <div class="input-group">
                            <div class="input-group-prepend">
                                <span class="input-group-text"> <i class="fa fa-user"></i> </span>
                            </div>
                            <input name="login" id="login" class="form-control required" placeholder="CPF" type="text">
                        </div>
                    </div>
                    <div class="form-group">
                        <input type="hidden" name="cod_objeto" value="<@= #cod_objeto @>" />
                        <button type="submit" class="btn btn-primary btn-block">Enviar</button>
                    </div>
            <div class="row">
                <div class="col col-sm-5">
                    <?php if (defined("_PERMITE_CADASTRO") && _PERMITE_CADASTRO===true) { ?>
                    <p class="text-left small"><a href="<@= $_page->config["portal"]["url"] @>/cadastro" class="btn">Cadastro</a></p>
                    <?php } ?>
                </div>
                <div class="col col-sm-7">
                    <p class="text-right"><a href="<@= $_page->config["portal"]["url"] @>/acesso" class="btn small">Login</a></p>
                </div>
            </div>
	</form>
</article>
</div>
    </div>
    <div class="col col-sm-4">&nbsp;</div>
</div>
