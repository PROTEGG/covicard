 <head>
    <meta http-equiv="cache-control" content="no-cache">
    <meta charset="utf-8">
 </head>

<style>
#schrift {
font-family: Arial;
font-size: 12px
}
#schrift2 {
font-family: Arial;
font-size: 30px
}
#schrift3 {
font-family: Arial;
font-size: 15px
}

#infoblock{
    border: 2px solid black;
  border-radius: 8px;
}
</style>



<h1 id="schrift2" >DATENSCHUTZ</h1><br><br>

<p id="schrift">


<b>ULTRAKURZINFORMATION</b><br><br>
<table id="schrift">
    
<tr><td valign=top>
WAS WIRD GESPEICHERT?</td>
<td> 
<ul type=“circle“ style="padding-left: 40px; "style="margin-bottom: 40px;">
<li>Vorname</li>
<li>Familienname</li>
<li>E-Mail-Adresse</li>
<li>Datum</li>
<li>Zeit "Kommt"</li>
<li>Zeit "Geht"</li>
<li>Platznummer (wenn zutreffend)</li>
<li>negativ getestet (wenn Test erforderlich)</li>
<li>Termin vereinbart (wenn "Click & Meet") </li>
<li>eingelassen/nicht eingelassen</li>
</ul>
</td></tr>

<tr><td valign=top>
WER SPEICHERT?</td><td><ul type=“circle“ style="padding-left: 40px; "style="margin-bottom: 40px;">
<li>

<?php
 
  $Name             = filter_input(INPUT_GET, 'Name', FILTER_SANITIZE_SPECIAL_CHARS); 
  $Rechtsform       = filter_input(INPUT_GET, 'Rechtsform', FILTER_SANITIZE_SPECIAL_CHARS); 
  $Adresse          = filter_input(INPUT_GET, 'Adresse', FILTER_SANITIZE_SPECIAL_CHARS);
  $Nummer           = filter_input(INPUT_GET, 'Nummer', FILTER_SANITIZE_SPECIAL_CHARS);
  $Mail             = filter_input(INPUT_GET, 'Mail', FILTER_SANITIZE_SPECIAL_CHARS);
  $Vertreter        = filter_input(INPUT_GET, 'Vertreter', FILTER_SANITIZE_SPECIAL_CHARS);
  $DsBeauf          = filter_input(INPUT_GET, 'DSBEauf', FILTER_SANITIZE_SPECIAL_CHARS);
 
  echo $Name." ".$Rechtsform.", vertreten durch ".$Vertreter.", Telefon ".$Nummer.", e-Mail ".$Mail;
  ?>

 </li></ul></td></tr>
 
 <tr><td valign=top>

SPEICHERDAUER?</td><td> <ul type=“circle“ style="padding-left: 40px; "style="margin-bottom: 40px;">
<li>ein (1) Monat, automatische Löschung</li></ul><br><br></td></tr></table>



<b>KURZINFORMATION</b><br><br>



<ul id="schrift" type=“circle“ style="padding-left: 40px; "style="margin-bottom: 40px;">
<li>Sie sehen auf Ihrer Covicard einen Würfel, der schwarz-weiß gescheckt ist. Das ist ein QR-Code. Er funktioniert i.E. wie ein Barcode, den Sie vom Supermarkt her kennen. </li>
<li> Wenn Sie einen QR-Code lesen könnten, stünde dort:<br><br>
Teil 1: Bernd Teil 2: t4biOtHQj9xwLSSpv8Eprt8yp5l3OSmnM8hfV9GgTE= Teil 3: jJJklPsjgjf85TZHPddvf. <br><br>Teil 1 ist Ihr Vorname - unverschlüsselt. Teil 2 und Teil 3 sind wieder ein Code. </li><li> Die Codes wurden mit dem Verschlüsselungsalgorithmus AES-128-cbc erstellt - das ist so etwas wie eine supermoderne Enigma. Wer die beiden über 10-stelligen Schlüssel kapert, kann den Code knacken. Alle anderen pragmatisch nicht. Es ist deutlich einfacher, die Schlüssel zu kapern, als den Code zu knacken. </li>
<li>Der Entwickler hat sich viel Mühe gegeben, die Schlüssel sicher wegzuschließen. Aber was ist schon sicher. Das System verfolgt deswegen einen weiteren Ansatz. Statt alle Daten zentral zu speichern, werden Ihre Daten nur im jeweiligen Lokal oder Geschäft, also hier bei uns gespeichert. Gut, dann weiß der Angreifer, dass Sie bei uns waren und kann Ihnen eine E-Mail schreiben. Das, was für einen Angreifer die Speicherung an einem Ort interessant macht, funktioniert bei unserer dezentralen Speicherung aber nicht: Bewegungsprofil ("Wo war er/sie denn die letzten Tage?") oder Sozialprofil ("Mit wem hat er/sie sich denn getroffen?") lassen sich bei einer dezentralen Speicherung nicht anfertigen. Wenn ein Angreifer diese Fragen beantwortet haben wollen würde, müsste er die Handys aller Restaurants, Kneipen, Läden und Behörden hacken, die es in Ihrem Kietz gibt. Und auch dies würde nur zum Ziel führen, wenn alle unser System nutzen würden. Dies ist - wie Sie aus der Presse wissen - nicht der Fall. Es gibt viele andere tolle Systeme. </li>
<li>Teil 2 würde entschlüsselt etwa so lauten: Bernd Mayer info@covicard.de</li>
<li>Teil 3 würde entschlüsselt etwa so lauten: <br><br> t hdhfkdhfjhhf dhdjfjdksddh<br><br> lies: "Covicard mit Testzertifikat" (=t). Ihr Name, als "Einbahnstraßen-Code" (= hdhfkdhfjhhf); ein "Einbahnstraßen-Code" (Hash) wird mit einem Algorithmus erstellt, der immer denselben Code auswirft, wenn man einen bestimmten Namen eingibt, er funktioniert aber nicht rückwärts, wenn man also den Code eingibt, gibt es nicht wieder Ihren Name. Was macht das für einen Sinn? Damit alle, die unser System nutzen, herausfinden können, ob Sie einen negativen Test haben, muss diese Information auch für alle zugänglich sein. Auf der anderen Seite soll niemand ohne Ihre Covicard wissen, dass Sie negativ getestet worden sind. Was liegt näher, diese Information nicht unter Ihrem Namen zu speichern? Da es vermutlich einige gibt, die Ihren Namen kennen, gibt es noch zwei Sicherungen. Da ist zunächst noch ein individuelles Passwort (=dhdjfjdksddh, "Token") und Hash und Token (hdhfkdhfjhhf + dhdjfjdksddh) sind nochmals AES-128-cbc verschlüsselt.        </li>Wenn wir die Karte mit einem Handy scannen, wird der QR-Code gelesen und so wie er isr in einer Datenbank (SQLite) auf unserem Handy gespeichert. Damit wir kontrollieren können, ob Ihre Angaben plausibel sind, wird der erste Code (der ent für wenige Sekunden entschlüsselt und Ihre Kontaktinformationen werden in diesem Zeitraum als Klartext auf dem Display des Handys angezeigt. </li>

<li> Wir haben keine Möglichkeit, die Daten vollständig zu entschlüsseln. Wir können zur Kontrolle alle gespeicherten Daten ansehen, dort wird aber nur ihr Vorname entschlüsselt angezeigt, die restlichen Kontaktinformationen, die Sie uns gegeben haben, bleiben verschlüsselt. Erst die Behörde hat die Möglichkeit, Ihre Kontaktinformationen unverschlüsselt auszulesen. </li>
<li> Ihre Daten werden jedenfalls bis zum Infektionsfall nicht mit anderen Daten zusammengeführt. Auf unserem Handy sind nur und ausschließlich die Daten unserer eigenen Gäste gespeichert. </li>
<li>Ihren Daten werden selbsttätig nach einem (1) Monat automatisch gelöscht. </li></ul>
</p><p id="schrift">
<br><br>
<b>AUSFÜHRLICHE INFORMATION</b><br><br>

<b>1. Name und Kontaktdaten des für die Verarbeitung Verantwortlichen und des Betrieblichen Datenschutzbeauftragten</b><br><br> 

Verantwortlich für die Verarbeitung von Daten über diese Webseite sind wir: <br><br>
<?php
 
  echo $Name." ".$Rechtsform.", vertreten durch ".$Vertreter.", Telefon ".$Nummer.", e-Mail ".$Mail;
  ?>
<br><br>

Betrieblicher Datenschutzbeauftragter ist (falls bestellt): <?php echo $DsBeauf; ?> <br><br>   

Diese Datenschutz-Information gilt für die Datenverarbeitung durch uns.<br><br>

<b>2. Erhebung und Speicherung personenbezogener Daten sowie Art und Zweck von deren Verwendung</b><br><br>

Zweck: Kontaktpersonenermittlung im Fall einer festgestellten Infektion mit SARS-Cov-2;  gegebenfalls fertigen wir eine Sicherungskopie ("Backup") auf einem weiteren Speichermedium. Es findet darüber hinaus keine weitere Verarbeitung statt, v.a. benutzen wir Ihre Daten nicht für Werbung. <br><br>

Es gibt drei Rechtsgrundlagen für die Verarbeitung Ihrer Daten.  Da ist zunächst Art. 6 Abs. 1 Buchst. d DSGVO, der die Verarbeitung erlaubt zum Schutz lebenswichtiger Interessen der betroffenen Person oder einer anderen natürlichen Person. Hierzu zählt nach der Auffassung des Bayerischen Landesamts für Datenschutzaufsicht auch die Verarbeitung personenbezogener Daten zur Überwachung von Epidemien und deren Ausbreitung. <br><br>

Weitere Rechtsgrundlage der Datenverarbeitung ist § 2 12. BayIfSMV (Bayern). Diese Bestimmung fordert uns zur Erhebung und Verarbeitung Ihrer Daten auf. <br><br>

Ihren Vornamen benutzen wir gemäß Art. 6 f DS-GVO, weil Ihre Interessen insoweit unsere Interessen nicht überwiegen. Die Idee des von uns benutzten Systems ist es, bis zum Infektionsfall Ihre Anonymität sicherzustellen. Das schließt es aus, dass wir die Datenbank selbst einsehen und einsehen können. Wir haben auf der anderen Seite aber sicherzustellen, dass die Datenbank läuft und die Kontaktdaten sicher aufgezeichnet werden. Das lässt sich anhand einer Liste mit den Vornamen unserer Gäste  erledigen. Einen Rückschluss auf Ihre Person lässt diese Methode nicht zu. <br><br>

Zu den genannten Zwecken, übermitteln Sie uns Ihren Vornamen, Familiennamen und Ihre Telefonnummer oder E-Mail-Adresse, sowie die anderen Daten, wenn Sie von der zuständigen Behörde angefordert worden sind.  <br><br>

<b>3. Weitergabe von Daten und Empfänger von Daten</b><br><br>

Die erhobenen Daten sind den zuständigen Gesundheitsbehörden auf deren Verlangen hin zu übermitteln, soweit dies zur Kontaktpersonenermittlung im Falle einer festgestellten Infektion mit dem Coronavirus SARS-CoV-2 erforderlich ist. Eine anderweitige Verwendung der Daten ist unzulässig. Die Befugnisse der Strafverfolgungsbehörden bleiben unberührt. Wir verwenden Ihre Daten insbesondere nicht für Werbung.<br><br>
<b>4. Betroffenenrechte</b><br><br>

Sie haben das Recht: <br><br>
<ul id="schrift" type=“circle“ style="padding-left: 40px; "style="margin-bottom: 40px;">

<li>gemäß Art. 15 DS-GVO Auskunft über Ihre von uns verarbeiteten personenbezogenen Daten zu verlangen. Insbesondere können Sie Auskunft über die Verarbeitungszwecke, die Kategorie der personenbezogenen Daten, die Kategorien von Empfängern, gegenüber denen Ihre Daten offengelegt wurden oder werden, die geplante Speicherdauer, das Bestehen eines Rechts auf Berichtigung, Löschung, Einschränkung der Verarbeitung oder Widerspruch, das Bestehen eines Beschwerderechts, die Herkunft ihrer Daten, sofern diese nicht bei uns erhoben wurden, sowie über das Bestehen einer automatisierten Entscheidungsfindung einschließlich Profiling und ggf. aussagekräftigen Informationen zu deren Einzelheiten verlangen; </li>
<li>gemäß Art. 16 DS-GVO unverzüglich die Berichtigung unrichtiger oder Vervollständigung Ihrer bei uns gespeicherten personenbezogenen Daten zu verlangen; </li>
<li>gemäß Art. 17 DS-GVO die Löschung Ihrer bei uns gespeicherten personenbezogenen Daten zu verlangen, soweit nicht die Verarbeitung zur Ausübung des Rechts auf freie Meinungsäußerung und Information, zur Erfüllung einer rechtlichen Verpflichtung, aus Gründen des öffentlichen Interesses oder zur Geltendmachung, Ausübung oder Verteidigung von Rechtsansprüchen erforderlich ist; </li>
<li>gemäß Art. 18 DS-GVO die Einschränkung der Verarbeitung Ihrer personenbezogenen Daten zu verlangen, soweit die Richtigkeit der Daten von Ihnen bestritten wird, die Verarbeitung unrechtmäßig ist, Sie aber deren Löschung ablehnen und wir die Daten nicht mehr benötigen, Sie jedoch diese zur Geltendmachung, Ausübung oder Verteidigung von Rechtsansprüchen benötigen oder Sie gemäß Art. 21 DS-GVO Widerspruch gegen die Verarbeitung eingelegt haben; </li>
<li>gemäß Art. 20 DS-GVO Ihre personenbezogenen Daten, die Sie uns bereitgestellt haben, in einem strukturierten, gängigen und maschinenlesebaren Format zu erhalten oder die Übermittlung an einen anderen Verantwortlichen zu verlangen; </li><li>gemäß Art. 7 Abs. 3 DS-GVO Ihre einmal erteilte Einwilligung jederzeit gegenüber uns zu widerrufen. Dies hat zur Folge, dass wir die Datenverarbeitung, die auf dieser Einwilligung beruhte, für die Zukunft nicht mehr fortführen dürfen und </li>
<li>gemäß Art. 77 DS-GVO sich bei einer Aufsichtsbehörde zu beschweren. In der Regel können Sie sich hierfür an die Aufsichtsbehörde Ihres üblichen Aufenthaltsortes oder Arbeitsplatzes oder meines Sitzes wenden. Die für Bayern zuständige Aufsichtsbehörde ist das Bayerisches Landesamt für Datenschutzaufsicht, Promenade 18, 91522 Ansbach oder Postfach 1349, 91504 Ansbach; Telefon: 0981 180093-0; Telefax 0981 180093-800; < href="https://www.lda.bayern.de/de/beschwerde.html">https://www.lda.bayern.de/de/beschwerde.html</a> ). </li>
<li>Ihre Rechte auf Löschung und Einschränkung können Sie erst nach Ablauf der Speicherfrist von 1 Monat geltend machen.</li></ul>
</p><p id="schrift">
<b>5. Widerspruchsrecht</b><br><br>

Sofern Ihre personenbezogenen Daten auf Grundlage von berechtigten Interessen gemäß Art. 6 Abs. 1 S. 1 lit. f DS-GVO verarbeitet werden, haben Sie das Recht, gemäß Art. 21 DS-GVO Widerspruch gegen die Verarbeitung Ihrer personenbezogenen Daten einzulegen, soweit dafür Gründe vorliegen, die sich aus Ihrer besonderen Situation ergeben oder sich der Widerspruch gegen Direktwerbung richtet. Im letzteren Fall haben Sie ein generelles Widerspruchsrecht, das ohne Angabe einer besonderen Situation von uns umgesetzt wird. <br><br>

Möchten Sie von Ihrem Widerrufs- oder Widerspruchsrecht Gebrauch machen, genügt eine E-Mail an uns (<?php

 
  echo $Mail;
  ?>. <br><br>


Bleiben Sie gesund! <br><br><b>
Ihr<br><br> <?php
 

 
  echo $Name
  ?></b>
</ p>