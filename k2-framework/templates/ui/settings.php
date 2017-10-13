<div class="wrap materialize">
    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12" jstcache="0">
        <div class="card">
            <div class="header">
                <h2><?php echo htmlentities($title) ?>
                    <small><?php echo htmlentities($description) ?></small>
                </h2>
            </div>
            <div class="body">

                <?php do_action("fs_{$slug}_settings_page_before"); ?>

                <form method="POST">
                    <?php echo $body ?>
                    <button id="" type="submit" class="btn <?php echo htmlentities($button_class) ?> waves-effect"
                            name="<?php echo "{$slug}[submit]" ?>"><?php esc_html_e('Save Changes', 'fsflex'); ?></button>
                </form>

                <?php do_action("fs_{$slug}_settings_page_after"); ?>
            </div>
        </div>
    </div>
</div>
