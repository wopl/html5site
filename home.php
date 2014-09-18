<!-- ---------------------------------------------------------------------------- -->
<!--                                                                              -->
<!-- home.php                                      (c) Wolfram Plettscher 09/2014 -->
<!--                                                                              -->
<!-- ---------------------------------------------------------------------------- -->

<h1>Startseite Zeiterfassung</h1>
Diese Website dient als "Click-Dummy" zur Evaluierung der Anforderungen an
eine Zeit- und Montage-Fortschrittserfassung. Einige Teile funktionieren bereits - mehr
oder weniger - vollst&aumlndig, sind jedoch keinesfalls
f&uumlr einen Produktiveinsatz geeignet, da essentielle Sicherheitsmerkmale fehlen.

<h2>Aufbau des Bildschirm-Men&uumls:</h2>
<ul>
	<li><b>Home:</b> Diese Startseite dient nur der allgemeinen Information.</li>
    <li><b>Montage:</b> Hier erfolgen alle Eingaben eines Monteurs auf der Baustelle.</li>
    <li><b>Verwaltung:</b> Im B&uumlro werden Benutzer, Auftr&aumlge und Montageschritte verwaltet und gegenseitig zugeordnet.</li>
    <li><b>Auswertungen:</b> Dieser Men&uumlpunkt wurde in diesem Click-Dummy nicht realisiert und wurde
    		nur der Vollst&aumlndigkeit halber aufgenommen.</li>
    <li><b>Logout:</b> Dieser Men&uumlpunkt wurde in diesem Click-Dummy nicht realisiert und wurde
    		nur der Vollst&aumlndigkeit halber aufgenommen.</li>
</ul>

<h2>Einschr&aumlnkungen dieses Click-Dummies:</h2>
<ul>
	<li>kein Login/Logout (und die dazugeh&oumlrige Rechte- und Sessionverwaltung) implementiert.</li>
    <li>alle eingegebenen Daten sind von jedem, der Zugriff auf diesen Server hat, einsehbar.
    	Bitte daher keinesfalls echte oder sensible Daten eintragen.</li>
    <li>Der Monteur wird zuk&uumlnftig nur Zugriff auf seine eigenen Daten haben. In diesem Click-Dummy kann sich
    	der Monteur ("Men&uumlpunkt Montage") auch die Daten seiner Kollegen ansehen.</li>
    <li>Mehrere Benutzergruppen (Kunde und Entwickler) haben gleichzeitig Zugriff auf diesen Click-Dummy und k&oumlnnen sich gegenseitig
    	eingegebene Daten "zerst&oumlren". </li>
    <li>Zu jedem Zeitpunkt k&oumlnnen &Aumlnderungen und Erweiterungen an Bildschirmoberfl&aumlche, Funktion, Inhalt und Datenbankstruktur
    	vorgenommen werden.
    	Dies kann Ver&aumlnderungen und Verlust von vorab eingegebenen Daten verursachen.</li>    
    <li>Reporting (Auswertungen) ist nicht installiert.</li>
    <li>Eingabefelder und URLs k&oumlnnen mittels "cross-site-scripting" manipuliert werden und hierdurch
    	unerw&uumlnschte Ver&aumlnderungen auf dem Server und im Datenbestand verursachen. Die entsprechenden Sicherheitsma&szlignahmen
        wurden in diesen Click-Dummy nicht implementiert. Vermeiden Sie die Verwendung von Anf&uumlhrungszeichen und Klammern.</li>
    <li>Umlaute und Sonderzeichen (z.B. auch in den Men&uumls) werden ggf. nicht korrekt dargestellt.</li>
    <li>Plausibilit&aumltspr&uumlfungen von Eingabefeldern sind nicht implementiert.</li>
    <li>Es erfolgen keinerlei Sicherheitsabfragen zum &Aumlndern und L&oumlschen von Daten.
    	Abh&aumlngige Daten (z.B. Mitarbeiterzuordnungen, erfasste Zeiten je Kunde) werden ohne Nachfrage automatisch mitgel&oumlscht,
        wenn der &uumlbergeordnete Datensatz gel&oumlscht wird.
    <li>Farben und Design dieses Click-Dummies entsprechen nicht dem Zielsystem.</li>
    <li>Auf Grafiken, Logos und Icons wurde bewu&szligt verzichtet.</li>
</ul> 

<br />
Viel Spa&szlig beim Ausprobieren des Click-Dummies!
<br />
Wolfram Plettscher