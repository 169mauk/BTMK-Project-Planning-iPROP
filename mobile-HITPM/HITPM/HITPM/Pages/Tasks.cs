using Newtonsoft.Json;
using System;
using System.Collections.Generic;
using System.Dynamic;
using System.Linq;
using System.Text;

using Xamarin.Forms;

namespace HITPM.Pages
{
    public class Tasks : ContentPage
    {
        public Tasks()
        {
            Title = "Tasks";
            StackLayout listView = new StackLayout();

            dynamic x = new ExpandoObject();
            x.t_user = Session.user_id;

            string res = AppService.wb.UploadString(Config.APIServer + @"tasks/list/&access_key=" + Config.ACCESS_KEY, JsonConvert.SerializeObject(x));
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
                                    Text = p.t_title.ToString(),
                                    FontAttributes = FontAttributes.Bold,
                                    FontSize = 18
                                }
                            }
                        },
                        GestureRecognizers =
                        {
                            new TapGestureRecognizer
                            {
                                //Command = new Command( () => Navigation.PushAsync(new tasks.EditTask(p)))
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
        }
    }
}