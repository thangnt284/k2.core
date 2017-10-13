<?php do_action("fs_{$id}_element_before"); ?>
<div class="row clearfix">
    <div class="<?php echo isset($class_label) ? $class_label : 'col-lg-4 col-md-4 col-sm-4'; ?> col-xs-12">
        <label class="custom_label" style="margin: 15px 0px 0px 0px;"
               for="<?php echo isset($id) ? $id : ''; ?>"><?php echo isset($label) ? $label : ''; ?></label>
    </div>
    <div class="<?php echo isset($class_content) ? $class_content : 'col-lg-5 col-md-6 col-sm-8'; ?> col-xs-12">
        <?php echo isset($content) ? $content : ''; ?>
    </div>
</div>
<?php do_action("fs_{$id}_element_after"); ?>