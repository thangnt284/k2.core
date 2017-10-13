<div class="materialize" style="overflow: hidden;">
    <div class="col-md-12 col-lg-12 col-sm-12 col-xs-12">
        <ul class="nav nav-tabs" role="tablist">
            <?php if (isset($tabs) && is_array($tabs)): foreach ($tabs as $key => $tab):
                $active = false;
                $icon = '';
                $title = '';
                $description = '';
                extract($tab);
                ?>
                <li role="presentation" class="<?php echo $active == true ? 'active' : ''; ?>"
                    title="<?php echo $description; ?>">
                    <a href="<?php echo '#' . $key; ?>" data-toggle="tab">
                        <i class="material-icons"><?php echo $icon; ?></i><?php echo $title; ?>
                    </a>
                </li>
            <?php endforeach; endif; ?>
        </ul>

        <div class="tab-content">
            <?php if (isset($tabs) && is_array($tabs)): foreach ($tabs as $key => $tab):
                $active = false;
                $content = '';
                $description = '';
                extract($tab);
                ?>
                <div style="overflow: hidden" role="tabpanel"
                     class="tab-pane <?php echo $active == true ? 'active' : ''; ?>"
                     id="<?php echo $key; ?>">
                    <?php if (isset($description)): ?>
                        <p class="font-italic"><?php echo $description; ?></p>
                    <?php endif; ?>
                    <?php do_action("fs_{$key}_tab_content_before"); ?>
                    <?php echo $content; ?>
                    <?php do_action("fs_{$key}_tab_content_after"); ?>
                </div>
            <?php endforeach; endif; ?>
        </div>
    </div>
</div>