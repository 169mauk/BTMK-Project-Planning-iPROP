using Newtonsoft.Json;
using System;
using System.Collections.Generic;
using System.Diagnostics;
using System.Dynamic;
using System.IO;
using System.Linq;
using System.Text;

using Xamarin.Forms;

namespace HITPM.Pages
{
    public class Projects : ContentPage
    {
        public Projects()
        {
            Title = "Projects";

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
            try
            {
                StackLayout listView = new StackLayout();

                dynamic x = new ExpandoObject();
                x.department = Session.department;
                x.role = Session.role;
                x.user = Session.user_id;

                string res = AppService.wb.UploadString(Config.APIServer + @"project_list/&access_key=" + Config.ACCESS_KEY, JsonConvert.SerializeObject(x));

                dynamic obj = JsonConvert.DeserializeObject(res);

                if (obj != null && obj.Count > 0)
                {
                    foreach (dynamic p in obj)
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
                                    Text = p.p_name.ToString(),
                                    FontAttributes = FontAttributes.Bold,
                                    FontSize = 18
                                },
                                new Label
                                {
                                    Text = Convert.ToString(p.start) + @" to " + Convert.ToString(p.end)
                                },
                                new ProgressBar
                                {
                                    Progress = Convert.ToDouble(Convert.ToDouble(p.percent) / 100)
                                },
                                new Label
                                {
                                    Text = Convert.ToString(p.percent) + @"% Completed.",
                                    FontSize = 10
                                }
                            }
                            },
                            GestureRecognizers =
                        {
                            new TapGestureRecognizer
                            {
                                Command = new Command( () => Navigation.PushAsync(new projects.ProjectTabMenu(p)))
                            }
                        }
                        });
                    }
                }

                Content = new ScrollView
                {
                    Padding = 20,
                    Content = listView
                };
            }catch(Exception ex)
            {
                File.AppendAllText(Config.LogFile, "");
            }
        }
    }
}