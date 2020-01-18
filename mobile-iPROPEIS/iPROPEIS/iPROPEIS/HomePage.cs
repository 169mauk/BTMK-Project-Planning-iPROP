using System;
using System.Collections.Generic;
using System.Diagnostics;
using System.Linq;
using System.Text;
using System.IO;

using Xamarin.Forms;
using System.Threading.Tasks;

namespace iPROPEIS
{
    public class HomePage : ContentPage
    {
        HybridWebView hw;
        public HomePage()
        {

            hw = new HybridWebView
            {
                HorizontalOptions = LayoutOptions.FillAndExpand,
                VerticalOptions = LayoutOptions.FillAndExpand,
                Uri = "index.html"
            };

            hw.RegisterAction(data => { 
                if(data == "logout")
                {
                    File.WriteAllText(Config.LOGIN, "");

                    Device.BeginInvokeOnMainThread(() =>
                    {
                        App.Current.MainPage = new Login();
                    });
                }
            });

            Content = hw;
        }
    }
}