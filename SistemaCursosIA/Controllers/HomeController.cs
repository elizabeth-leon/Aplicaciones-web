using Microsoft.AspNetCore.Mvc;
namespace SistemaCursosIA.Controllers;
public class HomeController : Controller
{
    public IActionResult Index() => View();
    public IActionResult Error() => View();
}
