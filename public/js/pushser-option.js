var notificationsWrapper   = $('.notifications');
var notificationsToggle    = notificationsWrapper.find('a[data-toggle]');
var notificationsCountElem = notificationsToggle.find('i[data-count]');
var notificationsCount     = parseInt(notificationsCountElem.data('count'));
var notifications          = notificationsWrapper.find('.list-notifications');


// Enable pusher logging - don't include this in production
 Pusher.logToConsole = true;

// var pusher = new Pusher('{{env('PUSHER_APP_KEY')}}', {
//     cluster: 'ap1',
//     encrypted: true
// });

// Subscribe to the channel we specified in our Laravel Event
var channel = pusher.subscribe('Notify');

// Bind a function to a Event (the full Laravel class)
channel.bind('send-message', function(data) {
    var existingNotifications = notifications.html();
    var avatar = Math.floor(Math.random() * (71 - 20 + 1)) + 20;
    var newNotificationHtml = `
      <li class="notification active">
          <div class="media">
            <div class="media-left">
              <div class="media-object">
                <img class="_s0 _4ooo _44ma img"
                    src="https://scontent.fdad1-1.fna.fbcdn.net/v/t1.0-1/p100x100/48411989_1019080898294137_4484730551843946496_n.jpg?_nc_cat=103&amp;_nc_oc=AQmxccIvPqM3MQOqQQTAqs0e1qbNPeTkAADqmSecZic-5mN8C4SCg6KDCTG2lCQhVuz9h3o2Z-Vpqt_trK4OBGpf&amp;_nc_ht=scontent.fdad1-1.fna&amp;oh=84a7b2be2b476ba3e7220775e937835f&amp;oe=5E0D6799"
                    alt="" aria-label="Nguyễn Duy Hiếu" role="img" style="width:40px;height:40px">
              </div>
            </div>
            <div class="media-body">
              <strong class="notification-title">`+data.title+`</strong>
              <p class="notification-desc">`+data.content+`</p>
              <div class="notification-meta">
                <small class="timestamp">about a minute ago</small>
              </div>
            </div>
          </div>
      </li>
    `;
    notifications.html(newNotificationHtml + existingNotifications);

    notificationsCount += 1;
    notificationsCountElem.attr('data-count', notificationsCount);
    notificationsWrapper.find('.notif-count').text(notificationsCount);
    notificationsWrapper.show();
});
