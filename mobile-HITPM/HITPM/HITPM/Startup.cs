using System;
using System.Collections.Generic;
using System.Linq;
using System.Text;

using Xamarin.Forms;

namespace HITPM
{
    public class Startup : ContentPage
    {
        public Startup()
        {
            Content = new StackLayout
            {
                BackgroundColor = Color.FromHex("#3b4347"),
                Children = {
                    new Image
                    {
                        Source = ImageSource.FromResource("HITPM.Photos.logo_kedah.png"),
                        HeightRequest = 200,
                        WidthRequest = 200,
                        Margin = new Thickness(20,40,20,20)
                    },
                    new Label
                    {
                        Text = "Welcome To " + Config.TITLE,
                        HorizontalOptions = LayoutOptions.CenterAndExpand,
                        VerticalOptions = LayoutOptions.Center,
                        TextColor = Color.White,
                        FontAttributes = FontAttributes.Bold,
                        FontSize = 23,
                        HorizontalTextAlignment = TextAlignment.Center,
                        Margin = new Thickness(0,10,0,30)
                    },
                    new Button
                    {
                        Text = "Login",
                        BackgroundColor = Color.Blue,
                        TextColor = Color.White,
                        CornerRadius = 20,
                        Margin = new Thickness(20, 0, 20, 10),
                        Command = new Command(() => {
                            App.Current.MainPage = new Pages.Login();
                        })
                    }
                }
            };
        }
    }
}