using Newtonsoft.Json;
using System;
using System.Collections.Generic;
using System.Dynamic;
using System.Linq;
using System.Text;

using Xamarin.Forms;

namespace HITPM.Pages.Jobs
{
    public class AddJob : ContentPage
    {
        public AddJob()
        {
            Title = "Create To-Do";

            var title = new Entry
            {
                Placeholder = "Title"
            };

            var description = new Editor
            {
                Placeholder = "Description",
                HeightRequest = 100
            };

            var projects = new Picker
            {

            };

            List<dynamic> listProject = new List<dynamic>();
            dynamic x = new ExpandoObject();
            x.department = Session.department;

            string res = AppService.wb.UploadString(Config.APIServer + @"project_list/&access_key=" + Config.ACCESS_KEY, JsonConvert.SerializeObject(x));

            dynamic obj = JsonConvert.DeserializeObject(res);

            if (obj != null && obj.Count > 0)
            {

                foreach (dynamic p in obj)
                {
                    listProject.Add(p);
                    projects.Items.Add(Convert.ToString(p.p_name));
                }
            }

            Content = new StackLayout
            {
                Margin = 20,
                Children = {
                    new Label
                    {
                        Text = "Job Title"
                    },
                    title, description, projects,
                    new Button
                    {
                        Text = "Create To-Do",
                        BackgroundColor = Color.Green,
                        TextColor = Color.White,
                        Margin = new Thickness(0, 20),
                        Command = new Command(() => {
                            if(string.IsNullOrEmpty(title.Text) || projects.SelectedIndex < 0)
                            {
                                DisplayAlert("Oops Error!", "Please insert title and select project.", "Ok");
                            }
                            else
                            {
                                if(listProject.ElementAtOrDefault(projects.SelectedIndex) != null)
                                {
                                    dynamic data = new ExpandoObject();
                                    data.j_title = title.Text;
                                    data.j_description = description.Text;
                                    data.j_project = Convert.ToString(listProject[projects.SelectedIndex].p_id);
                                    data.j_user = Session.user_id;
                                    data.j_by = Session.user_id;
                                    data.j_date = DateTime.Now.ToString("dd-MMM-yyyy");

                                    string r = AppService.wb.UploadString(Config.APIServer + @"jobs/insertInto/&access_key=" + Config.ACCESS_KEY, JsonConvert.SerializeObject(data));

                                    DisplayAlert("Information Saved!", "You To-Do item has been saved usuccessfully.", "Ok");

                                    title.Text = "";
                                    description.Text = "";
                                    projects.SelectedIndex = -1;
                                }
                                else
                                {
                                    DisplayAlert("Oops Error!", "Please select a project.", "Ok");
                                }
                            }
                        })
                    }
                }
            };
        }
    }
}