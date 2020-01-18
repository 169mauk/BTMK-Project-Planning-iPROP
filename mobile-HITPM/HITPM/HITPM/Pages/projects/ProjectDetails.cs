using System;
using System.Collections.Generic;
using System.Linq;
using System.Text;

using Xamarin.Forms.Maps;
using Xamarin.Forms;
using System.Dynamic;
using Newtonsoft.Json;

namespace HITPM.Pages.projects
{
    public class ProjectDetails : ContentPage
    {
        public ProjectDetails(dynamic project)
        {
            Title = "Project Details";

            Grid duration = new Grid
            {
                Margin = new Thickness(0,0,0,50)
            };
            duration.RowDefinitions.Add(new RowDefinition());
            duration.RowDefinitions.Add(new RowDefinition());
            duration.RowDefinitions.Add(new RowDefinition());
            duration.RowDefinitions.Add(new RowDefinition());
            duration.RowDefinitions.Add(new RowDefinition());
            duration.RowDefinitions.Add(new RowDefinition());

            duration.ColumnDefinitions.Add(new ColumnDefinition());
            duration.ColumnDefinitions.Add(new ColumnDefinition());

            Label start = new Label
            {
                Text = "Start: "
            };
            Grid.SetRow(start, 0);
            Grid.SetColumn(start, 0);

            Label datestart = new Label
            {
                Text = project.p_date.ToString()
            };
            Grid.SetRow(datestart, 0);
            Grid.SetColumn(datestart, 1);

            Label end = new Label
            {
                Text = "End:"
            };
            Grid.SetRow(end, 1);
            Grid.SetColumn(end, 0);

            Label dateend = new Label
            {
                Text = project.p_date.ToString()
            };
            Grid.SetRow(dateend, 1);
            Grid.SetColumn(dateend, 1);

            dynamic rd = new ExpandoObject();
            rd.c_id = project.p_category.ToString();

            string res = AppService.wb.UploadString(Config.APIServer + @"project_categories/getBy/&access_key=" + Config.ACCESS_KEY, JsonConvert.SerializeObject(rd));

            dynamic obj = JsonConvert.DeserializeObject(res);

            string cat = "NONE";

            if(obj != null && obj.Count > 0)
            {
                cat = obj[0].c_name;
            }

            Label category = new Label
            {
                Text = "Category:"
            };
            Grid.SetRow(category, 2);
            Grid.SetColumn(category, 0);

            Label category1 = new Label
            {
                Text = cat
            };
            Grid.SetRow(category1, 2);
            Grid.SetColumn(category1, 1);

            Label tags = new Label
            {
                Text = "Tags:"
            };
            Grid.SetRow(tags, 3);
            Grid.SetColumn(tags, 0);

            Label tag1 = new Label
            {
                Text = "Done"
            };
            Grid.SetRow(tag1, 3);
            Grid.SetColumn(tag1, 1);

            Label client = new Label
            {
                Text = "Client: "
            };
            Grid.SetRow(client, 4);
            Grid.SetColumn(client, 0);

            Label client1 = new Label
            {
                Text = "Hery Intelligent Technology"
            };
            Grid.SetRow(client1, 4);
            Grid.SetColumn(client1, 1);

            Label department = new Label
            {
                Text = "Department:"
            };
            Grid.SetRow(department, 5);
            Grid.SetColumn(department, 0);

            Label department1 = new Label
            {
                Text = "Department A"
            };
            Grid.SetRow(department1, 5);
            Grid.SetColumn(department1, 1);

            Label cost = new Label
            {
                Text = "Cost: "
            };
            Grid.SetRow(cost, 6);
            Grid.SetColumn(cost, 0);

            Label cost1 = new Label
            {
                Text = project.p_cost.ToString() + @" [before VO]"
            };
            Grid.SetRow(cost1, 6);
            Grid.SetColumn(cost1, 1);

            //Label source = new Label
            //{
            //    Text = "Source of Budget:"
            //};
            //Grid.SetRow(source, 7);
            //Grid.SetColumn(source, 0);

            //Label source1 = new Label
            //{
            //    Text = ""
            //};
            //Grid.SetRow(source1, 7);
            //Grid.SetColumn(source1, 1);

            duration.Children.Add(start);
            duration.Children.Add(datestart);
            duration.Children.Add(end);
            duration.Children.Add(dateend);
            duration.Children.Add(category);
            duration.Children.Add(category1);
            duration.Children.Add(tags);
            duration.Children.Add(tag1);
            duration.Children.Add(client);
            duration.Children.Add(client1);
            duration.Children.Add(department);
            duration.Children.Add(department1);
            duration.Children.Add(cost);
            duration.Children.Add(cost1);
            //duration.Children.Add(source);
            //duration.Children.Add(source1);


            var map = new Map();

            map.MoveToRegion(MapSpan.FromCenterAndRadius(new Position(2.92293, 101.765045), Distance.FromMiles(500)));

            var stack = new StackLayout { Spacing = 0 };
            //stack.Margin = new Thickness(10,10,10,10);
            map.MapType = MapType.Street;
            map.Margin = new Thickness(10,5,10,10);
            map.HeightRequest = 400;
            map.WidthRequest = 400;
            stack.Children.Add(map);

            ScrollView scroll = new ScrollView
            {
                Content = new StackLayout
                {
                    Margin = 20,
                        Children = {
                        new StackLayout
                        {
                            Children =
                            {
                                new Label
                                {
                                    Text = Convert.ToString(project.p_name),
                                    FontAttributes = FontAttributes.Bold,
                                    FontSize = 16
                                },
                                stack,
                                duration,

                            }
                        }                        
                    }
                }
            };
            Content = scroll;
        }
    }
}