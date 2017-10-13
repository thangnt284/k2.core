<div class="form-group">
    <input type="checkbox" name="<?php echo isset($name) ? $name : '' ?>"
           id="<?php echo isset($id) ? $id : 'basic_checkbox_1' ?>" <?php echo (isset($checked) && $checked === true) ? 'checked' : ''; ?>>
    <label style="margin-top: 10px;" for="<?php echo isset($id) ? $id : 'basic_checkbox_1' ?>"><?php //echo isset($label) ? $label : '' ?></label>
    <?php if (isset($description)): ?>
        <p class="font-italic"><?php echo $description; ?></p>
    <?php endif; ?>
</div>