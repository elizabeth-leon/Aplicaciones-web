using System.ComponentModel.DataAnnotations;
using System.ComponentModel.DataAnnotations.Schema;
namespace SistemaCursosIA.Models;
public class Inscripcion
{
    public int Id { get; set; }
    [Display(Name = "Estudiante")]
    public int EstudianteId { get; set; }
    [Display(Name = "Curso")]
    public int CursoId { get; set; }
    [DataType(DataType.Date), Display(Name = "Fecha de inscripción")]
    public DateTime FechaInscripcion { get; set; } = DateTime.Today;
    [Required, StringLength(20)]
    public string Estado { get; set; } = "Activa";
    [ForeignKey(nameof(EstudianteId))]
    public Estudiante? Estudiante { get; set; }
    [ForeignKey(nameof(CursoId))]
    public Curso? Curso { get; set; }
}
