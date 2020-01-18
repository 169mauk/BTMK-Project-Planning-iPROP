using Newtonsoft.Json;
using System;
using System.Collections.Generic;
using System.Dynamic;
using System.Linq;
using System.Text;

using Xamarin.Forms;

namespace HITPM.Pages.tasks
{
    public class EditTask : ContentPage
    {
        public EditTask()
        {
        }

        public EditTask(dynamic p)
        {
            Title = "Edit Task";

            var reportstatus = new List<string>();
            reportstatus.Add("Pending");
            reportstatus.Add("Approved");
            reportstatus.Add("Rejected");

            var picker = new Picker { Title = "Status", TitleColor = Color.Red };
            picker.ItemsSource = reportstatus;

            Content = new StackLayout
            {
                Margin = new Thickness(20, 20, 20, 20),
                Children = {
                    new Frame
                    {
                        Content = new StackLayout
                        {
                            Children=
                            {
                                new Entry
                                {
                                    Placeholder = "Task",
                                    Text = "Task 1"
                                },
                                new Entry
                                {
                                    Placeholder = "Project",
                                    Text = "Project 1"
                                },
                                new Entry
                                {
                                    Placeholder = "Tags"
                                },
                                new Entry
                                {
                                    Placeholder = "Category",
                                    Text = "Category 1"
                                },
                               picker,
                                  new Entry
                                {
                                    Placeholder = "Content"
                                },
                                new Button
                                {
                                    Text = "Save",
                                    TextColor = Color.White,
                                    BackgroundColor = Color.Red,
                                    Margin = new Thickness(20,20,20,20),
                                    CornerRadius = 20,
                                    Command = new Command(() => {
                                        dynamic x = new ExpandoObject();
                                        x.e_user = Session.user_id;

                                        AppService.wb.UploadString(Config.APIServer + "tasks/insertInto/&access_key=" + Config.ACCESS_KEY, JsonConvert.SerializeObject(x));

                                        DisplayAlert("Success!", "Data saved.", "Ok");
                                    })
                                }
                            }
                        }
                    }
                }
            };
        }
    }
}