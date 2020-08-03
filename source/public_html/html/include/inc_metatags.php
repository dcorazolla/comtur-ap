<?php
global $_page;
?>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<meta http-equiv="X-UA-Compatible" content="ie=edge">
<meta name="robots" content="index,follow">
<meta name="description" content="<@se [#descricao!=""] @><@= #descricao @><@senao@><?php echo($_page->config["portal"]["nome"])?><@/se@>" />
<@se [#tags!=""]@>
<meta name="keywords" content="<@= #tags@>"/>
<@/se@>

<!-- Global site tag (gtag.js) - Google Analytics -->
<script async src="https://www.googletagmanager.com/gtag/js?id=G-HW3TTEJX1N"></script>
<script>
  window.dataLayer = window.dataLayer || [];
  function gtag(){dataLayer.push(arguments);}
  gtag('js', new Date());

  gtag('config', 'G-HW3TTEJX1N');
</script>