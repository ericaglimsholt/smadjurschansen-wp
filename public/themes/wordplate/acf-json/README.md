# ACF JSON Fields

Den här mappen innehåller JSON-filer för alla Advanced Custom Fields som används i projektet.

## Hur det fungerar

När du skapar eller uppdaterar fält i WordPress admin (Custom Fields), kommer ACF automatiskt att spara en JSON-fil i denna mapp. Detta gör att:

1. **Fälten synkas mellan miljöer** - Samma fält finns på alla installationer
2. **Versionshantering** - Fältändringar kan spåras i Git
3. **Säkerhetskopia** - Fälten är säkrade i koden
4. **Performance** - Snabbare laddning av fält

## Hur man använder

### När du skapar nya fält:
1. Gå till **Custom Fields → Field Groups** i WordPress admin
2. Skapa dina fält som vanligt
3. Spara - JSON-filen skapas automatiskt i denna mapp

### När du arbetar med befintliga fält:
- JSON-filerna laddas automatiskt när WordPress startar
- Om du ändrar fält i admin, uppdateras JSON-filen automatiskt
- Om JSON-filen är nyare än databasen, används JSON-versionen

### För nya utvecklare/miljöer:
1. Kör `git pull` för att få de senaste JSON-filerna
2. Importera fälten via **Custom Fields → Tools → Import Field Groups**
3. Välj JSON-filerna från denna mapp

## Viktigt att komma ihåg

- Committa alltid JSON-filerna till Git när du ändrar fält
- JSON-filerna är källan till sanningen för fältstrukturen
- Ta bort JSON-filer när du tar bort fältgrupper