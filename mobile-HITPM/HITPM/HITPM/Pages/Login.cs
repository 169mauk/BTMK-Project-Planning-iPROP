using Newtonsoft.Json;
using System;
using System.Collections.Generic;
using System.Diagnostics;
using System.Dynamic;
using System.IO;
using System.Linq;
using System.Text;
using System.Threading.Tasks;
using Xamarin.Forms;

namespace HITPM.Pages
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
                        Source = ImageSource.FromResource("HITPM.Photos.logo_kedah.png"),
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
                    dynamic x = new ExpandoObject();
                    x.user_login = username.Text;
                    x.user_password = F.Encrypt(password.Text);

                    string res = AppService.wb.UploadString(Config.APIServer + @"users/getBy/&access_key=" + Config.ACCESS_KEY, JsonConvert.SerializeObject(x));

                    Debug.WriteLine("=================================");
                    Debug.WriteLine(res);
                    Debug.WriteLine("==================");

                    dynamic obj = JsonConvert.DeserializeObject(res);

                    if (obj.Count > 0)
                    {
                        Session.department = obj[0].user_department.ToString();
                        Session.user_password = obj[0].user_password.ToString();
                        Session.role = obj[0].user_role.ToString();
                        Session.user_id = obj[0].user_id.ToString();
                        Session.user_login = obj[0].user_login.ToString();

                        dynamic y = new ExpandoObject();
                        y.user_login = obj[0].user_login.ToString();
                        y.user_password = obj[0].user_password.ToString();

                        File.WriteAllText(Config.Login, JsonConvert.SerializeObject(y));

                        //App.MasterDetailPage = new MasterDetailPage();
                        Device.BeginInvokeOnMainThread(() =>
                        {
                            App.Current.MainPage = new NavigationPage(new Widgets.HomeTab());
                        });
                        
                    }
                    else
                    {
                        DisplayAlert("Opps", "Sorry, your username or password is wrong. ", "Ok");
                    }

                    indicator.IsVisible = false;
                    indicator.IsRunning = false;
                    btn.IsVisible = true;
                });
            });
        }
    }
}