<h2><?php echo $title_for_step; ?></h2>
<div id="page-content" class="col-sm-9">

    <div class="install form">
        <?php echo $this->Form->create(false, array('url' => array('controller' => 'install', 'action' => 'data')));
        ?>
        <fieldset>
            <legend><?php echo __d('install', 'Database and data'); ?></legend>
            <?php
            echo $this->Form->create(false, array('url' => array('controller' => 'install', 'action' => 'data')));
            echo $this->Form->hidden('run', array('value' => '1'));
            ?>
            <div class="form-group">
                <?php
                echo $this->Form->input('demo_data', array('class' => 'form-control', 'type' => 'checkbox', 'label' => __d('install', 'Load data')));
                ?>
            </div>
            <div class="form-group">
                <?php
                echo __d('install', 'Check load data option to insert dafault values to auxiliary tables.');
                echo '<br/>';
                ?>
            </div>

        </fieldset>
        <div class="form-group">                
            <?php echo $this->Form->button(__('Submit'), array('type'=>'submit','class' => 'btn btn-large btn-primary')); ?>  
        </div>
    </div> <?php echo $this->Form->end(); ?>

</div>

</div>