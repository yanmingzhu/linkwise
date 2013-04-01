
<!-- start content -->
<div id="content">
    <?php foreach ($events as $event) : ?>
    <div class="event roundbox">
        <p class="date"><?php echo date('M j', strtotime($event->STARTTIME)); ?></p>
        <h2 class="title"><?= $event->TITLE ?></h2>
        <a href="http://www.linkwise.org/event/delete/<?= $event->ID ?>">delete</a>
        <span class="meta"><small>created by <?= $event->OWNER ?></small></span>
        <div class="entry"><?= $event->CONTENT ?></div>
    </div>
    <?php endforeach ?>
</div>
<!-- end content -->

