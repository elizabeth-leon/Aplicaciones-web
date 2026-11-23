using System.ComponentModel.DataAnnotations;
namespace SistemaCursosIA.Models;
public class Estudiante
{
    public int Id { get; set; }
    [Required(ErrorMessage = "Escribe el nombre.")]
    [StringLength(80)]
    public string Nombre { get; set; } = string.Empty;
    [Required(ErrorMessage = "Escribe el apellido.")]
    [StringLength(80)]
    public string Apellido { get; set; } = string.Empty;
    [Required, EmailAddress, StringLength(120)]
    public string Correo { get; set; } = string.Empty;
    [StringLength(20)]
    public string? Telefono { get; set; }
    // Propiedad de navegación: no es un campo adicional de la tabla.
    public ICollection<Inscripcion> Inscripciones { get; set; } = new List<Inscripcion>();
}
