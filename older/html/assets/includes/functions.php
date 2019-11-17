<?php
function nd($class, $id) {
    if (($class !== 'noClass') && ($id !== 'noID')) {
        echo '<div class="' . $class . '" id="'. $id . '">';
    } elseif (isset($class) && $id === 'noID') {
        echo '<div class="' . $class . '">';
    } elseif ($class === 'noClass' && isset($id)) {
        echo '<div id="' . $id . '">';
    }
}

function ed() {
    echo '</div>';
}

