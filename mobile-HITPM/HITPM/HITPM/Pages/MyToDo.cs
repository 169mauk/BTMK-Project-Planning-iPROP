using Newtonsoft.Json;
using System;
using System.Collections.Generic;
using System.Diagnostics;
using System.Dynamic;
using System.Linq;
using System.Text;

using Xamarin.Forms;

namespace HITPM.Pages
{
    public class MyToDo : ContentPage
    {
        public MyToDo()
        {
            Title = "To-Do List";

            ToolbarItems.Add(new ToolbarItem
            {
                Text = "+ To-Do",
                Order = ToolbarItemOrder.Primary,
                Command = new Command(() =>
                {
                    Navigation.PushAsync(new Pages.Jobs.AddJob());
                })
            });

            ToolbarItems.Add(new ToolbarItem
            {
                Text = "Refresh",
                Order = ToolbarItemOrder.Primary,
                Command = new Command(() => Refresh())
            });

            Refresh();
        }

        void Refresh()
        {
            StackLayout listView = new StackLayout();

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
    }
}