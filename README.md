# zutrittskontrolle
Ein kleines Softwareprojekt für einen Schwimmverein. Beschreibungen im prodct backlog.

#product backlog
User stories

Vereinsmitglied
Anita Brezlav - Mitglied im Verein. Nutzt das Schwimmbad.

Zutrittskontrolleur
Felix Tao
Die Berechtigten (Vereinsmitglieder oder Kursteilnehmer) besitzen eine Karte mit QR-Code. Der Zutrittskontrolleur scannt mit seinem Smartphone den Code. Wenn kein Smartphone zur Verfügung steht, kann der Code mit einem Scanner, der an ein Notebook angeschlossen ist, gescannt werden. Nach dem Scan wird auf dem Bildschirm ein grün hinterlegtes "Zutritt ok" oder ein rot hinterlegtes "Berechtigung prüfen" angezeigt.
Im Bereich der Kontrolle gibt es keinen oder nur sehr schlechten mobilen Datenempfang. Eine weitere Möglichkeit des Zugriffs auf das Internet steht nicht zur Verfügung.

Use case
Übungsstunde im Schwimmbad. Felix Tao hat Dienst an der Kasse. Er hat auf seinem Smartphone in seinem Browser die Website https://zutrittskontrolle.cpi.koeln aufgerufen. Anita Brezlav kommt zur Kasse und zeigt ihren Ausweis mit QR-Code. Felix scannt den Code mit seinem Smartphone. Sobald der Code erkannt wurde, erscheint für zwei Sekunden ein Wartekringel mit dem Hinweis "prüft...". Danach erhält er auf der Website den in hellgrün hinterlegten Hinweis "OK". Der Hinweis verschwindet nach 10 Sekunden oder wenn der nächste Code gescannt wurde.