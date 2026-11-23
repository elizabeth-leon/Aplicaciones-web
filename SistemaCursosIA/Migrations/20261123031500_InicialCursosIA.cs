using Microsoft.EntityFrameworkCore.Migrations;
using MySql.EntityFrameworkCore.Metadata;

#nullable disable

namespace SistemaCursosIA.Migrations;

/// <summary>Esquema inicial: cuatro entidades de cinco campos, con claves foráneas.</summary>
public partial class InicialCursosIA : Migration
{
    protected override void Up(MigrationBuilder migrationBuilder)
    {
        migrationBuilder.AlterDatabase().Annotation("MySQL:Charset", "utf8mb4");

        migrationBuilder.CreateTable(
            name: "Estudiantes",
            columns: table => new
            {
                Id = table.Column<int>(type: "int", nullable: false)
                    .Annotation("MySQL:ValueGenerationStrategy", MySQLValueGenerationStrategy.IdentityColumn),
                Nombre = table.Column<string>(type: "varchar(80)", maxLength: 80, nullable: false),
                Apellido = table.Column<string>(type: "varchar(80)", maxLength: 80, nullable: false),
                Correo = table.Column<string>(type: "varchar(120)", maxLength: 120, nullable: false),
                Telefono = table.Column<string>(type: "varchar(20)", maxLength: 20, nullable: true)
            },
            constraints: table => table.PrimaryKey("PK_Estudiantes", x => x.Id))
            .Annotation("MySQL:Charset", "utf8mb4");

        migrationBuilder.CreateTable(
            name: "Instructores",
            columns: table => new
            {
                Id = table.Column<int>(type: "int", nullable: false)
                    .Annotation("MySQL:ValueGenerationStrategy", MySQLValueGenerationStrategy.IdentityColumn),
                Nombre = table.Column<string>(type: "varchar(80)", maxLength: 80, nullable: false),
                Apellido = table.Column<string>(type: "varchar(80)", maxLength: 80, nullable: false),
                Especialidad = table.Column<string>(type: "varchar(90)", maxLength: 90, nullable: false),
                Correo = table.Column<string>(type: "varchar(120)", maxLength: 120, nullable: false)
            },
            constraints: table => table.PrimaryKey("PK_Instructores", x => x.Id))
            .Annotation("MySQL:Charset", "utf8mb4");

        migrationBuilder.CreateTable(
            name: "Cursos",
            columns: table => new
            {
                Id = table.Column<int>(type: "int", nullable: false)
                    .Annotation("MySQL:ValueGenerationStrategy", MySQLValueGenerationStrategy.IdentityColumn),
                Nombre = table.Column<string>(type: "varchar(100)", maxLength: 100, nullable: false),
                Nivel = table.Column<string>(type: "varchar(70)", maxLength: 70, nullable: false),
                Cupos = table.Column<int>(type: "int", nullable: false),
                InstructorId = table.Column<int>(type: "int", nullable: false)
            },
            constraints: table =>
            {
                table.PrimaryKey("PK_Cursos", x => x.Id);
                table.ForeignKey(
                    name: "FK_Cursos_Instructores_InstructorId",
                    column: x => x.InstructorId,
                    principalTable: "Instructores",
                    principalColumn: "Id",
                    onDelete: ReferentialAction.Restrict);
            })
            .Annotation("MySQL:Charset", "utf8mb4");

        migrationBuilder.CreateTable(
            name: "Inscripciones",
            columns: table => new
            {
                Id = table.Column<int>(type: "int", nullable: false)
                    .Annotation("MySQL:ValueGenerationStrategy", MySQLValueGenerationStrategy.IdentityColumn),
                EstudianteId = table.Column<int>(type: "int", nullable: false),
                CursoId = table.Column<int>(type: "int", nullable: false),
                FechaInscripcion = table.Column<DateTime>(type: "datetime(6)", nullable: false),
                Estado = table.Column<string>(type: "varchar(20)", maxLength: 20, nullable: false)
            },
            constraints: table =>
            {
                table.PrimaryKey("PK_Inscripciones", x => x.Id);
                table.ForeignKey(
                    name: "FK_Inscripciones_Estudiantes_EstudianteId",
                    column: x => x.EstudianteId,
                    principalTable: "Estudiantes",
                    principalColumn: "Id",
                    onDelete: ReferentialAction.Restrict);
                table.ForeignKey(
                    name: "FK_Inscripciones_Cursos_CursoId",
                    column: x => x.CursoId,
                    principalTable: "Cursos",
                    principalColumn: "Id",
                    onDelete: ReferentialAction.Restrict);
            })
            .Annotation("MySQL:Charset", "utf8mb4");

        migrationBuilder.CreateIndex("IX_Cursos_InstructorId", "Cursos", "InstructorId");
        migrationBuilder.CreateIndex("IX_Inscripciones_CursoId", "Inscripciones", "CursoId");
        migrationBuilder.CreateIndex(
            name: "IX_Inscripciones_EstudianteId_CursoId",
            table: "Inscripciones",
            columns: new[] { "EstudianteId", "CursoId" },
            unique: true);
    }

    protected override void Down(MigrationBuilder migrationBuilder)
    {
        migrationBuilder.DropTable("Inscripciones");
        migrationBuilder.DropTable("Cursos");
        migrationBuilder.DropTable("Estudiantes");
        migrationBuilder.DropTable("Instructores");
    }
}
