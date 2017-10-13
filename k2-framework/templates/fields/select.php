<div class="form-group">
    <select name="<?php echo isset( $name ) ? $name : ''; ?><?php echo isset( $multiple ) ? '[]' : ''; ?>"
            id="<?php echo isset( $id ) ? $id : ''; ?>"
            class="form-control <?php echo isset( $class ) ? $class : 'show-tick'; ?>" <?php echo isset( $search ) ? 'data-live-search="true"' : ''; ?> <?php echo isset( $multiple ) ? 'multiple' : ''; ?>>
		<?php if ( isset( $options ) && is_array( $options ) ): ?>
			<?php foreach ( $options as $key => $option ): ?>
				<?php
				$selected = '';
				if ( isset( $value ) ) {
					if ( is_array( $value ) ) {
						$selected = in_array( strval( $key ), $value ) ? 'selected' : '';
					} else if ( strval( $value ) == strval( $key ) ) {
						$selected = 'selected';
					}
				}
				?>
                <option value="<?php echo $key; ?>" <?php echo $selected; ?>>
					<?php echo $option; ?>
                </option>
			<?php endforeach; ?>
		<?php endif; ?>

		<?php if ( isset( $optgroups ) && is_array( $optgroups ) ): ?>
			<?php foreach ( $optgroups as $optgroup ): ?>
                <optgroup label="<?php echo $optgroup['label']; ?>">
					<?php foreach ( $optgroup['options'] as $key => $option ): ?>
						<?php
						$selected = '';
						if ( isset( $value ) ) {
							if ( is_array( $value ) ) {
								$selected = in_array( $key, $value ) ? 'selected' : '';
							} else if ( strval( $value ) == strval( $key ) ) {
								$selected = 'selected';
							}
						}
						?>
                        <option value="<?php echo $key; ?>" <?php echo $selected; ?>>
							<?php echo $option; ?>
                        </option>
					<?php endforeach; ?>
                </optgroup>
			<?php endforeach; ?>
		<?php endif; ?>

    </select>
	<?php if ( isset( $description ) ): ?>
        <p class="font-italic"><?php echo $description; ?></p>
	<?php endif; ?>
</div>
