using System;
using System.Collections.Generic;
using System.Linq;
using System.Text;
using System.Threading;
using System.Threading.Tasks;
using Android.App;
using Android.Content;
using Android.OS;
using Android.Runtime;
using Android.Support.V4.App;
using Android.Views;
using Android.Widget;

namespace HITPM.Droid
{
    [Service]
    public class HPushNotiService : Service
    {
        string ChannelId = "YourUniqueChannelID";

        public override void OnCreate()
        {
            if (Build.VERSION.SdkInt < BuildVersionCodes.O)
            {
                var notificationBuilder = new NotificationCompat.Builder(Application.Context, ChannelId)
                            .SetContentTitle("Title A")
                            .SetSmallIcon(Resource.Drawable.logo)
                            .SetContentText("Messagex")
                            .SetAutoCancel(true);

                StartForeground(0, notificationBuilder.Build());
            }
            else
            {
                var notificationBuilder = new NotificationCompat.Builder(Application.Context, ChannelId)
                            .SetContentTitle("Title B")
                            .SetSmallIcon(Resource.Drawable.logo)
                            .SetContentText("Messagey ")
                            .SetAutoCancel(true)
                            .SetChannelId(ChannelId);

                var channel = new NotificationChannel(ChannelId, "Titlee", NotificationImportance.Default)
                {
                    Description = "Messagez"
                };

                var notificationManager = (NotificationManager)Application.Context.GetSystemService(Context.NotificationService);
                notificationManager.CreateNotificationChannel(channel);
                StartForeground(0, notificationBuilder.Build());
            }
        }

        
        
        public override StartCommandResult OnStartCommand(Intent intent, [GeneratedEnum] StartCommandFlags flags, int startId)
        {
            return StartCommandResult.Sticky;
        }

        public override IBinder OnBind(Intent intent)
        {
            throw new NotImplementedException();
        }
    }
}