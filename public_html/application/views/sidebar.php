<!-- start sidebar -->
<div id="sidebar">
    <div id="events" class="roundbox">
        <h2>Events</h2>
        <a href="/event/create">create</a>
        <ul>
            <?php foreach ($events as $event): ?>
            <li><a href="#"><?php echo $event->TITLE ?></a></li>
            <?php endforeach ?>

        </ul>
    </div>
    <div id="jobs" class="roundbox">
        <h2>Jobs</h2>
        <ul>
            <li><a href="#">Engineering</a></li>
        </ul>
    </div>
    <div id="calendar" class="roundbox">
        <h2>Calendar</h2>
        <div id="calendar_wrap">
            <?php echo $calendar; ?>
        </div>
    </div>
    <div class="roundbox">
        <h2>Invite Friends</h2>
        <ul id="friends">
        </ul>
    </div>
</div>
<!-- end sidebar -->
