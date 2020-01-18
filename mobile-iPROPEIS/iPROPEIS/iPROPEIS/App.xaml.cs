using System;
using Xamarin.Forms;
using Xamarin.Forms.Xaml;
using System.IO;
using Newtonsoft.Json;
using System.Net;

namespace iPROPEIS
{
    public partial class App : Application
    {
        public App()
        {
            InitializeComponent();
            
            if (File.Exists(Config.LOGIN))
            {
                string log = File.ReadAllText(Config.LOGIN);

                if(!string.IsNullOrEmpty(log) && !string.IsNullOrWhiteSpace(log) && log != "")
                {
                    WebClient wb = new WebClient();
                    string res = wb.UploadString(Config.HYBRIDSERVER + @"login/", log);

                    dynamic obj = JsonConvert.DeserializeObject(res);

                    if(Convert.ToString(obj.status) == "success")
                    {
                        File.WriteAllText(Config.LOGIN, JsonConvert.SerializeObject(obj.data));
                        MainPage = new HomePage();
                    }
                    else
                    {
                        File.WriteAllText(Config.LOGIN, "");
                        MainPage = new Login();
                    }
                }
                else
                {
                    MainPage = new Login();
                }
            }
            else
            {
                MainPage = new Login();
            }
        }

        protected override void OnStart()
        {
        }

        protected override void OnSleep()
        {
        }

        protected override void OnResume()
        {
        }
    }
}
