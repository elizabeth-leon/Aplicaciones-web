using Microsoft.EntityFrameworkCore;
using SistemaCursosIA.Data;

var builder = WebApplication.CreateBuilder(args);
var connectionString = builder.Configuration.GetConnectionString("cn")
    ?? throw new InvalidOperationException("Configura ConnectionStrings:cn mediante User Secrets o appsettings.Development.json.");

builder.Services.AddControllersWithViews();
builder.Services.AddDbContext<CursosIADbContext>(options => options.UseMySQL(connectionString));

var app = builder.Build();
if (!app.Environment.IsDevelopment())
{
    app.UseExceptionHandler("/Home/Error");
    app.UseHsts();
}
app.UseHttpsRedirection();
app.UseStaticFiles();
app.UseRouting();
app.UseAuthorization();
app.MapControllerRoute(name: "default", pattern: "{controller=Home}/{action=Index}/{id?}");
app.Run();
