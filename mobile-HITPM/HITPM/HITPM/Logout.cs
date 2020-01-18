using System;
using System.Collections.Generic;
using System.Linq;
using System.Text;

using Xamarin.Forms;

namespace HITPM
{
    public class Logout : ContentPage
    {
        public Logout()
        {
            Title = "Logout";
            Content = new StackLayout
            {
                Margin = 30,
                VerticalOptions = LayoutOptions.Center,
                HorizontalOptions = LayoutOptions.Center,
                Children = {
                    new Label {
                        Text = "Are sure to Logout?",
                        FontSize = 20,
                        FontAttributes = FontAttributes.Bold,
                        HorizontalTextAlignment = TextAlignment.Center
                    },
                    new Label
                    {
                        Text = "While you are logged out, you will not receive any notification from this app.",
                        HorizontalTextAlignment = TextAlignment.Center
                    },
                    new Button
                    {
                        Text = "Logout",
                        BackgroundColor = Color.Red,
                        TextColor = Color.White,
                        Command = new Command(() => {
                            Session.department = Session.role = Session.user_id = Session.user_login = Session.user_password = "";

                            App.Current.MainPage = new Pages.Login();
                        })
                    }
                }
            };
        }
    }
}