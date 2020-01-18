using Newtonsoft.Json;
using System;
using System.Collections.Generic;
using System.Dynamic;
using System.Linq;
using System.Text;

using Xamarin.Forms;

namespace HITPM.Pages.Jobs
{
    public class EditJob : ContentPage
    {
        public EditJob(dynamic j)
        {
            Title = Convert.ToString(j.j_title);
            Content = new StackLayout
            {
                Margin = 20,
                Children =
                {
                    new Frame
                    {
                        Content = new StackLayout
                        {
                            Children =
                            {
                                new Label
                                {
                                    Text = Convert.ToString(j.j_title),
                                    FontSize = 25,
                                    FontAttributes = FontAttributes.Bold
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
                                }
                            }
                        }
                    },
                    new Button
                    {
                        Margin = new Thickness(0, 20, 0,30),
                        Text = "Mark as Done",
                        BackgroundColor = Color.Green,
                        TextColor = Color.White,
                        Command = new Command(() => {
                            dynamic x = new ExpandoObject();
                            x.j_status = "1";

                            AppService.wb.UploadString(Config.APIServer + @"jobs/updateBy/j_id="+ Convert.ToString(j.j_id) +@"&access_key=" + Config.ACCESS_KEY, JsonConvert.SerializeObject(x));

                            DisplayAlert("Information Sent", "Your submission has been saved. Please refresh your To-Do list to get your latest info.", "Ok");
                        })
                    },
                    new Button
                    {
                        Text = "Show Project Information",
                        BackgroundColor = Color.Blue,
                        TextColor = Color.White,
                        Command = new Command(() => {
                            if(j.project != null)
                            {
                                Navigation.PushAsync(new Pages.projects.ProjectTabMenu(j.project));
                            }
                            else
                            {
                                DisplayAlert("Opps Error!", "The project has been removed before. You cannot view this project.", "Ok");
                            }
                        })
                    }
                }
            };
        }
    }
}