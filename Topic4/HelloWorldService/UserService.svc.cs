using System;
using System.Collections.Generic;
using System.Linq;
using System.Runtime.Serialization;
using System.ServiceModel;
using System.ServiceModel.Web;
using System.Text;
using Topic4.Models;

namespace HelloWorldService
{
    // NOTE: You can use the "Rename" command on the "Refactor" menu to change the class name "UserService" in code, svc and config file together.
    // NOTE: In order to launch WCF Test Client for testing this service, please select UserService.svc or UserService.svc.cs at the Solution Explorer and start debugging.
    public class UserService : IUserService
    {
        List<UserModel> users = new List<UserModel>();

        public UserService()
        {
            users.Add(new UserModel("Bob", "Ross"));
            users.Add(new UserModel("Rob", "Hoss"));
            users.Add(new UserModel("Hob", "Toss"));
            users.Add(new UserModel("Tob", "Boss"));
        }

        public DTO GetUser(string value)
        {
            try
            {
                var errorCode = 200;
                var statusMessage = "success";
                List<UserModel> data = new List<UserModel>();
                int pOut;
                if (Int32.TryParse(value, out pOut))
                {
                    if (pOut >= users.Count || users[pOut] == null)
                    {
                        statusMessage = "Item does not exist.";
                        errorCode = 404;
                    }
                    else
                        data.Add(users[pOut]);
                }
                else
                {
                    statusMessage = "Input value not an integer.";
                    errorCode = 400;
                }

                var dto = new DTO(errorCode, statusMessage, data);
                return dto;
            }
            catch (Exception e)
            {
                Console.WriteLine(e);
                throw;
            }
        }


        public DTO GetAllUsers()
        {
            var ok = users.Count > 0;
            var errorCode = ok ? 200 : 404;
            var statusMessage = ok ? "Success." : "Empty";
            var dto = new DTO(errorCode, statusMessage, users);
            return dto;
        }

        public string SayHello()
        {
            return "Hello from my first WFC REST Service!";
        }
    }
}