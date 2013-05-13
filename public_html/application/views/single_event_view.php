<div id="content">
    <div class="event roundbox">
        <p class="date"><?php echo date('M j', strtotime($event->start)); ?></p>
        <h2 class="title"><?= $event->title ?></h2>
        <a href="/event/delete/<?= $event->id ?>">delete</a>
        <span class="meta">hosted by <?= $event->owner_name ?></span>
        <?php if ($event->subscribed == true) { ?>
            <span class="clickbutton unsubscribe_button" eid="<?= $event->id ?>">quit</span>
        <?php } else { ?>
            <span class="clickbutton subscribe_button" eid="<?= $event->id ?>">sign up</span>
        <?php } ?>
        <div class="entry"><?= $event->description ?></div>
    </div>
</div>