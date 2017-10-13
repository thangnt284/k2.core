<div class="form-group">
    <div class="form-line">
        <textarea rows="<?php echo isset($rows) ? $rows : 4; ?>" name="<?php echo isset($name) ? $name : ''; ?>"
                  id="<?php echo isset($id) ? $id : ''; ?>"
                  class="form-control no-resize"
                  placeholder="<?php echo isset($placeholder) ? $placeholder : esc_html__('Please type what you want...', 'fsflex'); ?>"><?php echo isset($value) ? $value : ''; ?></textarea>
    </div>
    <?php if (isset($description)): ?>
        <p class="font-italic"><?php echo $description; ?></p>
    <?php endif; ?>
</div>