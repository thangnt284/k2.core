<?php
/**
 * @team: FsFlex Team
 * @since: 1.0.0
 * @author: KP
 */
function K2FileScanFromDirectory($dir, $mask, $options = array(), $depth = 0) {
    $options += array(
        'nomask' => '/(\.\.?|CSV)$/',
        'callback' => 0,
        'recurse' => TRUE,
        'key' => 'uri',
        'min_depth' => 0,
    );

    $options['key'] = in_array($options['key'], array('uri', 'filename', 'name')) ? $options['key'] : 'uri';
    $files = array();
    if (is_dir($dir) && $handle = opendir($dir)) {
        while (FALSE !== ($filename = readdir($handle))) {
            if (!preg_match($options['nomask'], $filename) && $filename[0] != '.') {
                $uri = "$dir/$filename";
                if (is_dir($uri) && $options['recurse']) {
                    // Give priority to files in this folder by merging them in after any subdirectory files.
                    $files = array_merge(K2FileScanFromDirectory($uri, $mask, $options, $depth + 1), $files);
                } elseif ($depth >= $options['min_depth'] && preg_match($mask, $filename)) {
                    // Always use this match over anything already set in $files with the
                    // same $$options['key'].
                    $file = new stdClass();
                    $file->uri = $uri;
                    $file->filename = $filename;
                    $file->name = pathinfo($filename, PATHINFO_FILENAME);
                    $files[$filename] = $file;
                }
            }
        }
        closedir($handle);
    }
    return $files;
}