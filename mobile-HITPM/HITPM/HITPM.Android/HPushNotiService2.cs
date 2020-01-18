using System;
using System.Collections.Generic;
using System.Dynamic;
using System.IO;
using System.Linq;
using System.Net;
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
using Newtonsoft.Json;

namespace HITPM.Droid
{
    [Service]
    class HPushNotiService2 : Service
    {
        Random r;
        public static int FORSERVICE_NOTIFICATION_ID = 10;
        public const string MAIN_ACTIVITY_ACTION = "Main_activity";
        public const string PUT_EXTRA = "has_service_been_started";
        string CHANNEL_ID = "ChannelID2";

        public override void OnCreate()
        {
            registerForService();

            Task.Run(async () => {
                await X();
            });
        }

        async Task X()
        {
            var cancellationToken = new CancellationTokenSource();
            while (true)
            {
                try
                {
                    await Task.Delay(3000, cancellationToken.Token).ContinueWith(async (arg) =>
                    {
                        if (!string.IsNullOrEmpty(Session.user_id))
                        {
                            dynamic reqo = new ExpandoObject();
                            reqo.a_to = Session.user_id;
                            reqo.a_seen = "0";
                            var wb = new WebClient();
                            string res = wb.UploadString(Config.APIServer + @"activities/getBy/&access_key=" + Config.ACCESS_KEY, JsonConvert.SerializeObject(reqo));

                            dynamic obj = JsonConvert.DeserializeObject(res);

                            if (obj != null && obj.Count > 0)
                            {
                                foreach (dynamic v in obj)
                                {
                                    string temp = "Title " + Convert.ToString(v.a_title);
                                    System.Diagnostics.Debug.WriteLine("===================================\n");
                                    System.Diagnostics.Debug.WriteLine(temp);
                                    System.Diagnostics.Debug.WriteLine("====================================\n");

                                    var x2 = new HNotify2();
                                    x2.ScheduleNotification(Convert.ToString(v.a_title), Convert.ToString(v.a_description));

                                    dynamic update = new ExpandoObject();
                                    update.a_seen = "1";

                                    var wbx = new WebClient();
                                    wbx.UploadString(Config.APIServer + @"activities/updateBy/a_id=" + Convert.ToString(v.a_id) + @"&access_key=" + Config.ACCESS_KEY, JsonConvert.SerializeObject(update));
                                }
                            }
                            else
                            {
                                System.Diagnostics.Debug.WriteLine("===================================\n");
                                System.Diagnostics.Debug.WriteLine("OBJ is Empty\n");
                                System.Diagnostics.Debug.WriteLine("====================================\n");
                            }
                        }
                    });
                }
                catch (Exception ex)
                {
                    System.Diagnostics.Debug.WriteLine("===========================\n");
                    System.Diagnostics.Debug.WriteLine("Catch HPushNotiService2: " + ex.Message + @"\n");
                    System.Diagnostics.Debug.WriteLine("===========================\n");
                    //File.WriteAllText(Config.LogFile, DateTime.Now.ToString("ddd, MMM d, yyyy - HH:mm:ss") + @" - App.xaml.cs exception: " + ex.Message);
                }
            }
        }

        public override IBinder OnBind(Intent intent)
        {
            return null;
        }

        public override StartCommandResult OnStartCommand(Intent intent, StartCommandFlags flags, int startId)
        {
            return StartCommandResult.Sticky;
        }

        private void registerForService()
        {
            r = new Random();
            FORSERVICE_NOTIFICATION_ID = r.Next(10000, 99999);
            CHANNEL_ID = "ChannelID" + FORSERVICE_NOTIFICATION_ID.ToString();

            if (Build.VERSION.SdkInt >= BuildVersionCodes.O)
            {
                var channel = new NotificationChannel(CHANNEL_ID, "Channel", NotificationImportance.Default)
                {
                    Description = "Notification Service"
                };

                var notificationManager = (NotificationManager)GetSystemService(NotificationService);
                notificationManager.CreateNotificationChannel(channel);

                var notification = new Notification.Builder(this, CHANNEL_ID)
                .SetContentTitle("etc")
                .SetContentText("etc")
                //.SetContentIntent(BuildIntentToShowMainActivity())
                .SetOngoing(true)
                .Build();

                StartForeground(FORSERVICE_NOTIFICATION_ID, notification);
            }
            else
            {
                var notification = new Notification.Builder(this)
                    .SetContentTitle("etc")
                    .SetContentText("etc")
                    //.SetContentIntent(BuildIntentToShowMainActivity())
                    .SetOngoing(true)
                    .Build();

                StartForeground(FORSERVICE_NOTIFICATION_ID, notification);
            }
        }

        PendingIntent BuildIntentToShowMainActivity()
        {
            var notificationIntent = new Intent(this, typeof(MainActivity));
            notificationIntent.SetAction(MAIN_ACTIVITY_ACTION);
            notificationIntent.SetFlags(ActivityFlags.SingleTop | ActivityFlags.ClearTask);
            notificationIntent.PutExtra(PUT_EXTRA, true);

            var pendingIntent = PendingIntent.GetActivity(this, 0, notificationIntent, PendingIntentFlags.UpdateCurrent);
            return pendingIntent;
        }

        public override void OnDestroy()
        {
            // Remove the notification from the status bar.
            var notificationManager = (NotificationManager)GetSystemService(NotificationService);
            notificationManager.Cancel(FORSERVICE_NOTIFICATION_ID);
            StopSelf();
            StopForeground(true);

            base.OnDestroy();
        }
    }
}