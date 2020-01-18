using Newtonsoft.Json;
using System;
using System.Collections.Generic;
using System.Dynamic;
using System.Linq;
using System.Text;

using Xamarin.Forms;

namespace HITPM.Pages.projects
{
    public class Reports : ContentPage
    {
        dynamic project;
        StackLayout reports = new StackLayout();
        public Reports(dynamic p)
        {
            project = p;
            ToolbarItems.Add(new ToolbarItem
            {
                Text = "+ Claim",
                Order = ToolbarItemOrder.Primary,
                Command = new Command(() => Navigation.PushAsync(new AddClaim(project)))
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

            if(reports.Children.Count < 1)
            {
                Refresh();
            }
        }

        void Refresh()
        {
            dynamic x = new ExpandoObject();
            x.r_project = project.p_id.ToString();

            string res = AppService.wb.UploadString(Config.APIServer + @"reports/getBy/&access_key=" + Config.ACCESS_KEY, JsonConvert.SerializeObject(x));

            dynamic obj = JsonConvert.DeserializeObject(res);
            reports.Children.Clear();

            if (obj != null && obj.Count > 0)
            {
                foreach (dynamic rep in obj)
                {
                    string status = Convert.ToString(rep.r_status);
                    var color = Color.Black;
                    switch (status)
                    {
                        case "0":
                            status = "Pending";
                            color = Color.Orange;
                            break;

                        case "1":
                            status = "Approved";
                            color = Color.Green;
                            break;

                        case "2":
                            status = "Declined";
                            color = Color.Red;
                            break;
                    }

                    reports.Children.Add(new Frame
                    {
                        Content = new StackLayout
                        {
                            Children = {
                                new Label{
                                    Text = Convert.ToString(rep.r_title),
                                    FontAttributes = FontAttributes.Bold,
                                    FontSize = 18
                                },
                                new Label
                                {
                                    Text = Convert.ToString(rep.r_date)
                                },
                                new Label
                                {
                                    Text = status,
                                    FontAttributes = FontAttributes.Bold,
                                    TextColor = color
                                }
                            }
                        },
                        GestureRecognizers =
                        {
                            new TapGestureRecognizer
                            {
                                //Command = new Command(() => Navigation.PushAsync())
                            }
                        }
                    });
                }

                Content = new ScrollView
                {
                    Padding = 20,
                    Content = reports
                };
            }
            else
            {
                Content = new StackLayout
                {
                    Margin = 20,
                    Children =
                        {
                            new Label
                            {
                                Text = "No Report."
                            }
                        }
                };

            }
        }
    }
}