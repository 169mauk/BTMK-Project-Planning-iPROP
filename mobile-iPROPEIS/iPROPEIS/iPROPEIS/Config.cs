using System;
using System.Collections.Generic;
using System.IO;
using System.Text;

namespace iPROPEIS
{
    public static class Config
    {
        //public static string HYBRIDSERVER = "http://192.168.56.1/BTMK-Project-Planning-iPROP/html/eis_hybrid/";
        public static string HYBRIDSERVER = "http://210.19.105.177/eis_hybrid/";
        public static string LOGIN = Path.Combine(Environment.GetFolderPath(Environment.SpecialFolder.LocalApplicationData), "eis.login");
        public static string TITLE = "BTMK - iPROP EIS";
    }
}
