using Newtonsoft.Json;
using System;
using System.Collections.Generic;
using System.Dynamic;
using System.Linq;
using System.Text;
using System.Threading.Tasks;
using Xamarin.Forms;

namespace HITPM.Pages
{
    public class Dashboard : ContentPage
    {
        StackLayout listView = new StackLayout();
        ActivityIndicator ai = new ActivityIndicator
        {
            HorizontalOptions = LayoutOptions.Center,
            IsRunning = true,
            IsVisible = true
        };
        WebView wb = new WebView
        {
            Source = Config.WebViewServer + @"index/&username=" + Session.user_login + @"&password=" + Session.user_password,
            HorizontalOptions = LayoutOptions.FillAndExpand,
            HeightRequest = 280
        };
        public Dashboard()
        {
            Title = "Dashboard";

            ToolbarItems.Add(new ToolbarItem
            {
                Text = "Refresh",
                Command = new Command(() =>
                {
                    wb.Reload();
                    Refresh();
                }),
                Order = ToolbarItemOrder.Primary
            });

            wb.Navigated += Wb_Navigated;
            wb.Navigating += Wb_Navigating;

            Content = new StackLayout
            {
                Children =
                {
                    ai, wb, listView
                }
            };

            Refresh();
        }

        void Refresh()
        {
            dynamic x = new ExpandoObject();
            x.user = Session.user_id;

            string res = AppService.wb.UploadString(Config.APIServer + @"job_list/&access_key=" + Config.ACCESS_KEY, JsonConvert.SerializeObject(x));
            dynamic obj = JsonConvert.DeserializeObject(res);

            if (obj != null && obj.Count > 0)
            {

                foreach (dynamic j in obj)
                {
                    if (j.project != null)
                    {
                        listView.Children.Add(new Frame
                        {
                            HasShadow = true,
                            Content = new StackLayout
                            {
                                Children =
                                {
                                    new Label
                                    {
                                        Text = Convert.ToString(j.j_title),
                                        FontAttributes = FontAttributes.Bold,
                                        FontSize = 18
                                    },
                                    new Label
                                    {
                                        Text = Convert.ToString(j.j_description)
                                    },
                                    new Label
                                    {
                                        Text = "By " + j.from + @" @ " + j.j_date,
                                        FontAttributes = FontAttributes.Bold
                                    },
                                    new Label
                                    {
                                        Text = j.project != null ? "On project '" + Convert.ToString(j.project.p_name) + @"'" : "Unknown"
                                    },
                                    new Label
                                    {
                                        Text = Convert.ToString(j.j_status) == "0" ? "Pending" : "Completed",
                                        TextColor = Convert.ToString(j.j_status) == "0" ? Color.Red : Color.Green,
                                        FontAttributes = FontAttributes.Bold
                                    }
                                }
                            },
                            GestureRecognizers =
                            {
                                new TapGestureRecognizer
                                {
                                    Command = new Command( () => Navigation.PushAsync(new Jobs.EditJob(j)))
                                }
                            }
                        });
                    }
                }
            }
            else
            {
                listView.Children.Add(new Label
                {
                    Text = "You have no To-Do thing.",
                    Margin = new Thickness(0, 30),
                    HorizontalTextAlignment = TextAlignment.Center
                });
            }

            Content = new ScrollView
            {
                Padding = 20,
                Content = listView
            };
        }

        private void Wb_Navigating(object sender, WebNavigatingEventArgs e)
        {
            wb.IsVisible = false;
            ai.IsVisible = true;
        }

        private void Wb_Navigated(object sender, WebNavigatedEventArgs e)
        {
            wb.IsVisible = true;
            ai.IsVisible = false;
        }
    }
}