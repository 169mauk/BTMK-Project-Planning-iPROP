using Newtonsoft.Json;
using System;
using System.Collections.Generic;
using System.Dynamic;
using System.Linq;
using System.Text;

using Xamarin.Forms;

namespace HITPM.Pages.projects
{
   
    public class VO : ContentPage
    {
        dynamic p;
        StackLayout list = new StackLayout();

        public VO(dynamic project)
        {
            p = project;
            ToolbarItems.Add(new ToolbarItem
            {
                Text = "+ VO",
                Order = ToolbarItemOrder.Primary,
                Command = new Command(() => Navigation.PushAsync(new VOs.AddVO(project)))
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

            if(list.Children.Count < 1)
            {
                list.Children.Add(new Label
                {
                    Text = "Loading Data...",
                    HorizontalTextAlignment = TextAlignment.Center
                });
                Refresh();
            }
        }

        void Refresh()
        {
            dynamic x = new ExpandoObject();
            x.v_project = p.p_id.ToString();

            string res = AppService.wb.UploadString(Config.APIServer + @"vo/getBy/&access_key=" + Config.ACCESS_KEY, JsonConvert.SerializeObject(x));

            dynamic obj = JsonConvert.DeserializeObject(res);

            list.Children.Clear();

            if (obj != null && obj.Count > 0)
            {
                foreach (dynamic v in obj)
                {
                    list.Children.Add(new Frame
                    {
                        Margin = 10,
                        Content = new StackLayout
                        {
                            Children = {
                                new Label
                                {
                                    Text = v.v_description.ToString(),
                                    FontAttributes = FontAttributes.Bold,
                                    FontSize = 18
                                },
                                new Label
                                {
                                    Text = v.v_note.ToString()
                                },
                                new Label
                                {
                                    Text = v.v_date.ToString()
                                },
                                new Label
                                {
                                    Text = "Amount Requested: RM " + v.v_value.ToString(),
                                    Margin = new Thickness(0,0,0,20),
                                    FontAttributes = FontAttributes.Bold
                                },
                                new Label
                                {
                                    Text = v.v_status.ToString() == "1" ? "Approved" : (v.v_status.ToString() == "2" ? "Denied" : "Pending"),
                                    TextColor = v.v_status.ToString() == "1" ? Color.Green : (v.v_status.ToString() == "2" ? Color.Red : Color.Black)
                                }
                            }
                        },
                        GestureRecognizers =
                        {
                            new TapGestureRecognizer
                            {
                               // Command = new Command(() => Navigation.PushAsync(new VOs.ViewVO(v)))
                            }
                        }
                    });
                }
            }
            else
            {
                list.Children.Add(new Label
                {
                    Text = "No VO records in here yet.",
                    HorizontalTextAlignment = TextAlignment.Center
                });
            }

            Content = list;
        }
    }
}