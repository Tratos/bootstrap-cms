<?php

include_once('modules/install/class_install.php');
$install = new Install();

switch($_GET["step"]) {
	case 2:
		// Set new $config-Vars
		if ($_POST["host"]) $config["database"]["server"] = $_POST["host"];
		if ($_POST["user"]) $config["database"]["user"] = $_POST["user"];
		if ($_POST["pass"]) $config["database"]["passwd"] = $_POST["pass"];
		if ($_POST["database"]) $config["database"]["database"] = $_POST["database"];
		if ($_POST["prefix"]) $config["database"]["prefix"] = $_POST["prefix"];

		if(!$install->WriteConfig()) {
			$func->error(t('Datei \'config.php\' konnte <strong>nicht</strong> geschrieben werden.'));
		} else {
			$func->confirmation(t('Datei \'config.php\' wurde erfolgreich geschrieben.'), "index.php?mod=install&action=ls_conf");
		}
	break;
	
	default:
		$dsp->NewContent(t('Grundeinstellungen'), t('Bitte gib nun die Zugangsdaten zur Datenbank an.'));
		$dsp->SetForm("index.php?mod=install&action=ls_conf&step=2");

		if ($_POST["host"] == "") $_POST["host"] = $config['database']['server'];
		if ($_POST["user"] == "") $_POST["user"] = $config['database']['user'];
		if ($_POST["pass"] == "") $_POST["pass"] = $config['database']['passwd'];
		if ($_POST["database"] == "") $_POST["database"] = $config['database']['database'];
		if ($_POST["prefix"] == "") $_POST["prefix"] = $config['database']['prefix'];

		#### Database Access
		$dsp->AddSingleRow("<b>". t('Datenbank-Zugangsdaten') ."</b>");
		$dsp->AddTextFieldRow("host", t('Host (Server-IP)'), $_POST["host"], "");
		$dsp->AddTextFieldRow("user", t('Benutzername'), $_POST["user"], "");
		$dsp->AddPasswordRow("pass", t('Kennwort'), $_POST["pass"], "");
		$dsp->AddTextFieldRow("database", t('Datenbank'), $_POST["database"], "");
		$dsp->AddTextFieldRow("prefix", t('Tabellen-Prefix'), $_POST["prefix"], "");

		$dsp->AddFormSubmitRow(t('Weiter'));
		$dsp->AddBackButton("index.php?mod=install", "install/ls_conf");
		$dsp->AddContent();
	break;
}
?>
