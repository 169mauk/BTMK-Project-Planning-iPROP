using Newtonsoft.Json;
using System;
using System.Collections.Generic;
using System.Dynamic;
using System.IO;
using System.Linq;
using System.Net;
using System.Text;
using System.Threading.Tasks;
using Xamarin.Forms;

namespace iPROPEIS
{
    public class Login : ContentPage
    {
        ActivityIndicator indicator = new ActivityIndicator();
        Entry username = new Entry
        {
            Placeholder = "Username",
            Margin = new Thickness(20, 0, 20, 0),
            PlaceholderColor = Color.White,
            TextColor = Color.White
        };

        Entry password = new Entry
        {
            Placeholder = "Password",
            IsPassword = true,
            Margin = new Thickness(20, 5, 20, 0),
            PlaceholderColor = Color.White,
            TextColor = Color.White
        };
        Button btn = new Button
        {
            Text = "Login",
            TextColor = Color.White,
            WidthRequest = 400,
            BackgroundColor = Color.Red,
            CornerRadius = 20,
            Margin = new Thickness(20, 10, 20, 0),
        };

        public Login()
        {
            btn.Clicked += Btn_Clicked;
            Content = new StackLayout
            {
                BackgroundColor = Color.FromHex("#3b4347"),
                Children = {
                    new Image
                    {
                        Source = ImageSource.FromResource("iPROPEIS.logo_kedah.png"),
                        WidthRequest = 150,
                        Margin = new Thickness(20,20,20,0)
                    },
                    new Label
                    {
                        Text = "Welcome to " + Config.TITLE,
                        FontSize = 23,
                        FontAttributes = FontAttributes.Bold,
                        TextColor = Color.White,
                        HorizontalOptions = LayoutOptions.CenterAndExpand,
                        VerticalOptions = LayoutOptions.Center,
                        HorizontalTextAlignment = TextAlignment.Center,
                        Margin = new Thickness(0, 10, 0, 10)

                    },
                    username,password, btn,indicator
                }
            };
        }

        private void Btn_Clicked(object sender, EventArgs e)
        {
            var x = Task.Run(async () => await One());
            x.ContinueWith(async task => await Two());
        }

        async Task One()
        {
            await Task.Run(delegate ()
            {
                Device.BeginInvokeOnMainThread(() =>
                {
                    indicator.IsVisible = true;
                    indicator.IsRunning = true;
                    btn.IsVisible = false;
                });

            });
        }
        async Task Two()
        {
            await Task.Run(delegate ()
            {
                Device.BeginInvokeOnMainThread(() =>
                {
                    dynamic req = new ExpandoObject();
                    req.username = username.Text;
                    req.password = password.Text;

                    WebClient wb = new WebClient();
                    string res = wb.UploadString(Config.HYBRIDSERVER + @"login/", JsonConvert.SerializeObject(req));

                    dynamic obj = JsonConvert.DeserializeObject(res);

                    if (Convert.ToString(obj.status) == "success")
                    {
                        File.WriteAllText(Config.LOGIN, JsonConvert.SerializeObject(obj.data));
                        Application.Current.MainPage = new HomePage();
                    }
                    else
                    {
                        File.WriteAllText(Config.LOGIN, "");
                        DisplayAlert("Oops! Error", Convert.ToString(obj.message), "Ok");
                    }

                    indicator.IsVisible = false;
                    indicator.IsRunning = false;
                    btn.IsVisible = true;
                });
            });
        }
    }
}