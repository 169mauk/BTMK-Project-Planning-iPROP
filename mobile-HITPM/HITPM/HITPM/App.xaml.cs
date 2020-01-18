using Newtonsoft.Json;
using System;
using System.Diagnostics;
using System.Dynamic;
using System.IO;
using System.Threading;
using System.Threading.Tasks;
using Xamarin.Forms;
using Xamarin.Forms.Xaml;

namespace HITPM
{
    public partial class App : Application
    {
        public static CancellationTokenSource cancellationToken { get; set; }
        public static MasterDetailPage MasterDetailPage;
        public App()
        {
            InitializeComponent();

            if (File.Exists(Config.Login))
            {
                string res = AppService.wb.UploadString(Config.APIServer + @"users/getBy/&access_key=" + Config.ACCESS_KEY, File.ReadAllText(Config.Login));

                dynamic obj = JsonConvert.DeserializeObject(res);

                if (obj != null && obj.Count > 0)
                {
                    Session.department = obj[0].user_department.ToString();
                    Session.user_password = obj[0].user_password.ToString();
                    Session.role = obj[0].user_role.ToString();
                    Session.user_id = obj[0].user_id.ToString();
                    Session.user_login = obj[0].user_login.ToString();

                    //Debug.WriteLine("========================================\n");
                    //Debug.WriteLine("User ID: " + Session.user_id + @"\n");
                    //Debug.WriteLine("========================================\n\n");

                    App.MasterDetailPage = new MasterDetailPage();
                    App.Current.MainPage = new NavigationPage(new Widgets.HomeTab());
                }
                else
                {
                    MainPage = new Pages.Login();
                }
            }
            else
            {
                MainPage = new Pages.Login();
            }
        }

        protected override void OnStart()
        {
            // Handle when your app starts
            //Task.Run(async () => await timer());
        }

        //private bool shown = false;
        //private async Task timer()
        //{
        //    while (true)
        //    {
        //        try
        //        {
        //            await Task.Delay(3000, cancellationToken.Token).ContinueWith(async (arg) =>
        //            {
        //                if (!string.IsNullOrEmpty(Session.user_id))
        //                {
        //                    dynamic reqo = new ExpandoObject();
        //                    reqo.a_to = Session.user_id;
        //                    reqo.a_seen = "0";

        //                    string res = AppService.wb.UploadString(Config.APIServer + @"activities/getBy/&access_key=" + Config.ACCESS_KEY, JsonConvert.SerializeObject(reqo));

        //                    dynamic obj = JsonConvert.DeserializeObject(res);

        //                    if (obj != null && obj.Count > 0)
        //                    {
        //                        foreach (dynamic v in obj)
        //                        {
        //                            DependencyService.Get<IANotification>().CreateNotification("PM: " + Convert.ToString(v.a_title), Convert.ToString(v.a_description), "c" + Convert.ToString(v.a_id));

        //                            dynamic update = new ExpandoObject();
        //                            update.a_seen = "1";

        //                            AppService.wb.UploadString(Config.APIServer + @"activities/updateBy/a_id=" + Convert.ToString(v.a_id) + @"&access_key=" + Config.ACCESS_KEY, JsonConvert.SerializeObject(update));
        //                        }
        //                    }

        //                }
        //            });
        //        }catch(Exception ex)
        //        {
        //            File.WriteAllText(Config.LogFile, DateTime.Now.ToString("ddd, MMM d, yyyy - HH:mm:ss") + @" - App.xaml.cs exception: " + ex.Message);
        //        }
        //    }
        //}

        protected override void OnSleep()
        {
            // Handle when your app sleeps
        }

        protected override void OnResume()
        {
            // Handle when your app resumes
        }
    }
}
