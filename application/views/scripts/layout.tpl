<?php echo $this->doctype(Zend_View_Helper_Doctype::XHTML1_TRANSITIONAL); ?>
<html>
 <head>
  <?php echo $this->headTitle('I LOVE ZEND FRAMEWORK!'); ?>
  <?php echo $this->headMeta()->appendHttpEquiv('Content-Type', 'text/html; charset=UTF-8'); ?>
  <?php echo $this->headLink()->appendStylesheet($this->baseUrl . 'design/css/style.css'); ?>
  <?php echo $this->headScript(); ?>
</head>
<body>
    <div id="menu">
        <?php echo $this->partial('menu.tpl'); ?>
    </div>
    <div id="main">
        <div id="left">
            <p><a href="<?php echo $this->url(array(), 'add_articles'); ?>">Добавления статьи</a></p>
            <p><a href="<?php echo $this->url(array(), 'sotr_sotrudnichestvo'); ?>">Добавления страницы</a></p>
            <?php echo $this->action('index', 'articles'); ?>
        </div>
        <div id="content">
            <?php echo $this->layout()->messages; ?>
           <?php echo $this->layout()->content; ?>
        </div>
    </div>
</body>
</html>