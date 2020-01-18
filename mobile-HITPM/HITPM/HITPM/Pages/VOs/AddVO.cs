using Newtonsoft.Json;
using System;
using System.Collections.Generic;
using System.Dynamic;
using System.Linq;
using System.Text;

using Xamarin.Forms;

namespace HITPM.Pages.VOs
{
    public class AddVO : ContentPage
    {
        public AddVO(dynamic project)
        {
            Title = "+ Variation Order";
            var title = new Entry
            {
                Placeholder = "Title"
            };
            var description = new Editor
            {
                Placeholder = "Report Description"
            };
            var amount = new Entry
            {
                Placeholder = "Amount",
                Keyboard = Keyboard.Numeric
            };
            var date = new DatePicker
            {

            };

            var reference = new Entry
            {
                Placeholder = "Refenrence"
            };

            Content = new StackLayout
            {
                Margin = 20,
                Children = {
                    date,
                    title,
                    description,
                    reference,
                    amount,
                    new Button
                    {
                        Text = "Save",
                        BackgroundColor = Color.Green,
                        TextColor = Color.White,
                        Command = new Command(() => {
                            dynamic x = new ExpandoObject();
                            x.v_note = description.Text;
                            x.v_value = amount.Text;
                            x.v_date = date.Date.ToString("dd-MMM-yyyy");
                            x.v_description = title.Text;
                            x.v_project = project.p_id.ToString();
                            x.v_user = Session.user_id;
                            x.v_ref = reference.Text;

                            AppService.wb.UploadString(Config.APIServer + "vo/insertInto/&access_key=" + Config.ACCESS_KEY, JsonConvert.SerializeObject(x));

                            DisplayAlert("Sent!", "Report has been submitted for review.", "Ok");
                            title.Text = "";
                            description.Text = "";
                            amount.Text = "";
                            date.Date = DateTime.Now;
                            reference.Text = "";
                        })
                    }
                }
            };
        }
    }
}