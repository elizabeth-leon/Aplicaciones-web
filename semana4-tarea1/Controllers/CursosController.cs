using Microsoft.AspNetCore.Mvc;
using Microsoft.AspNetCore.Mvc.Rendering;
using Microsoft.EntityFrameworkCore;
using SistemaCursosIA.Data;
using SistemaCursosIA.Models;

namespace SistemaCursosIA.Controllers;

// Controlador CRUD siguiendo el patrón del scaffolding MVC + Entity Framework.
public class CursosController : Controller
{
    private readonly CursosIADbContext _context;
    public CursosController(CursosIADbContext context) => _context = context;

    public async Task<IActionResult> Index() => View(await _context.Cursos.Include(x => x.Instructor).ToListAsync());

    public async Task<IActionResult> Details(int? id)
    {
        if (id == null) return NotFound();
        var item = await _context.Cursos.Include(x => x.Instructor).FirstOrDefaultAsync(x => x.Id == id);
        return item == null ? NotFound() : View(item);
    }

    public async Task<IActionResult> Create()
    {
        await FillLists();
        return View();
    }

    [HttpPost, ValidateAntiForgeryToken]
    public async Task<IActionResult> Create([Bind("Nombre,Nivel,Cupos,InstructorId")] Curso item)
    {
        await ValidateCapacity(item);

        if (ModelState.IsValid)
        {
            _context.Add(item);
            await _context.SaveChangesAsync();
            return RedirectToAction(nameof(Index));
        }
        await FillLists(item.InstructorId);
        return View(item);
    }

    public async Task<IActionResult> Edit(int? id)
    {
        if (id == null) return NotFound();
        var item = await _context.Cursos.FindAsync(id);
        if (item == null) return NotFound();
        await FillLists(item.InstructorId);
        return View(item);
    }

    [HttpPost, ValidateAntiForgeryToken]
    public async Task<IActionResult> Edit(int id, [Bind("Id,Nombre,Nivel,Cupos,InstructorId")] Curso item)
    {
        if (id != item.Id) return NotFound();
        await ValidateCapacity(item);

        if (ModelState.IsValid)
        {
            try { _context.Update(item); await _context.SaveChangesAsync(); }
            catch (DbUpdateConcurrencyException)
            {
                if (!await _context.Cursos.AnyAsync(x => x.Id == item.Id)) return NotFound();
                throw;
            }
            return RedirectToAction(nameof(Index));
        }
        await FillLists(item.InstructorId);
        return View(item);
    }

    public async Task<IActionResult> Delete(int? id)
    {
        if (id == null) return NotFound();
        var item = await _context.Cursos.Include(x => x.Instructor).FirstOrDefaultAsync(x => x.Id == id);
        return item == null ? NotFound() : View(item);
    }

    [HttpPost, ActionName("Delete"), ValidateAntiForgeryToken]
    public async Task<IActionResult> DeleteConfirmed(int id)
    {
        var item = await _context.Cursos.FindAsync(id);
        if (item == null) return RedirectToAction(nameof(Index));
        try
        {
            _context.Cursos.Remove(item);
            await _context.SaveChangesAsync();
        }
        catch (DbUpdateException)
        {
            TempData["Error"] = "Este registro está relacionado con otros datos y no se puede eliminar todavía.";
        }
        return RedirectToAction(nameof(Index));
    }

    private async Task FillLists(int? selected = null)
    {
        ViewData["InstructorId"] = new SelectList(
            await _context.Instructores.OrderBy(x => x.Nombre).ThenBy(x => x.Apellido).ToListAsync(),
            "Id", "Nombre", selected);
    }


    private async Task ValidateCapacity(Curso item)
    {
        var active = await _context.Inscripciones.CountAsync(x => x.CursoId == item.Id && x.Estado == "Activa");
        if (item.Id > 0 && item.Cupos < active)
            ModelState.AddModelError(nameof(Curso.Cupos), "Los cupos no pueden ser menores a las inscripciones activas.");
    }

}
