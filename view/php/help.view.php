<?php require('../partials/head.php');
require('../partials/navbar.php'); 
?>
<script src = "../js/faq.js"></script>

<!-- Hier kommt euer View Code hin (Ab Main) -->
<main class="col-sm-9 col-lg-10 mb-5">
    <div class="row justify-content-between">
        <div class="col-7 my-auto help-styling-pretext">
            <h3><b>Hilfe</b></h3>
            <p>
                Um detaillierte Informationen zu erhalten klicken Sie auf die kursiv gestalteten Unterüberschriften.
            </p>
        </div>
        
        <div class="col-3 col-lg-2">
            <img class="float-right" src="../pictures/Logo.png" alt="RetroSpeX Logo" width="90" height="60">
        </div>
        <div class="container-fluid mt-5">
            <!-- Suchfeld, um Nutzer zu filtern -->
            <div class="input-group help-searchbar">
                <input id="user-searchbar" onkeyup="search_faq()" type="search" class="form-control mw-400" placeholder="Geben Sie einen Suchbegriff ein">                                
                <div class="input-group-prepend">
                    <span class="input-group-text"><i class="fa fa-search"></i></span>
                </div>
            </div>
        </div>
        <div class="container-fluid mt-3 help-styling">
            <div class="panel-group" id="accordion1">
                <h5>Allgemeines</h5>
                <p>In diesem Abschnitt werden Grundfunktionalitäten
                    erklärt die sich auf die Reiter “Übersicht”, “Meine Teams”, “Einstellungen”,
                    “Hilfe” und “Logout” des Hauptmenüs beziehen.
                </p>
                <div class="panel panel-default">
                    <div class="panel-heading">
                        <div class="panel-title">
                            <a class="panel-title-color" data-toggle="collapse" data-parent="#accordion1" href="#collapse1">Übersicht</a>
                        </div>
                    </div>
                    <div id="collapse1" class="panel-collapse collapse in">
                        <div class="panel-body">Im Reiter Übersicht des Hauptmenüs finden sie eine
                            grafische Aufbereitung aller Teams mit Namen und Zusammensetzung.
                        </div>
                    </div>
                </div>
                <div class="panel panel-default">
                    <div class="panel-heading">
                        <div class="panel-title">
                            <a class="panel-title-color" data-toggle="collapse" data-parent="#accordion1" href="#collapse2">Meine Teams (Meeting
                                Historie/Aktuelle Meetings/Meeting beitreten)</a>
                        </div>
                    </div>
                    <div id="collapse2" class="panel-collapse collapse in">
                        <div class="panel-body">Alle Teams, in der Sie Mitglied sind, werden in dieser Sicht angezeigt.
                        Sie können durch das Auswählen eines Teams vergangene Retrospektiven betrachten, indem ein abgeschlossenes Meeting angeklickt wird, 
                        öffnen Sie eine Zusammenfassung der Retrospektive. Diese können Sie über einen Klick auf das Druckersymbol oben rechts ausdrucken.
                        Des Weiteren finden Sie eine Übersicht über alle aktuell geplanten Meetings. Dort ermöglicht es Ihnen der Knopf “Meeting beitreten” an 
                        einer Retrospektive zu partizipieren. Weitere Informationen zum Ablauf eines Meetings aus Mitarbeitersicht finden Sie unter “Ablauf einer 
                        Retrospektive”, den Funktionsumfang für Moderatoren unter “Moderation”. 
                        </div>
                    </div>
                </div>
                <div class="panel panel-default">
                    <div class="panel-heading">
                        <div class="panel-title">
                            <a class="panel-title-color" data-toggle="collapse" data-parent="#accordion1" href="#collapse3">Einstellungen (Passwort
                                ändern /Profilbild ändern)</a>
                        </div>
                    </div>
                    <div id="collapse3" class="panel-collapse collapse in">
                        <div class="panel-body">Unter Einstellungen können Sie ihr Passwort ändern. 
                        Geben Sie hierfür zunächst Ihr altes Passwort ein und vergeben dann ein Neues. 
                        Um Tippfehler auszuschließen wird eine erneute Eingabe gefordert. Mit “Bestätigen” schließen Sie den Vorgang ab.
                        </div>
                    </div>
                </div>
                <div class="panel panel-default">
                    <div class="panel-heading">
                        <div class="panel-title">
                            <a class="panel-title-color" data-toggle="collapse" data-parent="#accordion1" href="#collapse4">Hilfe (Ansicht)</a>
                        </div>
                    </div>
                    <div id="collapse4" class="panel-collapse collapse in">
                        <div class="panel-body">Stellt das aktuelle Fenster da.
                        Hier finden Sie Kurzerklärungen zum Tool aufgegliedert nach Funktionsbereichen. 
                        Zudem steht Ihnen eine Suchfunktion zu Verfügung, um Ihnen die Suche zu erleichtern.  
                        </div>
                    </div>
                </div>
                <div class="panel panel-default">
                    <div class="panel-heading">
                        <div class="panel-title">
                            <a class="panel-title-color" data-toggle="collapse" data-parent="#accordion1" href="#collapse5">Logout</a>
                        </div>
                    </div>
                    <div id="collapse5" class="panel-collapse collapse in">
                        <div class="panel-body">Mit einem Klick auf Logout meldet sich der Nutzer ab. Um das Tool wieder
                            nutzen zu können ist eine erneute Anmeldung notwendig.
                        </div>
                    </div>
                </div>
            </div>
            <div class="panel-group" id="accordion2">
                <h5>Verwaltung</h5>
                <p>Administrative Aufgaben wie die Erstellung und Löschung von Nutzern, Vergabe von Globalen Rollen,
                    Erstellung und Deaktivierung von Teams sind Nutzern mit Administratoren Rechten vorbehalten.
                </p>
                <div class="panel panel-default">
                    <div class="panel-heading">
                        <div class="panel-title">
                            <a class="panel-title-color" data-toggle="collapse" data-parent="#accordion2" href="#collapse6">Erstellung eines
                                Nutzers</a>
                        </div>
                    </div>
                    <div id="collapse6" class="panel-collapse collapse in">
                        <div class="panel-body">Um einen neuen Nutzer anzulegen wählen Sie im Hauptmenü unter dem Reiter Nutzer, 
                        Nutzer registrieren aus. In der entsprechenden Sicht geben Sie Vorname, Nachname und E-Mail an. 
                        Außerdem vergeben Sie an den Nutzer eine Globale Rolle, die es ihm entweder erlaubt normaler Mitarbeiter zu sein oder 
                        selbst administrative Aufgaben wahrzunehmen
                        </div>
                    </div>
                </div>
                <div class="panel panel-default">
                    <div class="panel-heading">
                        <div class="panel-title">
                            <a class="panel-title-color" data-toggle="collapse" data-parent="#accordion2" href="#collapse7">Nutzer
                                bearbeiten/löschen</a>
                        </div>
                    </div>
                    <div id="collapse7" class="panel-collapse collapse in">
                        <div class="panel-body">Um bestehende Nutzer zu bearbeiten oder zu löschen wählen Sie im Hauptmenü 
                        den Reiter Nutzer aus und klicken in der sich öffnenden Übersicht den zu bearbeitenden Nutzer an. 
                        Hierbei können die Attribute Vorname, Nachname, E-Mail und Globale Rolle bearbeitet werden. 
                        Um die Änderungen dauerhaft festzuhalten Klicken Sie auf “Bestätigen”. Um ihn zu löschen “Nutzer löschen”. 
                        </div>
                    </div>
                </div>
                <div class="panel panel-default">
                    <div class="panel-heading">
                        <div class="panel-title">
                            <a class="panel-title-color" data-toggle="collapse" data-parent="#accordion2" href="#collapse8">Erstellung eines Teams</a>
                        </div>
                    </div>
                    <div id="collapse8" class="panel-collapse collapse in">
                        <div class="panel-body">Um ein neues Team zu erstellen wählen Sie im Hauptmenü den Reiter “Teams” und wählen “Neues Team hinzufügen aus”. 
                            In dieser Ansicht vergeben Sie dem Team einen Teamnamen und weisen einen Moderator zu. Klicken Sie auf „weiter“, um dem Team Teilnehmer zuzuweisen. 
                            Wählen Sie hierfür einen Teilnehmer aus und drücken Sie auf „Hinzufügen“. 
                            Diesen Vorgang wiederholen Sie, bis alle gewünschten Teilnehmer dem Team zugeteilt sind. 
                        </div>
                    </div>
                </div>
                <div class="panel panel-default">
                    <div class="panel-heading">
                        <div class="panel-title">
                            <a class="panel-title-color" data-toggle="collapse" data-parent="#accordion2" href="#collapse9">Teams
                                bearbeiten/deaktivieren</a>
                        </div>
                    </div>
                    <div id="collapse9" class="panel-collapse collapse in">
                        <div class="panel-body">Um bestehende Teams zu bearbeiten oder zu deaktivieren wählen Sie den Reiter “Teams” aus 
                        und klicken in der sich öffnenden Übersicht das zu bearbeitende Team an. Klicken Sie nun noch in der 
                        grünen Navigationsleiste links den Team-Namen an. In dem Bereich “Team bearbeiten“ können Sie Ihre gewünschten Änderungen vornehmen. 
                        Sie haben hier die Möglichkeit den Team-Namen zu verändern, einen neuen Moderator auszuwählen und das Team zu 
                        deaktivieren. Der Button “Team deaktivieren” führt dazu, dass das Team keine Retrospektiven mehr durchführen 
                        kann - gespeicherte Inhalte bleiben erhalten. Deaktivierte Teams bleiben für Administratoren im Reiter Teams sichtbar. 
                        Falls Sie das gewünschte Team deaktivieren möchten, besteht NICHT mehr die Möglichkeit das Team wieder zu aktivieren.
                        In dem Bereich „Mitarbeiter hinzufügen“ lassen sich über einen Klick auf “+”neue Mitarbeiter bzw. Moderatoren hinzufügen. 
                        Entfernt werden Mitarbeiter in dem Bereich „Mitarbeiter entfernen“. Über die Drop-down Auswahl “Mitarbeiter entfernen” 
                        können Sie nun einen Mitarbeiter auswählen.
                        </div>
                    </div>
                </div>
            </div>
            <div class="panel-group" id="accordion3">
                <h5>Ablauf einer Retrospektive</h5>
                <p>In diesem Unterkapitel wird in chronologischer Reihenfolge aus Sicht eines normalen Mitarbeiters der
                    Ablauf und die Funktionalität einer Retrospektiven erklärt.
                    </br>
                    Um dem Meeting beizutreten, müssen Sie oben rechts, dort wo die geplante Retrospektive steht, auf „beitreten“ klicken
                </p>
                <div class="panel panel-default">
                    <div class="panel-heading">
                        <div class="panel-title">
                            <a class="panel-title-color" data-toggle="collapse" data-parent="#accordion3" href="#collapse10">1. Rahmenbedingungen schaffen</a>
                        </div>
                    </div>
                    <div id="collapse10" class="panel-collapse collapse in">
                        <div class="panel-body">Zuerst werden die Voraussetzungen für eine offene Atmosphäre geschaffen. 
                        Die Teilnehmer sollen sich wohl dabei fühlen, offene Punkte zu diskutieren. Dabei gilt die Annahme, dass jeder 
                        die bestmögliche Arbeit geleistet hat, die er oder sie leisten konnte, und zwar unabhängig davon, 
                        welche offenen Punkte identifiziert werden. Nach Aufforderung des Moderators müssen Sie die nächste Phase 
                        „Informationen sammeln“ einleiten, indem Sie oben rechts auf den Button „nächste Phase“ klicken.
                        </div>
                    </div>
                </div>
                <div class="panel panel-default">
                    <div class="panel-heading">
                        <div class="panel-title">
                            <a class="panel-title-color" data-toggle="collapse" data-parent="#accordion3" href="#collapse11">2. Informationen sammeln</a>
                        </div>
                    </div>
                    <div id="collapse11" class="panel-collapse collapse in">
                        <div class="panel-body">Die Fragen werden zuerst von jedem Teilnehmer selbstständig beantwortet. Wenn Sie rechts oder links 
                        neben den Klebekarten auf die Pfeile drücken, gelangen Sie zu weiteren Klebekarte, in denen Sie die Frage beantworten können. 
                        Durch das Klicken des Buttons unten rechts oder unten links, können Sie zur nächsten oder vorherigen Frage gelangen. 
                        Wenn Sie alle Fragen beantwortet haben, bestätigen Sie Ihre Antworten, indem Sie unten rechts auf den Button bestätigen klicken. 
                        Nach Aufforderung des Moderators müssen Sie die nächste Phase „Erkenntnisse entwickeln“ einleiten, indem Sie oben rechts auf den Button 
                        „nächste Phase“ klicken.
                        </div>
                    </div>
                </div>
                <div class="panel panel-default">
                    <div class="panel-heading">
                        <div class="panel-title">
                            <a class="panel-title-color" data-toggle="collapse" data-parent="#accordion3" href="#collapse12">3. Erkenntnisse entwickeln</a>
                        </div>
                    </div>
                    <div id="collapse12" class="panel-collapse collapse in">
                        <div class="panel-body">Die individuellen Antworten werden nun vorgetragen. <br>Nachdem alle Teilnehmer die Fragen selbstständig 
                        beantwortet haben, trägt jeder Teilnehmer seine Antworten vor. Dieser Vorgang wird solange wiederholt, bis alle Teilnehmer ihre 
                        Antworten mündlich vorgetragen haben. <br>Nach Aufforderung des Moderators müssen Sie die nächste Phase „Entscheiden, 
                        was zu tun ist“ einleiten, indem Sie oben rechts auf den Button „nächste Phase“ klicken.
                        </div>
                    </div>
                </div>
                <div class="panel panel-default">
                    <div class="panel-heading">
                        <div class="panel-title">
                            <a class="panel-title-color" data-toggle="collapse" data-parent="#accordion3" href="#collapse13">4. Entscheiden was zu tun ist</a>
                        </div>
                    </div>
                    <div id="collapse13" class="panel-collapse collapse in">
                        <div class="panel-body">Anschließend werden die Antworten kategorisiert. Die Kategorie wählt der Moderator in dem Dropdown-Menü 
                        oben links jeder Klebekarte aus. Die Teilnehmer helfen dem Moderator bei dieser Tätigkeit mündlich. Nach diesem Vorgang verfasst 
                        der Moderator eine Zusammenfassung. Die Teilnehmer helfen dem Moderator bei dieser Tätigkeit auch wieder mündlich. 
                        Nach Aufforderung des Moderators müssen Sie die nächste Phase „Abschluss“ einleiten, indem Sie oben rechts auf den Button „nächste Phase“ klicken.
                        </div>
                    </div>
                </div>
                <div class="panel panel-default">
                    <div class="panel-heading">
                        <div class="panel-title">
                            <a class="panel-title-color" data-toggle="collapse" data-parent="#accordion3" href="#collapse14">5. Abschluss</a>
                        </div>
                    </div>
                    <div id="collapse14" class="panel-collapse collapse in">
                        <div class="panel-body">Mit dem Stellen der Meta-Fragen beendet der Moderator die Retrospektive. 
                        Jeder Teilnehmer kann diese Fragen mit Hilfe der Schieberegler beantworten. Wenn Sie unten rechts auf den Button 
                        „Fertig“ drücken, geben Sie Ihre Antwort ab. Der Moderator veröffentlicht die Ergebnisse, nachdem alle 
                        Teammitglieder Ihre Antworten gegeben haben. Das Meeting beenden Sie nun nach Aufforderung des Moderators, 
                        indem Sie auf oben rechts auf den Button „beenden“ drücken.
                        </div>
                    </div>
                </div>
            </div>
            <div class="panel-group" id="accordion4">
                <h5>Moderation</h5>
                <p>Unter den Aufgabenbereich der Moderation fallen die Erstellung von Meetings/Retrospektiven, sowie die
                    Leitung und Durchführung dieser.
                    Der Ablauf der Retrospektive ist im Grunde für den Moderator und für die Mitglieder gleich,
                    die folgenden Unterschiede im Aufgabenbereich und der Funktionalität des Tools gilt es aber zu
                    berücksichtigen.
                </p>
                <div class="panel panel-default">
                    <div class="panel-heading">
                        <div class="panel-title">
                            <a class="panel-title-color" data-toggle="collapse" data-parent="#accordion4" href="#collapse15">Retrospektive planen</a>
                        </div>
                    </div>
                    <div id="collapse15" class="panel-collapse collapse in">
                        <div class="panel-body">Eine neue Retrospektive kann nur der Moderator oder ein Admin planen. 
                        <br>Unter dem Reiter “Meine Teams” kann der Moderator das Team auswählen und kommt in die Meeting Historie. 
                        In der grünen Navigationsleiste kann durch Aufrufen des Reiters “Meeting planen” ein neuer Termin vergeben werden. 
                        Der Moderator kann nun einen Retrospektiventyp festgelegen. 
                        Zum Schluss bestimmt der Moderator das Datum und die Uhrzeit an dem das Meeting gestartet werden soll. 
                        Um ein Meeting zu löschen muss der Moderator oder der Admin unter dem Reiter „Meeting planen“ und „Meeting entfernen“ 
                        das Meeting aussuchen, das gelöscht werden soll. Mit einem Klick auf den Button „Meeting löschen“ wird das 
                        Meeting entfernt.
                        </div>
                    </div>
                </div>
                <div class="panel panel-default">
                    <div class="panel-heading">
                        <div class="panel-title">
                            <a class="panel-title-color" data-toggle="collapse" data-parent="#accordion4" href="#collapse16">Aufdecken der
                                Antwortkarten</a>
                        </div>
                    </div>
                    <div id="collapse16" class="panel-collapse collapse in">
                        <div class="panel-body">Der Moderator gibt vor, wie die Präsentation der Antworten abläuft. Sie suchen sich eine 
                        Frage aus, indem Sie auf die entsprechende Frage klicken. Nun werden Sie automatisch zu dem dazugehörigen Feld 
                        geleitet, in dem die Antworten präsentiert werden. Um Klebekarten mit den jeweiligen Antworten vorstellen zu können, 
                        wählen Sie in der grünen unteren Navigationsleiste ein Teammitglied aus, das seine Antworten präsentieren soll. 
                        Dies tun Sie, indem Sie auf das Mitarbeitersymbol klicken und einen Mitarbeiter bestimmen. 
                        Nun werden die Antworten dieses Mitarbeiters aufgedeckt und hervorgehoben. Dieser Prozess wird solange wiederholt, 
                        bis alle Fragen beantwortet worden sind und alle Mitglieder ihre Antworten vorgetragen haben. 
                        Als nächstes müssen Sie Überkategorien vergeben (weitere Infos siehe unter „Erstellung und Vergabe von Überkategorien). 
                        </div>
                    </div>
                </div>
                <div class="panel panel-default">
                    <div class="panel-heading">
                        <div class="panel-title">
                            <a class="panel-title-color" data-toggle="collapse" data-parent="#accordion4" href="#collapse17">Erstellung und Vergabe
                                von Überkategorien</a>
                        </div>
                    </div>
                    <div id="collapse17" class="panel-collapse collapse in">
                        <div class="panel-body">Nachdem von jedem Teilnehmer die Klebekarten vorgestellt wurden, muss der Moderator Überkategorien 
                        erstellen und vergeben. Um eine neue Überkategorie zu erstellen, klicken Sie in der grünen unteren Navigationsleiste auf das Zahnradsymbol. 
                        Nun kann eine Überkategorie im Feld „Überkategorie erstellen“ hinzugefügt werden. Einer Klebekarte wird eine Überkategorie zugeordnet, 
                        indem Sie in dem Drop-Down-Menü der Klebekarte eine Kategorie auswählen. Um die nächste Phase einzuleiten, müssen Sie 
                        oben rechts auf den Button „nächste Phase“ klicken. Anschließend fordern Sie die Teilnehmer auf das Gleiche zu tun, 
                        um mit der nächsten Phase zu beginnen.
                        </div>
                    </div>
                </div>
                <div class="panel panel-default">
                    <div class="panel-heading">
                        <div class="panel-title">
                            <a class="panel-title-color" data-toggle="collapse" data-parent="#accordion4" href="#collapse18">Vergabe von
                                Moderationsrechten</a>
                        </div>
                    </div>
                    <div id="collapse18" class="panel-collapse collapse in">
                        <div class="panel-body">Bei der Erstellung eines Meetings kann der Moderator des Teams oder ein Nutzer mit höheren Rechten
                            einem anderen Mitarbeiter vorübergehende Moderationsrechte vergeben.
                        </div>
                    </div>
                </div>
                <div class="panel panel-default">
                    <div class="panel-heading">
                        <div class="panel-title">
                            <a class="panel-title-color" data-toggle="collapse" data-parent="#accordion4" href="#collapse19">Erstellung einer
                                Zusammenfassung</a>
                        </div>
                    </div>
                    <div id="collapse19" class="panel-collapse collapse in">
                        <div class="panel-body">Der Moderator kann eine Zusammenfassung erstellen. Hierfür können Sie eine relevante Überkategorie 
                        im Drop-Down Menü “Überkategorie auswählen” selektieren und in Rücksprache mit den übrigen Teilnehmern sowohl den Soll-Zustand 
                        dokumentieren als auch Lösungsansätze im TODO Textfeld beschreiben. Mit einem Klick auf das “+” Symbol können beliebig 
                        viele weiter Zusammenfassungen erstellt werden. Mit einem Klick auf “Abschicken und weiter " werden die Zusammenfassungen 
                        dauerhaft gespeichert und die nächste Phase eingeleitet. Nachdem Sie auf diesen Button geklickt haben, müssen Sie die Teilnehmer 
                        bitten das Gleiche zu tun. 
                        </div>
                    </div>
                </div>
                <div class="panel panel-default">
                    <div class="panel-heading">
                        <div class="panel-title">
                            <a class="panel-title-color" data-toggle="collapse" data-parent="#accordion4" href="#collapse20">Durchführung einer
                                Umfrage mit Metafragen </a>
                        </div>
                    </div>
                    <div id="collapse20" class="panel-collapse collapse in">
                        <div class="panel-body">Zum Schluss können Sie im gegebenen Textfeld Fragen formulieren. Wenn mehrere Metafragen gestellt werden sollen, können mittels des “+“-Buttons weitere Fragen hinzugefügt werden. 
                        Mit einem Klick auf “alle Fragen senden”, wird die Umfrage den Teilnehmern zur Bearbeitung bereitgestellt. Um die Fragen selbst beantworten zu können drücken Sie auf den Button „Weiter“. 
                        Nachdem Sie alle Meta-Fragen beantwortet haben, drücken Sie auf den Button “Alle Antworten senden“ und drücken Sie auf den Button „Zum Abschluss“.  Bitten Sie die Teammitglieder, nachdem alle die Fragen beantwortet haben, auf den Button „Alle Antworten senden“ zu klicken und anschließend auf „Zum Abschluss“.
                        <br>Wenn Sie keine Meta-Fragen stellen wollen drücken Sie auf den Button „Weiter“ und „Zum Abschluss“.  
                        Sobald Sie das Meeting für beendet erklären, müssen Sie auf den Button oben rechts „Beenden“ klicken und die Teilnehmer bitten das Gleiche zu tun.
                        Die Retrospektive ist nun beendet und die Zusammenfassung unter Meeting-Historie einsehbar.
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</main>

<?php require('../partials/footer.php'); ?>