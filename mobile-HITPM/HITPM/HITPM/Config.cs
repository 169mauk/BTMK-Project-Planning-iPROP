using System;
using System.Collections.Generic;
using System.IO;
using System.Net;
using System.Security.Cryptography;
using System.Text;

namespace HITPM
{
    public static class Config
    {
        public static string TITLE = "HITPMdemo";
        public static string GOOGLE_MAP_KEY = "AIzaSyD4RF0PwyprKjImVMzTpg2v8-4lg6AnFKo";
        public static string ACCESS_KEY = "855351a3a-80jj1e51nd3";
        //public static string APIServer = "http://192.168.56.1//HIT-Project-Monitoring-V2/sql_api/";
        //public static string WebViewServer = "http://192.168.56.1//HIT-Project-Monitoring-V2/webview/";
        public static string APIServer = "http://210.19.105.177/sql_api/";
        public static string WebViewServer = "http://210.19.105.177/webview/";
        public static string Login = Path.Combine(Environment.GetFolderPath(Environment.SpecialFolder.LocalApplicationData), "txt.flogin");
        public static string LogFile = Path.Combine(Environment.GetFolderPath(Environment.SpecialFolder.LocalApplicationData), "txt.logfile");
    }

    public static class AppService
    {
        public static WebClient wb = new WebClient();
    }

    public static class Session
    {
        public static string user_id = "";
        public static string user_password = "";
        public static string department = "";
        public static string role = "";
        public static string user_login = "";
    }

    public static class F
    {
        public static string Sha256(this string text)
        {
            SHA256 x = SHA256.Create();

            byte[] a = Encoding.UTF8.GetBytes(text);
            byte[] hashByte = x.ComputeHash(a);

            return BitConverter.ToString(hashByte).Replace("-", string.Empty).ToLower();
        }

        public static string Encrypt(this string text)
        {
            string a = text + "5a7347f6fda4a346760af782d2ec126f7b9873ea9a7f2bb1fee9abdfd5f4dfc9";

            return a.Sha256();
        }

        public static string Encode64(string plainText)
        {
            var plainTextBytes = System.Text.Encoding.UTF8.GetBytes(plainText);
            return System.Convert.ToBase64String(plainTextBytes);
        }

        public static string Decode64(string base64EncodedData)
        {
            var base64EncodedBytes = System.Convert.FromBase64String(base64EncodedData);
            return System.Text.Encoding.UTF8.GetString(base64EncodedBytes);
        }
    }
}
