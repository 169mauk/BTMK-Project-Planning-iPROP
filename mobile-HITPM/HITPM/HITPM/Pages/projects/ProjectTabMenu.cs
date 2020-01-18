using System;
using System.Collections.Generic;
using System.Linq;
using System.Text;

using Xamarin.Forms;

namespace HITPM.Pages.projects
{
    public class ProjectTabMenu : TabbedPage
    {
        public ProjectTabMenu(dynamic project)
        {
            Title = "Manage Project";
            Children.Add(new ProjectDetails(project)
            {
                Title = "Details"
            });
            Children.Add(new Tasks(project)
            {
                Title = "Tasks"
            });
            Children.Add(new EOT(project)
            {
                Title = "EOT"
            });
            Children.Add(new VO(project)
            {
                Title = "VO"
            });
            Children.Add(new Reports(project)
            {
                Title = "Payment"
            });
        }
    }
}