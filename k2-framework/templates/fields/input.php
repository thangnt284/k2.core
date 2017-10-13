<div class="form-group">
    <div class="form-line">
        <input <?php echo isset( $disabled ) ? 'disabled' : ''; ?>
                type="<?php echo isset( $type ) ? $type : 'text'; ?>"
                name="<?php echo isset( $name ) ? $name : ''; ?>"
                id="<?php echo isset( $id ) ? $id : ''; ?>"
                class="form-control"
                placeholder="<?php echo isset( $placeholder ) ? $placeholder : ''; ?>"
                value="<?php echo isset( $value ) ? $value : ''; ?>" <?php echo isset( $min ) ? "min={$min}" : ''; ?> <?php echo isset( $max ) ? "min={$max}" : ''; ?>>
    </div>
	<?php if ( isset( $description ) ): ?>
        <p class="font-italic"><?php echo $description; ?></p>
	<?php endif; ?>
</div>