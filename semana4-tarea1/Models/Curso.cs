using System.ComponentModel.DataAnnotations;
using System.ComponentModel.DataAnnotations.Schema;
namespace SistemaCursosIA.Models;
public class Curso
{
    public int Id { get; set; }
    [Required, StringLength(100)]
    public string Nombre { get; set; } = string.Empty;
    [Required, StringLength(70)]
    [Display(Name = "Nivel del curso")]
    public string Nivel { get; set; } = string.Empty;
    [Range(1, 100, ErrorMessage = "Los cupos deben estar entre 1 y 100.")]
    public int Cupos { get; set; }
    [Display(Name = "Instructor")]
    public int InstructorId { get; set; }
    [ForeignKey(nameof(InstructorId))]
    public Instructor? Instructor { get; set; }
    public ICollection<Inscripcion> Inscripciones { get; set; } = new List<Inscripcion>();
}
