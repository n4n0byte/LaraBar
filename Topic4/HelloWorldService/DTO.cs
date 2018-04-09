using System.Collections.Generic;
using System.Runtime.Serialization;
using Topic4.Models;

namespace HelloWorldService
{
    [DataContract]
    public class DTO
    {
        public DTO(int status, string message, List<UserModel> data)
        {
            Status = status;
            Message = message;
            Data = data;
        }

        [DataMember] public int Status { get; set; }
        [DataMember] public string Message { get; set; }
        [DataMember] public List<UserModel> Data { get; set; }
    }
}