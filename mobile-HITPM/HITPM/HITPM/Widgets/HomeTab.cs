using System;
using System.Collections.Generic;
using System.Linq;
using System.Text;

using Xamarin.Forms;

namespace HITPM.Widgets
{
    public class HomeTab : TabbedPage
    {
        public HomeTab()
        {
            Title = Config.TITLE;

            ToolbarItems.Add(new ToolbarItem
            {
                Order = ToolbarItemOrder.Secondary,
                Text = "Logout",
                Command = new Command(() =>
                {
                    Navigation.PushAsync(new Logout());
                })
            });

            Children.Add(new Pages.Dashboard());
            Children.Add(new Pages.Projects());
            //Children.Add(new Pages.MyToDo());
            Children.Add(new Pages.Setting());
        }
    }
}