import http.server
import socketserver
import webbrowser
import os

# === CONFIGURACIÓN GENERAL ===
PORT = 8000
# Cambia esta ruta si tu proyecto está en otro lugar
DIRECTORIO_BASE = os.path.abspath("C:/xampp/htdocs/novamarket")  

# Establece el directorio como raíz del servidor
os.chdir(DIRECTORIO_BASE)

# Handler que servirá los archivos (HTML, CSS, JS, imágenes, etc.)
Handler = http.server.SimpleHTTPRequestHandler

# Crea y ejecuta el servidor
with socketserver.TCPServer(("", PORT), Handler) as httpd:
    print(f"🚀 Servidor local corriendo en: http://localhost:{PORT}")
    print(f"📂 Directorio servido: {DIRECTORIO_BASE}")

    # Abre automáticamente tu página principal en el navegador
    inicio_path = os.path.join(DIRECTORIO_BASE, "inicio.html")
    index_path = os.path.join(DIRECTORIO_BASE, "index.html")

    if os.path.exists(inicio_path):
        webbrowser.open(f"http://localhost:{PORT}/inicio.html")
    elif os.path.exists(index_path):
        webbrowser.open(f"http://localhost:{PORT}/index.html")
    else:
        print("⚠️ No se encontró inicio.html ni index.html en el directorio base.")

    # Mantiene el servidor activo
    httpd.serve_forever()
