using Newtonsoft.Json;
using Plugin.FilePicker;
using Plugin.FilePicker.Abstractions;
using Plugin.Media;
using Plugin.Media.Abstractions;
using System;
using System.Collections.Generic;
using System.Diagnostics;
using System.Dynamic;
using System.IO;
using System.Linq;
using System.Text;
using System.Threading.Tasks;
using Xamarin.Forms;

namespace HITPM.Pages.projects
{
    public class AddClaim : ContentPage
    {
        public static StackLayout listImage;
        public AddClaim(dynamic project)
        {
            Title = "+ Add Claim";

            ToolbarItems.Add(new ToolbarItem
            {
                Text = "+ File",
                Command = new Command(async () => await selectFile())
            });

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

            listImage = new StackLayout
            {
                Orientation = StackOrientation.Horizontal,
                Padding = 5
            };

            var scrollImage = new ScrollView
            {
                Orientation = ScrollOrientation.Horizontal,
                Content = listImage
            };

            //Grid addDocButtonGroup = new Grid
            //{
            //    Margin = new Thickness(0, 20, 0, 0),
            //    ColumnDefinitions =
            //    {
            //        new ColumnDefinition
            //        {
            //            Width = new GridLength(5, GridUnitType.Star)
            //        },
            //        new ColumnDefinition
            //        {
            //            Width = new GridLength(5, GridUnitType.Star)
            //        }
            //    },
            //    RowDefinitions =
            //    {
            //        new RowDefinition
            //        {
            //            Height = 40
            //        }
            //    }
            //};

            //addDocButtonGroup.Children.Add(new Button
            //{
            //    Text = "Upload File",
            //    BackgroundColor = Color.FromHex("#0094ab"),
            //    TextColor = Color.White,
            //    Command = new Command(async delegate () {
            //        await CrossMedia.Current.Initialize();

            //        if (!CrossMedia.Current.IsPickPhotoSupported)
            //        {
            //            await DisplayAlert("Error", "Sorry, Image picked is not supported", "Ok");
            //            return;
            //        }

            //        var option = new PickMediaOptions
            //        {
            //            PhotoSize = PhotoSize.Medium
            //        };
            //        var selectImage = await CrossMedia.Current.PickPhotoAsync(option);

            //        listOfImage.Add(selectImage.Path);

            //        RefreshImageList();
            //    })
            //}, 0, 0);

            Content = new StackLayout
            {
                Margin = 20,
                Children = {
                    date,
                    title,
                    description,
                    amount,
                    //addDocButtonGroup,
                    scrollImage,
                    new Button
                    {
                        Text = "Save",
                        BackgroundColor = Color.Green,
                        TextColor = Color.White,
                        Command = new Command(() => {
                            try
                            {
                                dynamic x = new ExpandoObject();
                                x.r_title = title.Text;
                                x.r_claim = amount.Text;
                                x.r_date = date.Date.ToString("dd-MMM-yyyy");
                                x.r_description = description.Text;
                                x.r_project = project.p_id.ToString();
                                x.r_user = Session.user_id;
                                x.r_department = Session.department;

                                string res = AppService.wb.UploadString(Config.APIServer + "add_report/&access_key=" + Config.ACCESS_KEY, JsonConvert.SerializeObject(x));

                                Debug.WriteLine("\n=================================\n");
                                Debug.WriteLine(res);
                                Debug.WriteLine("=====================================");

                                dynamic obj = JsonConvert.DeserializeObject(res);

                                if(Convert.ToString(obj.status) == "success")
                                {
                                    if(listOfImage.Count > 0)
                                    {
                                        Navigation.PushModalAsync(new UploadDocument(listOfImage, obj.data));
                                    }
                                }
                                else
                                {
                                    DisplayAlert("Server error", Convert.ToString(obj.message), "Ok");
                                }
                            }catch(Exception ex)
                            {
                                DisplayAlert("Oops, App Error", ex.Message, "Ok");
                            }
                            

                            title.Text = "";
                            description.Text = "";
                            amount.Text = "";
                            date.Date = DateTime.Now;
                        })
                    }
                }
            };
        }

        async Task selectFile()
        {
            FileData file = await CrossFilePicker.Current.PickFile();

            if(file != null)
            {
                dynamic x = new ExpandoObject();
                x.path = file.FilePath;
                x.file = file.FileName;

                listOfImage.Add(x);

                RefreshImageList();
            }
        }

        List<dynamic> listOfImage = new List<dynamic>();

        void RefreshImageList()
        {
            listImage.Children.Clear();
            int i = 0;
            foreach (dynamic y in listOfImage)
            {
                int yi = i;
                listImage.Children.Add(new Frame
                {
                    WidthRequest = 130,
                    HeightRequest = 200,
                    HasShadow = true,
                    Content = new Label
                    {
                        Text = Convert.ToString(y.file),
                        VerticalOptions = LayoutOptions.Center,
                        HorizontalOptions = LayoutOptions.Center
                    },
                    GestureRecognizers =
                    {
                        new TapGestureRecognizer
                        {
                            Command = new Command(() => Navigation.PushAsync(new ContentPage(){
                                Title = "Review File",
                                ToolbarItems =
                                {
                                    new ToolbarItem
                                    {
                                        Text = "Delete",
                                        Order = ToolbarItemOrder.Primary,
                                        Command = new Command(() => {
                                            listOfImage.RemoveAt(yi);
                                            RefreshImageList();
                                            Navigation.PopAsync();
                                        })
                                    }
                                },
                                Content = new StackLayout
                                {
                                    HorizontalOptions = LayoutOptions.Center,
                                    VerticalOptions = LayoutOptions.Center,
                                    Padding = 20,
                                    Children =
                                    {
                                        new Label
                                        {
                                            Text = "This app not support viewing file. Please click below button fro view from other apps.",
                                            HorizontalTextAlignment = TextAlignment.Center,
                                            Margin = new Thickness(0,0,0,30)
                                        },
                                        new Button
                                        {
                                            Text = "Open File",
                                            BackgroundColor = Color.Blue,
                                            TextColor = Color.White,
                                            Command = new Command(() => {
                                                Device.OpenUri(new Uri(Convert.ToString(y.path)));
                                            })
                                        }
                                    }
                                }
                            }))
                        }
                    }
                });
                i++;
            }
        }
    }
}