function subscribeEvent()
{
    $.ajax({
        context: this,
        type: "POST",
        url: "/rpc/subscribe",
        data: {"eid": $(this).attr("eid")},
        success: function(data, status) {
            if (data == "ok") {
                $(this).text("quit");
                $(this).addClass("unsubscribe_button");
                $(this).removeClass("subscribe_button");
                $(this).unbind("click");
                $(this).click(unsubscribeEvent);
            }
        }
    })
}

function unsubscribeEvent()
{
    $.ajax({
        context: this,
        type: "POST",
        url: "/rpc/unsubscribe",
        data: {"eid": $(this).attr("eid")},
        success: function(data, status) {

            if (data == "ok") {
                $(this).text("sign up");
                $(this).addClass("subscribe_button");
                $(this).removeClass("unsubscribe_button");
                $(this).unbind("click");
                $(this).click(subscribeEvent);
            }
        }
    })
}

function pickDate(date)
{
    date_items = date.split("/");
    window.location.href = "/event/ondate/" + date_items[2]+ date_items[0]+ date_items[1];
}