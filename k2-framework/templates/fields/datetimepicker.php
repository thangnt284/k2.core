<div class="form-group">
    <div class="form-line">
        <input name="<?php echo isset($name) ? $name : ''; ?>"
               id="<?php echo isset($id) ? $id : ''; ?>" type="text"
               class="<?php echo isset($class) ? $class : 'datepicker' ?> form-control"
               placeholder="<?php echo isset($placeholder) ? $placeholder : esc_html__('Please choose a date...', 'fsflex'); ?>"
               data-format="DD MMMM YYYY" value="<?php echo isset($value) ? $value : ''; ?>">
    </div>
    <?php if (isset($description)): ?>
        <p class="font-italic"><?php echo $description; ?></p>
    <?php endif; ?>
</div>