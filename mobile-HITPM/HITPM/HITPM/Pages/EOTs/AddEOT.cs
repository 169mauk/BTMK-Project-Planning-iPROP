using Newtonsoft.Json;
using System;
using System.Collections.Generic;
using System.Dynamic;
using System.Linq;
using System.Net;
using System.Text;

using Xamarin.Forms;

namespace HITPM.Pages.EOTs
{
    public class AddEOT : ContentPage
    {
        public AddEOT(dynamic project)
        {
            Title = "+ Extension of Time";
            var title = new Entry
            {
                Placeholder = "Title"
            };
            var description = new Editor
            {
                Placeholder = "Description"
            };
            var date = new DatePicker
            {
                
            };

            Content = new StackLayout
            {
                Margin = 20,
                Children = {
                    title,
                    description,
                    new Label
                    {
                        Text = "Requested Date:"
                    },
                    date,
                    new Button
                    {
                        Text = "Save",
                        BackgroundColor = Color.Green,
                        TextColor = Color.White,
                        Command = new Command(() => {
                            dynamic x = new ExpandoObject();
                            x.e_description = title.Text;
                            x.e_end = date.Date.ToString("yyyy-mm-dd");
                            x.e_date = DateTime.Now.ToString("dd-MMM-yyyy");
                            x.e_note = description.Text;
                            x.e_project = project.p_id.ToString();
                            x.e_user = Session.user_id;

                            WebClient wb = new WebClient();
                            wb.UploadString(Config.APIServer + @"eot/insertInto/&access_key=" + Config.ACCESS_KEY, JsonConvert.SerializeObject(x));

                            DisplayAlert("Sent!", "EOT has been submitted for review.", "Ok");
                            title.Text = "";
                            description.Text = "";
                            date.Date = DateTime.Now;
                        })
                    }
                }
            };
        }
    }
}