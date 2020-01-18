using System;
using System.Collections.Generic;
using System.Linq;
using System.Text;

using Xamarin.Forms;

namespace HITPM.Pages.reports
{
    public class EditReports : ContentPage
    {
        public EditReports()
        {

            Title = "Edit Reports";
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
                                    Placeholder = "Report",
                                    Text = "Report 1"
                                },
                                new Entry
                                {
                                    Placeholder = "Report Category"
                                },
                                new Entry
                                {
                                    Placeholder = "Report Project"
                                },
                                new Entry
                                {
                                    Placeholder = "Description"
                                },
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
                                    CornerRadius = 20
                                }
                            }
                        }
                    }
                }
            };
        }
    }
}