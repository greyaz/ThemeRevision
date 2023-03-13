<?php if(intval($opacity*100) != 0): ?>
    <style>.TR .task-board-icons,.TR .task-list-icons{opacity:<?= $opacity ?>}<?= $styles ?></style>
<?php else: ?>
    <style>.TR .task-board-icons,.TR .task-list-icons{display:none}<?= $styles ?></style>
<?php endif ?>
