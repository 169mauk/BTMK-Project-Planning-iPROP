using System;
using System.Collections.Generic;
using System.Text;

namespace HITPM
{
    public interface IANotification
    {
        void CreateNotification(string title, string message, string channelId);
    }
}
