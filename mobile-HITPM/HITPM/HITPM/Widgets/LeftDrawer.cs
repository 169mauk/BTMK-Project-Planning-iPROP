using System;
using System.Collections.Generic;
using System.Linq;
using System.Text;

using Xamarin.Forms;

namespace HITPM.Widgets
{
    public class LeftDrawer : ContentPage
    {
        public LeftDrawer()
        {
            Title = "Menu";

            List<dynamic> menus = new List<dynamic>();

            menus.Add("Dashboard");
            menus.Add("Projects");
            //menus.Add("Task");
            menus.Add("EOT");
            menus.Add("VO");
            menus.Add("Reports");
            menus.Add("Log Out");

            ListView menu = new ListView();
            menu.ItemsSource = menus;
            menu.ItemTapped += Menu_ItemTapped;

            var x = new ProgressBar();
            
            Content = new StackLayout {
                Children =
                {
                    new Label
                    {
                        Text = "Welcome, user!",
                        FontSize = 18,
                        Margin = new Thickness(20,20,20,20),
                        FontAttributes = FontAttributes.Bold
                    },
                    menu
                }
            };
        }

        private async void Menu_ItemTapped(object sender, ItemTappedEventArgs e)
        {
            switch (e.Item.ToString())
            {
                case "Dashboard":
                    App.MasterDetailPage = new MasterDetailPage();
                    App.MasterDetailPage.Master = new Widgets.LeftDrawer();
                    App.MasterDetailPage.Detail = new NavigationPage(new Pages.Dashboard());
                    App.Current.MainPage = App.MasterDetailPage;

                break;

                case "Projects":
                    App.MasterDetailPage = new MasterDetailPage();
                    App.MasterDetailPage.Master = new Widgets.LeftDrawer();
                    App.MasterDetailPage.Detail = new NavigationPage(new Pages.Projects());
                    App.Current.MainPage = App.MasterDetailPage;
                    //App.Current.MainPage = new NavigationPage(new Pages.Projects());
                break;

                case "Task":
                    App.MasterDetailPage = new MasterDetailPage();
                    App.MasterDetailPage.Master = new Widgets.LeftDrawer();
                    App.MasterDetailPage.Detail = new NavigationPage(new Pages.Tasks());
                    App.Current.MainPage = App.MasterDetailPage;
                    //App.Current.MainPage = new NavigationPage(new Pages.Tasks());
                    break;

                case "Reports":
                    App.MasterDetailPage = new MasterDetailPage();
                    App.MasterDetailPage.Master = new Widgets.LeftDrawer();
                    App.MasterDetailPage.Detail = new NavigationPage(new Pages.Reports());
                    App.Current.MainPage = App.MasterDetailPage;
                    //App.Current.MainPage = new NavigationPage(new Pages.Reports());
                    break;

                case "Log Out":
                    bool x = await DisplayAlert("", "Do you want to logout now?", "Yes", "No");

                    if (x)
                    {
                        Application.Current.MainPage = new Startup();
                    }
                    else
                    {

                    }
                break;

                default:
                    break;
            }
        }
    }
}