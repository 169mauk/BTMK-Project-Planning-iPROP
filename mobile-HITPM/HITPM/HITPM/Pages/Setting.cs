using Newtonsoft.Json;
using System;
using System.Collections.Generic;
using System.Dynamic;
using System.Linq;
using System.Text;

using Xamarin.Forms;

namespace HITPM.Pages
{
    public class Setting : ContentPage
    {
        public Setting()
        {
            Title = "Setting";
            var noti = new Switch
            {
                IsToggled = true
            };

            noti.Toggled += Noti_Toggled;


            var password1 = new Entry
            {
                Placeholder = "New Password",
                IsPassword = true
            };

            var password2 = new Entry
            {
                Placeholder = "Repeat Password",
                IsPassword = true
            };

            Content = new StackLayout
            {
                Margin = 20,
                Children = {
                    new Frame
                    {
                        Content = new StackLayout
                        {
                            Children =
                            {
                                new Label
                                {
                                    Text = "Notification",
                                    FontAttributes = FontAttributes.Bold
                                },
                                new Label
                                {
                                    Text = "By disabling this setting will stop you from receiveing any notification from this app."
                                },
                                noti
                            }
                        }
                    },
                    new Frame
                    {
                        Content = new StackLayout
                        {
                            Children =
                            {
                                new Label
                                {
                                    Text = "Change Password",
                                    FontAttributes = FontAttributes.Bold
                                },
                                password1, password2,
                                new Button
                                {
                                    Text = "Change Password",
                                    BackgroundColor = Color.Black,
                                    TextColor = Color.White,
                                    Command = new Command(() => {
                                        if(password1.Text == password2.Text)
                                        {
                                            dynamic x = new ExpandoObject();
                                            x.user_password = F.Encrypt(password1.Text);

                                            AppService.wb.UploadString(Config.APIServer + @"users/updateBy/user_id=" + Session.user_id + @"/&access_key=" + Config.ACCESS_KEY, JsonConvert.SerializeObject(x));

                                            Session.user_password = F.Encrypt(password1.Text);
                                            DisplayAlert("Information Updated!", "Your new password has been updated.", "Ok");
                                        }
                                        else
                                        {
                                            DisplayAlert("Oops, Error!", "Please make sure New Password has been repeatedly inserted correctly.", "Ok");
                                        }

                                        password1.Text = "";
                                        password2.Text = "";
                                    })
                                }
                            }
                        }
                    },
                    new Frame
                    {
                        Content = new StackLayout
                        {
                            Children =
                            {
                                new Label
                                {
                                    Text = "Error Logs",
                                    FontAttributes = FontAttributes.Bold
                                },
                                new Label
                                {
                                    Text = "Download error log for this app for improvement."
                                },
                                new Label
                                {
                                    Text = "Download",
                                    HorizontalTextAlignment = TextAlignment.End,
                                    GestureRecognizers =
                                    {
                                        new TapGestureRecognizer
                                        {
                                            Command = new Command(() => {

                                            })
                                        }
                                    }
                                }
                            }
                        }
                    }
                }
            };
        }

        private void Noti_Toggled(object sender, ToggledEventArgs e)
        {
            DisplayAlert("AS", "asd", "Ok");
        }
    }
}