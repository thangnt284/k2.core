<div class="form-group">
    <div class="switch" style="margin-top: 10px">
        <label><?php esc_html_e('OFF', 'fsflex'); ?><input
                    name="<?php echo isset($name) ? $name : ''; ?>"
                    id="<?php echo isset($id) ? $id : ''; ?>"
                    type="checkbox" <?php echo (isset($checked) && $checked === true) ? 'checked' : ''; ?>><span
                    class="lever"></span><?php esc_html_e('ON', 'fsflex'); ?></label>
    </div>
    <?php if (isset($description)): ?>
        <p class="font-italic"><?php echo $description; ?></p>
    <?php endif; ?>
</div>