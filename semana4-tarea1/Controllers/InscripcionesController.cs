using Microsoft.AspNetCore.Mvc;
using Microsoft.AspNetCore.Mvc.Rendering;
using Microsoft.EntityFrameworkCore;
using SistemaCursosIA.Data;
using SistemaCursosIA.Models;

namespace SistemaCursosIA.Controllers;

// Controlador CRUD siguiendo el patrón del scaffolding MVC + Entity Framework.
public class InscripcionesController : Controller
{
    private readonly CursosIADbContext _context;
    public InscripcionesController(CursosIADbContext context) => _context = context;

    public async Task<IActionResult> Index() => View(await _context.Inscripciones.Include(x => x.Estudiante).Include(x => x.Curso).ToListAsync());

    public async Task<IActionResult> Details(int? id)
    {
        if (id == null) return NotFound();
        var item = await _context.Inscripciones.Include(x => x.Estudiante).Include(x => x.Curso).FirstOrDefaultAsync(x => x.Id == id);
        return item == null ? NotFound() : View(item);
    }

    public async Task<IActionResult> Create()
    {
        await FillLists();
        return View();
    }

    [HttpPost, ValidateAntiForgeryToken]
    public async Task<IActionResult> Create([Bind("EstudianteId,CursoId,FechaInscripcion,Estado")] Inscripcion item)
    {
        await ValidateRegistration(item);

        if (item.Estado != "Activa" && item.Estado != "Cancelada")
            ModelState.AddModelError(nameof(item.Estado), "Selecciona un estado válido.");

        if (ModelState.IsValid)
        {
            _context.Add(item);
            await _context.SaveChangesAsync();
            return RedirectToAction(nameof(Index));
        }
        await FillLists(item.EstudianteId, item.CursoId);
        return View(item);
    }

    public async Task<IActionResult> Edit(int? id)
    {
        if (id == null) return NotFound();
        var item = await _context.Inscripciones.FindAsync(id);
        if (item == null) return NotFound();
        await FillLists(item.EstudianteId, item.CursoId);
        return View(item);
    }

    [HttpPost, ValidateAntiForgeryToken]
    public async Task<IActionResult> Edit(int id, [Bind("Id,EstudianteId,CursoId,FechaInscripcion,Estado")] Inscripcion item)
    {
        if (id != item.Id) return NotFound();
        await ValidateRegistration(item);

        if (item.Estado != "Activa" && item.Estado != "Cancelada")
            ModelState.AddModelError(nameof(item.Estado), "Selecciona un estado válido.");

        if (ModelState.IsValid)
        {
            try { _context.Update(item); await _context.SaveChangesAsync(); }
            catch (DbUpdateConcurrencyException)
            {
                if (!await _context.Inscripciones.AnyAsync(x => x.Id == item.Id)) return NotFound();
                throw;
            }
            return RedirectToAction(nameof(Index));
        }
        await FillLists(item.EstudianteId, item.CursoId);
        return View(item);
    }

    public async Task<IActionResult> Delete(int? id)
    {
        if (id == null) return NotFound();
        var item = await _context.Inscripciones.Include(x => x.Estudiante).Include(x => x.Curso).FirstOrDefaultAsync(x => x.Id == id);
        return item == null ? NotFound() : View(item);
    }

    [HttpPost, ActionName("Delete"), ValidateAntiForgeryToken]
    public async Task<IActionResult> DeleteConfirmed(int id)
    {
        var item = await _context.Inscripciones.FindAsync(id);
        if (item == null) return RedirectToAction(nameof(Index));
        try
        {
            _context.Inscripciones.Remove(item);
            await _context.SaveChangesAsync();
        }
        catch (DbUpdateException)
        {
            TempData["Error"] = "Este registro está relacionado con otros datos y no se puede eliminar todavía.";
        }
        return RedirectToAction(nameof(Index));
    }

    private async Task FillLists(int? selectedStudent = null, int? selectedWorkshop = null)
    {
        ViewData["EstudianteId"] = new SelectList(
            await _context.Estudiantes.OrderBy(x => x.Nombre).ToListAsync(), "Id", "Nombre", selectedStudent);
        ViewData["CursoId"] = new SelectList(
            await _context.Cursos.OrderBy(x => x.Nombre).ToListAsync(), "Id", "Nombre", selectedWorkshop);
    }


    private async Task ValidateRegistration(Inscripcion item)
    {
        var repeated = await _context.Inscripciones.AnyAsync(x =>
            x.EstudianteId == item.EstudianteId && x.CursoId == item.CursoId && x.Id != item.Id);
        if (repeated) ModelState.AddModelError("", "El estudiante ya está inscrito en ese curso.");
        var enrolled = await _context.Inscripciones.CountAsync(x => x.CursoId == item.CursoId && x.Estado == "Activa" && x.Id != item.Id);
        var workshop = await _context.Cursos.FindAsync(item.CursoId);
        if (workshop != null && item.Estado == "Activa" && enrolled >= workshop.Cupos)
            ModelState.AddModelError("", "No quedan cupos disponibles para este curso.");
    }

}
