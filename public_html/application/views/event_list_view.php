
<!-- start content -->
<div id="content">
    <?php foreach ($events as $event) : ?>
    <div class="eventsummary roundbox">
        <div>
            <a  class="title" href="/event/show/<?=$event->id?>"><?php echo $event->title ?></a>
            <span class="date"><?php echo date('n/j/Y', strtotime($event->start)); ?></span>
        </div>
        <span>hosted by<a href="event/hostby/<?=$event->owner?>"> <?php echo $event->owner_name ?></a>, </span>
        <span><?= $event->enrollment ?> enrolled</span>

        <?php if ($event->subscribed == true) { ?>
            <span class="clickbutton unsubscribe_button" eid="<?= $event->id ?>">quit</span>
        <?php } else { ?>
            <span class="clickbutton subscribe_button" eid="<?= $event->id ?>">sign up</span>
        <?php } ?>
    </div>
    <?php endforeach ?>
</div>
<!-- end content -->

