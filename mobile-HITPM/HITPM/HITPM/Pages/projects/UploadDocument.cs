using System;
using System.Collections.Generic;
using System.IO;
using System.Linq;
using System.Net;
using System.Text;
using System.Threading.Tasks;
using Xamarin.Forms;

namespace HITPM.Pages.projects
{
    public class UploadDocument : ContentPage
    {
        List<dynamic> streams;
        dynamic t;
        Label completed = new Label();
        public UploadDocument(List<dynamic> listOfImage, dynamic report)
        {
            streams = listOfImage;
            t = report;

            var x = Task.Run(async () => await start());
            x.ContinueWith(async task => await Uploading());
        }

        async Task start()
        {
            await Task.Run(delegate () {
                Content = new StackLayout
                {
                    Padding = 20,
                    VerticalOptions = LayoutOptions.Center,
                    HorizontalOptions = LayoutOptions.Center,
                    Children =
                    {
                        new Label
                        {
                            Text = "Upload Progress",
                            FontAttributes = FontAttributes.Bold,
                            FontSize = 18
                        },
                        new Label
                        {
                            Text = "Please do not close this page untill uploading progress completed."
                        },
                        new ActivityIndicator
                        {
                            IsRunning = true
                        },
                        new Label
                        {
                            Text = "Uploading " + streams.Count.ToString() + @" image(s)."
                        },
                        completed
                    }
                };
            });
        }

        async Task Uploading()
        {
            await Task.Run(delegate () {
                int number = 0;
                foreach (dynamic x in streams)
                {
                    int xnum = number;

                    if (File.Exists(Convert.ToString(x.path)))
                    {
                        byte[] file = File.ReadAllBytes(Convert.ToString(x.path));

                        WebClient wb = new WebClient();

                        wb.UploadData(Config.APIServer + @"report_doc/" + F.Encode64(Convert.ToString(x.file)) + @"/" + Convert.ToString(t.r_key) + @"/&access_key=" + Config.ACCESS_KEY,
                            file
                        );

                        //completed.Text = m;
                    }
                    else
                    {
                        Device.BeginInvokeOnMainThread(delegate ()
                        {
                            DisplayAlert("Error!", "File not found.", "Ok");
                            Navigation.PopModalAsync();
                        });
                    }

                    if ((xnum + 1) == streams.Count)
                    {
                        Device.BeginInvokeOnMainThread(delegate ()
                        {
                            DisplayAlert("Finish", "All file(s) has been uploaded.", "Ok");
                            AddClaim.listImage.Children.Clear();
                            Navigation.PopModalAsync();
                        });
                    }

                    number++;
                }
            });
        }
    }
}