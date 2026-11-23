using System.ComponentModel.DataAnnotations;
namespace SistemaCursosIA.Models;
public class Instructor
{
    public int Id { get; set; }
    [Required, StringLength(80)]
    public string Nombre { get; set; } = string.Empty;
    [Required, StringLength(80)]
    public string Apellido { get; set; } = string.Empty;
    [Required, StringLength(90)]
    public string Especialidad { get; set; } = string.Empty;
    [Required, EmailAddress, StringLength(120)]
    public string Correo { get; set; } = string.Empty;
    public ICollection<Curso> Cursos { get; set; } = new List<Curso>();
}
