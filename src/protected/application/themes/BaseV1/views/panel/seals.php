<?php
$this->layout = 'panel'
?>
<div class="panel-list panel-main-content">

    <?php $this->applyTemplateHook('panel-header','before'); ?>
	<header class="panel-header clearfix">
        <?php $this->applyTemplateHook('panel-header','begin'); ?>

		<h2><?php \MapasCulturais\i::_e("Meus selos");?></h2>
		<a class="btn btn-default add" href="<?php echo $app->createUrl('seal', 'create'); ?>"><?php \MapasCulturais\i::_e("Adicionar novo selo");?></a>

        <?php $this->applyTemplateHook('panel-header','end') ?>
    </header>
    <?php $this->applyTemplateHook('panel-header','after'); ?>

    <ul class="abas clearfix clear">
        <li class="active"><a href="#ativos" rel='noopener noreferrer'><?php \MapasCulturais\i::_e("Ativos");?> (<?php echo count($seals);?>)</a></li>
        <li><a href="#meus" rel='noopener noreferrer'><?php \MapasCulturais\i::_e("Meus");?> (<?php echo count($app->user->enabledSeals);?>)</a></li>
        <li><a href="#permitido" rel='noopener noreferrer'><?php \MapasCulturais\i::_e("Concedidos");?> (<?php echo count($app->user->hasControlSeals);?>)</a></li>
        <li><a href="#rascunhos" rel='noopener noreferrer'><?php \MapasCulturais\i::_e("Rascunhos");?> (<?php echo count($app->user->draftSeals);?>)</a></li>
        <li><a href="#lixeira" rel='noopener noreferrer'><?php \MapasCulturais\i::_e("Lixeira");?> (<?php echo count($app->user->trashedSeals);?>)</a></li>
        <li><a href="#arquivo" rel='noopener noreferrer'><?php \MapasCulturais\i::_e("Arquivo");?> (<?php echo count($app->user->archivedSeals);?>)</a></li>
    </ul>
    <!-- #ativos-->
    <div id="ativos">
        <p>Aqui estão listados todos os selos que você tem permissão de editar</p>
        <?php foreach($seals as $entity): if($app->user->profile->equals($entity)) continue;?>
            <?php $this->part('panel-seal', array('entity' => $entity)); ?>
        <?php endforeach; ?>
    </div>
    <!-- #meus-->
    <div id="meus">
        <?php foreach($user->enabledSeals as $entity): if($app->user->profile->equals($entity)) continue;?>
            <?php $this->part('panel-seal', array('entity' => $entity)); ?>
        <?php endforeach; ?>
    </div>
    <!-- #rascunhos-->
    <div id="rascunhos">
        <?php foreach($app->user->draftSeals as $entity): ?>
            <?php $this->part('panel-seal', array('entity' => $entity)); ?>
        <?php endforeach; ?>
        <?php if(!$user->draftSeals): ?>
            <div class="alert info"><?php \MapasCulturais\i::_e("Você não possui nenhum rascunho selo.");?></div>
        <?php endif;?>
    </div>
    <!-- #lixeira-->
    <div id="lixeira">
        <?php foreach($app->user->trashedSeals as $entity): ?>
            <?php $this->part('panel-seal', array('entity' => $entity));?>
        <?php endforeach; ?>
        <?php if(!$user->trashedSeals):  ?>
            <div class="alert info"><?php \MapasCulturais\i::_e("Você não possui nenhum selo na lixeira.");?></div>
        <?php endif; ?>
    </div>
    <!-- #lixeira-->
	<!-- #arquivo-->
    <div id="arquivo">
        <?php foreach($app->user->archivedSeals as $entity): ?>
            <?php $this->part('panel-seal', array('entity' => $entity));?>
        <?php endforeach; ?>
        <?php if(!$user->archivedSeals):  ?>
            <div class="alert info"><?php \MapasCulturais\i::_e("Você não possui nenhum selo arquivado.");?></div>
        <?php endif; ?>
    </div>
    <!-- #arquivo-->
	<!-- #permitido-->
	<div id="permitido">
		<?php foreach($app->user->hasControlSeals as $entity): ?>
			<?php $this->part('panel-seal', array('entity' => $entity, 'only_edit_button' => true)); ?>
		<?php endforeach; ?>
		<?php if(!$app->user->hasControlSeals): ?>
			<div class="alert info"><?php \MapasCulturais\i::_e("Você não possui nenhum selo liberado.");?></div>
		<?php endif; ?>
	</div>
	<!-- #permitido-->
</div>
