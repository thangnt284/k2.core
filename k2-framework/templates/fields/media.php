<?php
$src = 'http://placehold.it/150x150';
if ( isset( $value ) ) {
	if ( wp_get_attachment_image_src( $value ) !== false ) {
		$src = wp_get_attachment_url( $value );
	} else if ( wp_mime_type_icon( $value ) !== false ) {
		$src = wp_mime_type_icon( $value );
	}
}
?>
<div class="form-group fs_meida">
    <div class="media">
        <img class="media-object" src="<?php echo $src; ?>" style="max-width: 150px;">
    </div>

    <input class="hidden media_file" id="<?php echo isset( $id ) ? $id : ''; ?>"
           name="<?php echo isset( $name ) ? $name : ''; ?>"
           value="<?php echo isset( $value ) ? $value : ''; ?>">

    <button class="upload_media btn btn-primary waves-effect <?php echo ( $src == 'http://placehold.it/150x150' ) ? '' : 'hide'; ?>"><?php esc_html_e( 'Upload', 'fsflex' ); ?></button>
    <button class="remove_media btn btn-danger waves-effect <?php echo ( $src == 'http://placehold.it/150x150' ) ? 'hide' : ''; ?>"><?php esc_html_e( 'Remove', 'fsflex' ); ?></button>

	<?php if ( isset( $description ) ): ?>
        <p class="font-italic"><?php echo $description; ?></p>
	<?php endif; ?>
</div>