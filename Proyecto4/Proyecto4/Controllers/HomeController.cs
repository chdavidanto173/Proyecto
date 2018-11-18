using System;
using System.Collections.Generic;
using System.Linq;
using System.Web;
using System.Web.Mvc;

namespace Proyecto4.Controllers
{
    public class HomeController : Controller
    {
        public ActionResult Index()
        {
            return View();
        }

        public ActionResult About()
        {
            ViewBag.Message = "Your application description page.";

            return View();
        }

        public ActionResult Contact()
        {
            ViewBag.Message = "Your contact page.";

            return View();
        }


        private bool prueba()
        {
            // Método que inserta en BBDD.

            return true;

        }


        [HttpPost]
        public JsonResult crearBD()
        {
            if (prueba())
                return Json("'Success':'true'");
            else
                return Json(String.Format("'Success':'false','Error':'Ha habido un error al insertar el registro.'"));
        }

    }
}