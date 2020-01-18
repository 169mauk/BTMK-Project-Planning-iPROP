using Newtonsoft.Json;
using System;
using System.Collections.Generic;
using System.Dynamic;
using System.Linq;
using System.Text;

using Xamarin.Forms;

namespace HITPM.Pages.projects
{
    public class Tasks : ContentPage
    {
        StackLayout listView = new StackLayout();
        dynamic p;
        public Tasks(dynamic project)
        {
            p = project;
            ToolbarItems.Add(new ToolbarItem
            {
                Text = "+ Task",
                Order = ToolbarItemOrder.Primary,
                Command = new Command(() => Navigation.PushAsync(new tasks.AddTask()))
            });

            ToolbarItems.Add(new ToolbarItem
            {
                Text = "Refresh",
                Order = ToolbarItemOrder.Primary,
                Command = new Command(() => Refresh())
            });
            
        }

        protected override void OnAppearing()
        {
            base.OnAppearing();

            if(listView.Children.Count < 1)
            {
                Refresh();
            }
        }

        void Refresh()
        {
            dynamic x = new ExpandoObject();
            x.project = Convert.ToString(p.p_id);

            AppService.wb = new System.Net.WebClient();
            string res = AppService.wb.UploadString(Config.APIServer + @"task_list/&access_key=" + Config.ACCESS_KEY, JsonConvert.SerializeObject(x));
            dynamic obj = JsonConvert.DeserializeObject(res);

            listView.Children.Clear();
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
                                    Text = p.t_title.ToString(),
                                    FontAttributes = FontAttributes.Bold,
                                    FontSize = 18
                                },
                                new Label
                                {
                                    Text = Convert.ToString(p.t_content)
                                },
                                new ProgressBar
                                {
                                    Progress = Convert.ToDouble(p.t_percent) / 100
                                },
                                new Label
                                {
                                    Text = Convert.ToString(p.t_percent) + @"% Completed",
                                    FontSize = 10
                                }
                            }
                        },
                        GestureRecognizers =
                        {
                            new TapGestureRecognizer
                            {
                                Command = new Command( () => Navigation.PushAsync(new tasks.EditTask(p)))
                            }
                        }
                    });
                }
            }
            else
            {
                listView.Children.Add(new Label
                {
                    Text = "No record in here yet.",
                    HorizontalTextAlignment = TextAlignment.Center
                });
            }

            Content = new ScrollView
            {
                Padding = 20,
                Content = listView
            };
        }
        private void X_ItemSelected(object sender, SelectedItemChangedEventArgs e)
        {
            if(e.SelectedItem == null)
            {
                return;
            }

            Navigation.PushAsync(new tasks.EditTask());

            ((ListView)sender).SelectedItem = null;
        }
    }
}