using System;
using System.Collections.Generic;
using System.Linq;
using System.Text;

using Xamarin.Forms;

namespace HITPM.Pages.tasks
{
    public class AddTask : ContentPage
    {
        public AddTask()
        {
            Title = "Add Task"; 
            Content = new StackLayout
            {
                Margin = new Thickness(20,20,20,20),
                Children = {
                    new Frame
                    {
                        Content = new StackLayout
                        {
                            Children =
                            {
                                new Entry
                                {
                                    Placeholder = "Add Task"
                                },
                                new Button
                                {
                                    Text = "Add",
                                    BackgroundColor = Color.Red,
                                    Margin = new Thickness(20,40,20,30),
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