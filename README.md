# proiect-web-php
# README - Proiect PHP pentru Gestionarea Task-urilor

## Descriere generală a proiectului
Acest proiect reprezintă o aplicație web construită în PHP care permite utilizatorilor să gestioneze task-urile personale. Fiecare utilizator are posibilitatea de a se autentifica, de a adăuga, vizualiza și șterge task-uri asociate contului său. Aplicația include un sistem de protecție care blochează utilizatorii după trei autentificări eșuate timp de cinci minute.

## Funcționalități principale
- **Autentificare utilizatori**: Permite utilizatorilor să se logheze cu un nume de utilizator și o parolă.
- **Gestionarea task-urilor**:
  - Adăugarea unui task nou.
  - Vizualizarea task-urilor existente.
  - Ștergerea unui task.
- **Sistem de protecție la login**:
  - Blocarea autentificării pentru 5 minute după trei încercări eșuate.
  
## Instrucțiuni pentru instalare, configurare și utilizare

### Cerințe
- Server web local (cum ar fi XAMPP sau WAMP).
- PHP versiunea 7.4 sau mai nouă.
- MySQL pentru gestionarea bazei de date.
- Browser modern pentru testare.

### Instalare
1. Clonează repository-ul GitHub:
   ```bash
   git clone [link-repository]
   ```
2. Importă baza de date:
   - Deschide phpMyAdmin și creează o bază de date numită `task_manager`.
   - Importă fișierul `database.sql` care conține structura și datele de test.

3. Configurare conexiune baze de date:
   - Deschide fișierul `connection.php` și actualizează următoarele variabile pentru a se potrivi configurării tale locale:
     ```php
     $dbhost = "localhost";
     $dbuser = "root";
     $dbpass = "";
     $dbname = "task_manager";
     ```

### Utilizare
1. Accesează aplicația în browser la adresa:
   ```
   http://localhost/task_manager
   ```
2. Creează un cont nou sau autentifică-te cu un cont existent.
3. Gestionează task-urile utilizând funcționalitățile disponibile: adăugare, vizualizare și ștergere.

## Exemple de utilizare a funcționalităților
### Autentificare
- Introdu un nume de utilizator și o parolă validă pentru a accesa aplicația.
- În cazul în care greșești parola de trei ori consecutiv, vei fi blocat timp de 5 minute.

### Gestionarea task-urilor
- Adăugare: Completează numele task-ului în formularul dedicat și apasă pe butonul "Add Task".
- Vizualizare: Lista task-urilor este afișată pe pagina principală după autentificare.
- Ștergere: Apasă pe butonul "Delete" de lângă task-ul dorit pentru a-l elimina.

## Tehnologii utilizate
- **Back-end**: PHP pentru logica aplicației și MySQL pentru baza de date.
- **Front-end**: HTML, CSS pentru interfața utilizatorului.
- **Securitate**:
  - Mecanism de blocare pentru autentificări eșuate.
  - Utilizarea variabilelor pregătite pentru prevenirea SQL Injection (se poate extinde).

## Alte informații relevante
- Structura tabelelor bazei de date:
  1. **users**:
     - `user_id` (INT, PRIMARY KEY, AUTO_INCREMENT): ID unic pentru utilizator.
     - `user_name` (VARCHAR(255)): Numele de utilizator.
     - `password` (VARCHAR(255)): Parola utilizatorului.
  2. **tasks**:
     - `task_id` (INT, PRIMARY KEY, AUTO_INCREMENT): ID unic pentru task.
     - `user_id` (INT, FOREIGN KEY): ID-ul utilizatorului asociat.
     - `task_name` (VARCHAR(255)): Descrierea task-ului.
  3. **login_attempts** (pentru protecția la login):
     - `attempt_id` (INT, PRIMARY KEY, AUTO_INCREMENT): ID unic pentru încercare.
     - `user_name` (VARCHAR(255)): Numele utilizatorului.
     - `attempt_time` (TIMESTAMP): Timpul la care s-a realizat încercarea.
     - `is_blocked` (TINYINT): Indică dacă utilizatorul este blocat (1 pentru blocat).
     - `block_until` (TIMESTAMP): Timpul până la deblocare.

Pentru detalii suplimentare sau extinderea funcționalităților, consultați documentația completă din repository-ul GitHub.

