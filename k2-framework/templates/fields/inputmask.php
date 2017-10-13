<div class="form-group">
    <div class="input-group" style="margin-bottom: 0px;">
    <span class="input-group-addon">
        <i class="material-icons"><?php echo isset($icon) ? $icon : ''; ?></i>
    </span>
        <div class="form-line">
            <input name="<?php echo isset($name) ? $name : ''; ?>" id="<?php echo isset($id) ? $id : ''; ?>" type="text"
                   class="form-control <?php echo isset($class) ? $class : ''; ?>"
                   placeholder="<?php echo isset($placeholder) ? $placeholder : '' ?>"
                   value="<?php echo isset($value) ? $value : ''; ?>">
        </div>
    </div>
    <?php if (isset($description)): ?>
        <p class="font-italic"><?php echo $description; ?></p>
    <?php endif; ?>
</div>
