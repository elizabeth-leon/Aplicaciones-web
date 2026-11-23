using Microsoft.EntityFrameworkCore;
using SistemaCursosIA.Models;

namespace SistemaCursosIA.Data;

public class CursosIADbContext : DbContext
{
    public CursosIADbContext(DbContextOptions<CursosIADbContext> options) : base(options) { }
    public DbSet<Estudiante> Estudiantes => Set<Estudiante>();
    public DbSet<Instructor> Instructores => Set<Instructor>();
    public DbSet<Curso> Cursos => Set<Curso>();
    public DbSet<Inscripcion> Inscripciones => Set<Inscripcion>();

    protected override void OnModelCreating(ModelBuilder modelBuilder)
    {
        base.OnModelCreating(modelBuilder);
        modelBuilder.Entity<Curso>()
            .HasOne(t => t.Instructor)
            .WithMany(i => i.Cursos)
            .HasForeignKey(t => t.InstructorId)
            .OnDelete(DeleteBehavior.Restrict);
        modelBuilder.Entity<Inscripcion>()
            .HasOne(x => x.Estudiante)
            .WithMany(e => e.Inscripciones)
            .HasForeignKey(x => x.EstudianteId)
            .OnDelete(DeleteBehavior.Restrict);
        modelBuilder.Entity<Inscripcion>()
            .HasOne(x => x.Curso)
            .WithMany(t => t.Inscripciones)
            .HasForeignKey(x => x.CursoId)
            .OnDelete(DeleteBehavior.Restrict);
        modelBuilder.Entity<Inscripcion>()
            .HasIndex(x => new { x.EstudianteId, x.CursoId })
            .IsUnique();
    }
}
