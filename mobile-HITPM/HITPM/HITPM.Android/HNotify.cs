using System;
using System.Collections.Generic;
using System.Linq;
using System.Text;

using Android.App;
using Android.Content;
using Android.OS;
using Android.Runtime;
using Android.Views;
using Android.Widget;
using HITPM.Droid;

[assembly: Xamarin.Forms.Dependency(typeof(HNotify))]
namespace HITPM.Droid
{
    class HNotify : IANotification
    {
        [Obsolete]
        public void CreateNotification(string title, string message, string channelId)
        {
            try
            {
                if (Build.VERSION.SdkInt < BuildVersionCodes.O)
                {
                    var notification = new Notification.Builder(Application.Context)
                    .SetContentTitle(title)
                    .SetContentText(message)
                    .SetOngoing(true)
                    .Build();

                    //var notificationBuilder = new Android.App.Notification.Builder(Application.Context)
                    //            .SetContentTitle(title)
                    //            .SetSmallIcon(Resource.Drawable.logo)
                    //            .SetContentText(message)
                    //            .SetAutoCancel(true);

                    var notificationManager = NotificationManager.FromContext(Application.Context);

                    notificationManager.Notify(0, notification);
                }
                else
                {
                    //var intent = new Intent(Application.Context, typeof(MainActivity));
                    //intent.AddFlags(ActivityFlags.ClearTop);
                    //var pendingIntent = PendingIntent.GetActivity(Application.Context, 0, intent, PendingIntentFlags.OneShot);

                    //var notificationBuilder = new Android.App.Notification.Builder(Application.Context)
                    //            .SetContentTitle(title)
                    //            .SetSmallIcon(Resource.Drawable.logo)
                    //            .SetContentText(message)
                    //            .SetAutoCancel(true)
                    //            .SetContentIntent(pendingIntent)
                    //            .SetChannelId(channelId);

                    //if (Build.VERSION.SdkInt < BuildVersionCodes.O)
                    //{
                    //    return;
                    //}

                    //var channel = new NotificationChannel(channelId, title, NotificationImportance.Default)
                    //{
                    //    Description = message
                    //};

                    var channel = new NotificationChannel("CHANNEL_ID", "Channel", NotificationImportance.Default)
                    {
                        Description = "Foreground Service Channel"
                    };

                    var notificationManager = (NotificationManager)Application.Context.GetSystemService(Context.NotificationService);
                    notificationManager.CreateNotificationChannel(channel);

                    var notification = new Notification.Builder(Application.Context, "CHANNEL_ID")
                    .SetContentTitle("etc")
                    .SetContentText("etc")
                    .SetOngoing(true)
                    .Build();

                    //var notificationManager = (NotificationManager)Application.Context.GetSystemService(Context.NotificationService);
                    //notificationManager.CreateNotificationChannel(channel);

                    notificationManager.Notify(0, notification);
                }
            }
            catch(Exception e)
            {
                System.Diagnostics.Debug.WriteLine("===================================");
                System.Diagnostics.Debug.WriteLine("Catch: " + e.Message);
                System.Diagnostics.Debug.WriteLine("====================================");
            }
        }
    }
}