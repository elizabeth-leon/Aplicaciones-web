using Microsoft.AspNetCore.Mvc;
using Microsoft.AspNetCore.Mvc.Rendering;
using Microsoft.EntityFrameworkCore;
using SistemaCursosIA.Data;
using SistemaCursosIA.Models;

namespace SistemaCursosIA.Controllers;

// Controlador CRUD siguiendo el patrón del scaffolding MVC + Entity Framework.
public class InstructoresController : Controller
{
    private readonly CursosIADbContext _context;
    public InstructoresController(CursosIADbContext context) => _context = context;

    public async Task<IActionResult> Index() => View(await _context.Instructores.ToListAsync());

    public async Task<IActionResult> Details(int? id)
    {
        if (id == null) return NotFound();
        var item = await _context.Instructores.FirstOrDefaultAsync(x => x.Id == id);
        return item == null ? NotFound() : View(item);
    }

    public async Task<IActionResult> Create()
    {

        return View();
    }

    [HttpPost, ValidateAntiForgeryToken]
    public async Task<IActionResult> Create([Bind("Nombre,Apellido,Especialidad,Correo")] Instructor item)
    {


        if (ModelState.IsValid)
        {
            _context.Add(item);
            await _context.SaveChangesAsync();
            return RedirectToAction(nameof(Index));
        }

        return View(item);
    }

    public async Task<IActionResult> Edit(int? id)
    {
        if (id == null) return NotFound();
        var item = await _context.Instructores.FindAsync(id);
        if (item == null) return NotFound();

        return View(item);
    }

    [HttpPost, ValidateAntiForgeryToken]
    public async Task<IActionResult> Edit(int id, [Bind("Id,Nombre,Apellido,Especialidad,Correo")] Instructor item)
    {
        if (id != item.Id) return NotFound();


        if (ModelState.IsValid)
        {
            try { _context.Update(item); await _context.SaveChangesAsync(); }
            catch (DbUpdateConcurrencyException)
            {
                if (!await _context.Instructores.AnyAsync(x => x.Id == item.Id)) return NotFound();
                throw;
            }
            return RedirectToAction(nameof(Index));
        }

        return View(item);
    }

    public async Task<IActionResult> Delete(int? id)
    {
        if (id == null) return NotFound();
        var item = await _context.Instructores.FirstOrDefaultAsync(x => x.Id == id);
        return item == null ? NotFound() : View(item);
    }

    [HttpPost, ActionName("Delete"), ValidateAntiForgeryToken]
    public async Task<IActionResult> DeleteConfirmed(int id)
    {
        var item = await _context.Instructores.FindAsync(id);
        if (item == null) return RedirectToAction(nameof(Index));
        try
        {
            _context.Instructores.Remove(item);
            await _context.SaveChangesAsync();
        }
        catch (DbUpdateException)
        {
            TempData["Error"] = "Este registro está relacionado con otros datos y no se puede eliminar todavía.";
        }
        return RedirectToAction(nameof(Index));
    }


}
