using System;
using System.Collections.Generic;
using System.Linq;
using System.Text;

using Xamarin.Forms;

namespace HITPM.Pages.VOs
{
    public class ViewVO : ContentPage
    {
        public ViewVO(dynamic vo)
        {
            Title = vo.v_description;
            Content = new StackLayout
            {
                Children = {
                    new Label { Text = "Welcome to Xamarin.Forms!" }
                }
            };
        }
    }
}