using System;
using Microsoft.EntityFrameworkCore;
using Microsoft.EntityFrameworkCore.Infrastructure;
using Microsoft.EntityFrameworkCore.Migrations;
using SistemaCursosIA.Data;

#nullable disable

namespace SistemaCursosIA.Migrations;

[DbContext(typeof(CursosIADbContext))]
partial class CursosIADbContextModelSnapshot : ModelSnapshot
{
    protected override void BuildModel(ModelBuilder modelBuilder)
    {
            modelBuilder
                .HasAnnotation("ProductVersion", "10.0.15")
                .HasAnnotation("Relational:MaxIdentifierLength", 64)
                .HasAnnotation("MySQL:Charset", "utf8mb4");

            modelBuilder.Entity("SistemaCursosIA.Models.Estudiante", b =>
                {
                    b.Property<int>("Id")
                        .ValueGeneratedOnAdd()
                        .HasColumnType("int");

                    b.Property<string>("Apellido")
                        .IsRequired()
                        .HasMaxLength(80)
                        .HasColumnType("varchar(80)");

                    b.Property<string>("Correo")
                        .IsRequired()
                        .HasMaxLength(120)
                        .HasColumnType("varchar(120)");

                    b.Property<string>("Nombre")
                        .IsRequired()
                        .HasMaxLength(80)
                        .HasColumnType("varchar(80)");

                    b.Property<string>("Telefono")
                        .HasMaxLength(20)
                        .HasColumnType("varchar(20)");

                    b.HasKey("Id");
                    b.ToTable("Estudiantes");
                });

            modelBuilder.Entity("SistemaCursosIA.Models.Instructor", b =>
                {
                    b.Property<int>("Id")
                        .ValueGeneratedOnAdd()
                        .HasColumnType("int");

                    b.Property<string>("Apellido")
                        .IsRequired()
                        .HasMaxLength(80)
                        .HasColumnType("varchar(80)");

                    b.Property<string>("Correo")
                        .IsRequired()
                        .HasMaxLength(120)
                        .HasColumnType("varchar(120)");

                    b.Property<string>("Especialidad")
                        .IsRequired()
                        .HasMaxLength(90)
                        .HasColumnType("varchar(90)");

                    b.Property<string>("Nombre")
                        .IsRequired()
                        .HasMaxLength(80)
                        .HasColumnType("varchar(80)");

                    b.HasKey("Id");
                    b.ToTable("Instructores");
                });

            modelBuilder.Entity("SistemaCursosIA.Models.Curso", b =>
                {
                    b.Property<int>("Id")
                        .ValueGeneratedOnAdd()
                        .HasColumnType("int");

                    b.Property<int>("Cupos")
                        .HasColumnType("int");

                    b.Property<int>("InstructorId")
                        .HasColumnType("int");

                    b.Property<string>("Nivel")
                        .IsRequired()
                        .HasMaxLength(70)
                        .HasColumnType("varchar(70)");

                    b.Property<string>("Nombre")
                        .IsRequired()
                        .HasMaxLength(100)
                        .HasColumnType("varchar(100)");

                    b.HasKey("Id");
                    b.HasIndex("InstructorId");
                    b.ToTable("Cursos");
                });

            modelBuilder.Entity("SistemaCursosIA.Models.Inscripcion", b =>
                {
                    b.Property<int>("Id")
                        .ValueGeneratedOnAdd()
                        .HasColumnType("int");

                    b.Property<int>("CursoId")
                        .HasColumnType("int");

                    b.Property<string>("Estado")
                        .IsRequired()
                        .HasMaxLength(20)
                        .HasColumnType("varchar(20)");

                    b.Property<int>("EstudianteId")
                        .HasColumnType("int");

                    b.Property<DateTime>("FechaInscripcion")
                        .HasColumnType("datetime(6)");

                    b.HasKey("Id");
                    b.HasIndex("CursoId");
                    b.HasIndex("EstudianteId", "CursoId").IsUnique();
                    b.ToTable("Inscripciones");
                });

            modelBuilder.Entity("SistemaCursosIA.Models.Curso", b =>
                {
                    b.HasOne("SistemaCursosIA.Models.Instructor", "Instructor")
                        .WithMany("Cursos")
                        .HasForeignKey("InstructorId")
                        .OnDelete(DeleteBehavior.Restrict)
                        .IsRequired();
                    b.Navigation("Instructor");
                });

            modelBuilder.Entity("SistemaCursosIA.Models.Inscripcion", b =>
                {
                    b.HasOne("SistemaCursosIA.Models.Curso", "Curso")
                        .WithMany("Inscripciones")
                        .HasForeignKey("CursoId")
                        .OnDelete(DeleteBehavior.Restrict)
                        .IsRequired();
                    b.HasOne("SistemaCursosIA.Models.Estudiante", "Estudiante")
                        .WithMany("Inscripciones")
                        .HasForeignKey("EstudianteId")
                        .OnDelete(DeleteBehavior.Restrict)
                        .IsRequired();
                    b.Navigation("Curso");
                    b.Navigation("Estudiante");
                });

            modelBuilder.Entity("SistemaCursosIA.Models.Curso", b => b.Navigation("Inscripciones"));
            modelBuilder.Entity("SistemaCursosIA.Models.Estudiante", b => b.Navigation("Inscripciones"));
            modelBuilder.Entity("SistemaCursosIA.Models.Instructor", b => b.Navigation("Cursos"));
    }
}
